<?php

namespace Ebay\Operation;

use Ebay\API\Shopping;

/**
 * http://developer.ebay.com/Devzone/shopping/docs/CallRef/GetSingleItem.html
 */
class GetSingleItem extends Shopping {

    const OPERATION = "GetSingleItem";

    public function get($itemId, $responseEncoding = "XML") {
        $url = self::ENDPOINT . "?callname=" . self::OPERATION .
                "&responseencoding=" . $responseEncoding .
                "&appid=" . $this->appName .
                "&siteid=71" .
                "&version=967" .
                "&ItemID=" . $itemId;
        
        $content = $this->call($url);
        $doc = new \DOMDocument("1.0", "UTF-8");
        $doc->loadXML($content);
        return $this->processResponse($doc);
    }

    private function processResponse($doc) {
        /* @var $domItem \DOMElement */
        $domItem = $doc->getElementsByTagName("Item")->item(0);

        $item = array(
            "itemID" => $domItem->getElementsByTagName("ItemID")->item(0)->nodeValue,
            "endTime" => $domItem->getElementsByTagName("EndTime")->item(0)->nodeValue,
            "viewItemURLForNaturalSearch" => $domItem->getElementsByTagName("ViewItemURLForNaturalSearch")->item(0)->nodeValue,
            "listingType" => $domItem->getElementsByTagName("ListingType")->item(0)->nodeValue,
            "location" => $domItem->getElementsByTagName("Location")->item(0)->nodeValue,
            "galleryURL" => $domItem->getElementsByTagName("GalleryURL")->item(0)->nodeValue,
            "pictureURL" => array(),
            "primaryCategoryID" => $domItem->getElementsByTagName("PrimaryCategoryID")->item(0)->nodeValue,
            "primaryCategoryName" => $domItem->getElementsByTagName("PrimaryCategoryName")->item(0)->nodeValue,
            "bidCount" => $domItem->getElementsByTagName("BidCount")->item(0)->nodeValue,
            "convertedCurrentPrice" => array(
                "currencyID" => $domItem->getElementsByTagName("ConvertedCurrentPrice")->item(0)->getAttribute("currencyID"),
                "value" => $domItem->getElementsByTagName("ConvertedCurrentPrice")->item(0)->nodeValue
            ),
            "listingStatus" => $domItem->getElementsByTagName("ListingStatus")->item(0)->nodeValue,
            "timeLeft" => $domItem->getElementsByTagName("TimeLeft")->item(0)->nodeValue,
            "title" => $domItem->getElementsByTagName("Title")->item(0)->nodeValue,
            "country" => $domItem->getElementsByTagName("Country")->item(0)->nodeValue,
            "autoPay" => $domItem->getElementsByTagName("AutoPay")->item(0)->nodeValue
        );
        
        /* @var $domPictureURL \DOMElement */
        foreach ($domItem->getElementsByTagName("PictureURL") as $domPictureURL){
            $item['pictureURL'][] = $domPictureURL->nodeValue;
        }
        return $item;
    }

}
