<?php

namespace Cdiscount\Operation;

use Cdiscount\API\Open;

/**
 * https://dev.cdiscount.com/docs/apiReference
 */
class Search extends Open {

    const SECTION = "Search";

    public function __construct() {
        parent::__construct();
    }

    public function search($keywords) {

        $url = self::ENDPOINT . self::SECTION;

        $dataExemple = <<<JSON
{
  "ApiKey": "5427a84a-4146-4fd5-8ed7-f365623df484",
  "SearchRequest": {
    "Keyword": "Fender Precision",
    "SortBy": "relevance",
    "Pagination": {
      "ItemsPerPage": 20,
      "PageNumber": 0
    },
    "Filters": {
      "Price": {
        "Min": 0,
        "Max": 400
      },
      "Navigation": "musical instruments",
      "IncludeMarketPlace": true,
      "Brands": [],
      "Condition": null
    }
  }
}
JSON;

        $dataArray = array(
            "ApiKey" => $this->apiKey,
            "SearchRequest" => array(
                "Keyword" => $keywords,
                "SortBy" => "relevance",
                "Pagination" => array(
                    "ItemsPerPage" => 100,
                    "PageNumber" => 0
                ),
                "Filters" => array(
                    "Price" => array(
                        "Min" => 0,
                        "Max" => 400
                    ),
                    "Navigation" => "", // "musical instruments"
                    "IncludeMarketPlace" => true,
                    "Brands" => array(),
                    "Condition" => null
                )
            )
        );

        $data = json_encode($dataArray);

        $content = $this->call($url, $data);
        
        $apiReturn = json_decode($content, true);
        echo "<pre>" . json_encode($apiReturn, JSON_PRETTY_PRINT) . "</pre>";
        return is_null($apiReturn["Products"]) ? array() : $apiReturn["Products"];
    }

}
