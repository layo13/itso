<?php

namespace Ebay\Operation;

use Ebay\API\Finding;

/**
 * http://developer.ebay.com/DevZone/Finding/CallRef/findItemsByKeywords.html
 */
class FindItemsByKeywords extends Finding {

    const OPERATION = "findItemsByKeywords";
    const VERSION = "1.0.0";

    public function __construct() {
        parent::__construct();
    }

    public function find(array $keywords, $entriesPerPage = 20, $responseDataFormat = "XML") {

        $url = self::ENDPOINT . "?"
                . "OPERATION-NAME=" . self::OPERATION . "&"
                . "GLOBAL-ID=EBAY-FR&"
                . "SERVICE-VERSION=" . self::VERSION . "&"
                . "SECURITY-APPNAME=" . $this->appName . "&"
                . "RESPONSE-DATA-FORMAT=" . $responseDataFormat . "&"
                . "REST-PAYLOAD&"
                . "keywords=" . join("%20", $keywords) . "&"
            
                . "itemFilter(0).name=Condition&"
                . "itemFilter(0).value=1000&"
                
                . "paginationInput.entriesPerPage=".$entriesPerPage;


        $content = $this->call($url);

        $doc = new \DOMDocument("1.0", "UTF-8");
        $doc->loadXML($content);
        $doc->formatOutput = true;
        return $this->processResponse($doc);
    }

    private function processResponse(\DOMDocument $doc) {
        $items = array();
        $domItems = $doc->getElementsByTagName("item");

        /* @var $domItem \DOMElement */
        foreach ($domItems as $domItem) {
            $item = array();

            $item["itemId"] = $domItem->getElementsByTagName("itemId")->item(0)->nodeValue;
            $item["title"] = $domItem->getElementsByTagName("title")->item(0)->nodeValue;
            $item["globalId"] = $domItem->getElementsByTagName("globalId")->item(0)->nodeValue;

            /* @var $domPrimaryCategory \DOMElement */
            $domPrimaryCategory = $domItem->getElementsByTagName("primaryCategory")->item(0);

            $primaryCategory = array(
                "categoryId" => $domPrimaryCategory->getElementsByTagName("categoryId")->item(0)->nodeValue,
                "categoryName" => $domPrimaryCategory->getElementsByTagName("categoryName")->item(0)->nodeValue
            );
            $item["primaryCategory"] = $primaryCategory;

            if ($domItem->getElementsByTagName("galleryURL")->length) {
                $item["galleryURL"] = $domItem->getElementsByTagName("galleryURL")->item(0)->nodeValue;
            }
            $item["viewItemURL"] = $domItem->getElementsByTagName("viewItemURL")->item(0)->nodeValue;

            if ($domItem->getElementsByTagName("productId")->length == 1) {
                $item["productId"] = $domItem->getElementsByTagName("productId")->item(0)->nodeValue;
                $item["productIdType"] = $domItem->getElementsByTagName("productId")->item(0)->getAttribute("type");
            }

            $item["paymentMethod"] = $domItem->getElementsByTagName("paymentMethod")->item(0)->nodeValue;
            $item["autoPay"] = $domItem->getElementsByTagName("autoPay")->item(0)->nodeValue;

            if ($domItem->getElementsByTagName("postalCode")->length == 1) {
                $item["postalCode"] = $domItem->getElementsByTagName("postalCode")->item(0)->nodeValue;
            }
            $item["location"] = $domItem->getElementsByTagName("location")->item(0)->nodeValue;
            
            if ($domItem->getElementsByTagName("country")->length > 0) {
                $item["country"] = $domItem->getElementsByTagName("country")->item(0)->nodeValue;
            }

            /* @var $domShippingInfo DOMElement */
            $domShippingInfo = $domItem->getElementsByTagName("shippingInfo")->item(0);
            $shippingInfo = array();

            if ($domShippingInfo->getElementsByTagName("shippingServiceCost")->length == 1) {
                $shippingInfo["shippingServiceCost"] = $domShippingInfo->getElementsByTagName("shippingServiceCost")->item(0)->nodeValue;
                $shippingInfo["shippingServiceCostCurrencyId"] = $domShippingInfo->getElementsByTagName("shippingServiceCost")->item(0)->getAttribute("currencyId");
            }

            $shippingInfo["shippingType"] = $domShippingInfo->getElementsByTagName("shippingType")->item(0)->nodeValue;

            $domShipToLocations = $domShippingInfo->getElementsByTagName("shipToLocations");
            $shipToLocations = array();
            /* @var $domShipToLocation DOMElement */
            foreach ($domShipToLocations as $domShipToLocation) {
                $shipToLocations[] = $domShipToLocation->nodeValue;
            }
            $shippingInfo["shipToLocations"] = $shipToLocations;
            $item["shippingInfo"] = $shippingInfo;

            /* @var $domSellingStatus DOMElement */
            $domSellingStatus = $domItem->getElementsByTagName("sellingStatus")->item(0);

            $sellingStatus = array(
                "currentPrice" => $domSellingStatus->getElementsByTagName("currentPrice")->item(0)->nodeValue,
                "currentPriceCurrencyId" => $domSellingStatus->getElementsByTagName("currentPrice")->item(0)->getAttribute("currencyId"),
                "convertedCurrentPrice" => $domSellingStatus->getElementsByTagName("convertedCurrentPrice")->item(0)->nodeValue,
                "convertedCurrentPriceCurrencyId" => $domSellingStatus->getElementsByTagName("convertedCurrentPrice")->item(0)->getAttribute("currencyId"),
                "sellingState" => $domSellingStatus->getElementsByTagName("sellingState")->item(0)->nodeValue,
                "timeLeft" => $domSellingStatus->getElementsByTagName("timeLeft")->item(0)->nodeValue,
            );

            if ($domSellingStatus->getElementsByTagName("bidCount")->length == 1) {
                $sellingStatus["bidCount"] = $domSellingStatus->getElementsByTagName("bidCount")->item(0)->nodeValue;
            }
            $item["sellingStatus"] = $sellingStatus;

            /* @var $domListingInfo DOMElement */
            $domListingInfo = $domItem->getElementsByTagName("listingInfo")->item(0);
            $listingInfo = array(
                "bestOfferEnabled" => $domListingInfo->getElementsByTagName("bestOfferEnabled")->item(0)->nodeValue,
                "buyItNowAvailable" => $domListingInfo->getElementsByTagName("buyItNowAvailable")->item(0)->nodeValue,
                "startTime" => $domListingInfo->getElementsByTagName("startTime")->item(0)->nodeValue,
                "endTime" => $domListingInfo->getElementsByTagName("endTime")->item(0)->nodeValue,
                "listingType" => $domListingInfo->getElementsByTagName("listingType")->item(0)->nodeValue,
                "gift" => $domListingInfo->getElementsByTagName("gift")->item(0)->nodeValue
            );

            if ($domListingInfo->getElementsByTagName("buyItNowPrice")->length == 1) {
                $listingInfo["buyItNowPrice"] = $domListingInfo->getElementsByTagName("buyItNowPrice")->item(0)->nodeValue;
                $listingInfo["buyItNowPriceCurrencyId"] = $domListingInfo->getElementsByTagName("buyItNowPrice")->item(0)->getAttribute("currencyId");
            }
            if ($domListingInfo->getElementsByTagName("convertedBuyItNowPrice")->length == 1) {
                $listingInfo["convertedBuyItNowPrice"] = $domListingInfo->getElementsByTagName("convertedBuyItNowPrice")->item(0)->nodeValue;
                $listingInfo["convertedBuyItNowPriceCurrencyId"] = $domListingInfo->getElementsByTagName("convertedBuyItNowPrice")->item(0)->getAttribute("currencyId");
            }

            $item["listingInfo"] = $listingInfo;

            if ($domItem->getElementsByTagName("galleryPlusPictureURL")->length == 1) {
                $item["galleryPlusPictureURL"] = $domItem->getElementsByTagName("galleryPlusPictureURL")->item(0)->nodeValue;
            }

            if ($domItem->getElementsByTagName("condition")->length > 0) {
                /* @var $domCondition DOMElement */
                $domCondition = $domItem->getElementsByTagName("condition")->item(0);
                if ($domCondition->getElementsByTagName("conditionId")->length > 0) {
                    $condition["conditionId"] = $domCondition->getElementsByTagName("conditionId")->item(0)->nodeValue;
                }
                if ($domCondition->getElementsByTagName("conditionDisplayName")->length > 0) {
                    $condition["conditionDisplayName"] = $domCondition->getElementsByTagName("conditionDisplayName")->item(0)->nodeValue;
                };
                $item["condition"] = $condition;
            }
            $item["isMultiVariationListing"] = $domItem->getElementsByTagName("isMultiVariationListing")->item(0)->nodeValue;
            $item["topRatedListing"] = $domItem->getElementsByTagName("topRatedListing")->item(0)->nodeValue;

            $items[] = $item;
        }
        return $items;
    }

}
