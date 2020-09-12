<?php

namespace Cdiscount\Common;

class Caller {
	protected function call($url, $data) {
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_POST => TRUE,
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_RETURNTRANSFER => TRUE
		));

		$content = curl_exec($ch);
		
		if ($content === FALSE) {
			throw new \Cdiscount\Exception\CallException("La réponse de l'api Cdiscount est nulle.");
		}

		return $content;
	}
}
