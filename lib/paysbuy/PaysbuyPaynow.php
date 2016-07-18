<?php

require_once dirname(__FILE__).'/service/PaysbuyService.php';

class PaysbuyPaynow extends PaysbuyService {

	const ENDPOINT_URL = 'api_paynow/api_paynow.asmx';

	const OP_AUTHENTICATE = 'api_paynow_authentication_v3';

	const USER_PARAMS = [
		'psbID' => PAYSBUY_PSBID,
		'Username' => PAYSBUY_USERNAME,
		'SecureCode' => PAYSBUY_SECURECODE
	];

	public static function authenticate($data = []) {
		$allFields = [
			"psbID",
			"username",
			"secureCode",
			"inv",
			"itm",
			"amt",
			"paypal_amt",
			"curr_type",
			"com",
			"method",
			"language",
			"resp_front_url",
			"resp_back_url",
			"opt_fix_redirect",
			"opt_fix_method",
			"opt_name",
			"opt_email",
			"opt_mobile",
			"opt_address",
			"opt_detail",
			"opt_param"
		];
		$reqdFields = [
			"psbID",
			"username",
			"secureCode",
			"inv",
			"itm",
			"amt",
			"curr_type",
			"method",
			"language",
			"resp_front_url",
			"resp_back_url"
		];

		$res = parent::get(
			self::_getURL(self::OP_AUTHENTICATE),
			parent::buildParams(USER_PARAMS + $data, $allFields, $reqdFields)
			$allFields,
			$reqdFields,
			USER_PARAMS + $data
		);

		return simplexml_load_string($res)->xpath('/string')[0];
	}

	private static function _getURL($operation = "") {
		return parent::getURL($operation);
	}

}