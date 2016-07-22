<?php

require_once dirname(__FILE__).'/service/PaysbuyService.php';

class PaysbuyPaynow extends PaysbuyService {

	const ENDPOINT_URL = 'api_paynow/api_paynow.asmx';

	const OP_AUTHENTICATE = 'api_paynow_authentication_v3';

	const USER_PARAMS = [
		'psbID' => PAYSBUY_PSBID,
		'username' => PAYSBUY_USERNAME,
		'securecode' => PAYSBUY_SECURECODE
	];

	public static function authenticate($data = []) {
		$reqdFields = [
			"psbID",
			"username",
			"securecode",
			"inv",
			"itm",
			"amt",
			"curr_type",
			"method",
			"language",
			"resp_front_url",
			"resp_back_url"
		];
		$allFields = array_merge($reqdFields, [
			"paypal_amt",
			"com",
			"opt_fix_redirect",
			"opt_fix_method",
			"opt_name",
			"opt_email",
			"opt_mobile",
			"opt_address",
			"opt_detail",
			"opt_param"
		]);

		$res = parent::post(
			self::_getURL(self::OP_AUTHENTICATE),
			parent::buildParams(self::USER_PARAMS + $data, $allFields, $reqdFields)
		);

		$res = simplexml_load_string($res)[0];
		$code = substr($res, 0, 2);
		$res = substr($res, 2);
		if ($code == '00') {
			return $res;
		} else {
			throw new Exception("Error Processing Request - '$res'", 1);
		}

	}

	private static function _getURL($operation = "") {
		return parent::getURL($operation);
	}

}