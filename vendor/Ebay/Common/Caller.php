<?php

namespace Ebay\Common;

class Caller {

    protected function call($url) {
        
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_FOLLOWLOCATION => TRUE
        ));

        $content = curl_exec($ch);
 
        if ($content === FALSE) {
            throw new \Ebay\Exception\CallException("La réponse de l'api ebay est nulle.". json_encode(curl_getinfo($ch)));
        }

        $doc = new \DOMDocument("1.0", "UTF-8");
        $load = @$doc->loadXML($content);

        if ($load === FALSE) {
            throw new \Ebay\Exception\CallException("La réponse de l'api ebay est syntaxiquement incoreecte.");
        } else {

            $doc->formatOutput = true;
            //echo "<pre>" . str_replace("<", "&lt;", str_replace(">", "&gt;", $doc->saveXML())) . "</pre>";
            
            if ($doc->getElementsByTagName("ack")->length == 1) {
                $nodeName = "ack";
            } else if ($doc->getElementsByTagName("Ack")->length == 1) {
                $nodeName = "Ack";
            }
            if ($doc->getElementsByTagName($nodeName)->item(0)->nodeValue == "Failure") {
                $message = $doc->getElementsByTagName("LongMessage")->item(0)->nodeValue;
                throw new \Ebay\Exception\CallException($message);
            }
        }
        return $content;
    }

}
