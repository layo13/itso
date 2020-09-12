<?php

namespace Cdiscount\API;

use Cdiscount\Common\Caller;

class Open extends Caller {

    protected $apiKey;

    const ENDPOINT = "https://api.cdiscount.com/OpenApi/json/"; // Search ou GetProduct

    public function __construct() {
        $this->apiKey = \Cdiscount\Common\Credentials::APIKEY;
    }

}
