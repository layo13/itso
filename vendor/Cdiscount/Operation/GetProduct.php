<?php

namespace Cdiscount\Operation;

use Cdiscount\API\Open;

/**
 * https://dev.cdiscount.com/docs/apiReference
 */
class GetProduct extends Open {

    const SECTION = "GetProduct";

    public function __construct() {
        parent::__construct();
    }

    public function get(array $productIdList) {

        $url = self::ENDPOINT . self::SECTION;

        $data = array(
            "ApiKey" => $this->apiKey,
            "ProductRequest" => array(
                "ProductIdList" => $productIdList,
                "Scope" => array(
                    "Offers" => true,
                    "AssociatedProducts" => false,
                    "Images" => true,
                    "Ean" => true
                )
            )
        );

        $dataJson = <<<JSON
{
  "ApiKey": "5427a84a-4146-4fd5-8ed7-f365623df484",
  "ProductRequest": {
    "ProductIdList": [
      "AUC0717669305383"
    ],
    "Scope": {
      "Offers": true,
      "AssociatedProducts": false,
      "Images": true,
      "Ean": true
    }
  }
}
JSON;

        $content = $this->call($url, json_encode($data));

        return json_decode($content, true);
    }

}
