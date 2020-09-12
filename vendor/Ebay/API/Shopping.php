<?php

namespace Ebay\API;

use Ebay\Common\Caller;

class Shopping extends Caller {
	
	protected $appName;
	
	const ENDPOINT = "http://open.api.ebay.com/shopping";
	
	public function __construct() {
		$this->appName = \Ebay\Common\Credentials::APPID;
	}
}
