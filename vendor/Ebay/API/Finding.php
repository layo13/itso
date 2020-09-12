<?php

namespace Ebay\API;

use Ebay\Common\Caller;

class Finding extends Caller {
	
	protected $appName;
	
	const ENDPOINT = "http://svcs.ebay.com/services/search/FindingService/v1";
	
	public function __construct() {
		$this->appName = \Ebay\Common\Credentials::APPID;
	}
}
