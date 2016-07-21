<?php

class PaysbuyService {

	const TIMEOUT = 60;
	const CONNECT_TIMEOUT = 30;

	const METHOD_GET = 'GET';
	const METHOD_POST = 'POST';

	public static function getURL($operation) {
		return self::getDomain() . '/' . static::ENDPOINT_URL . '/' . $operation;
	}

	public static function getDomain() {
		return PAYSBUY_TESTMODE ? PAYSBUY_TEST_DOMAIN : PAYSBUY_LIVE_DOMAIN;
	}

	public static function buildParams($params = [], $all = [], $reqd = []) {
		$p = $params + array_fill_keys($all, '');
		foreach($reqd as $r) if ($p[$r] == '') throw new Exception("Required parameter missing - ".$r, 1);
		return $p;
	}

	public static function get($url, $params = NULL) {
		$res = self::_executeCurl($url, self::METHOD_GET, $params);
		return $res;
	}

	public static function post($url, $params = NULL) {
		$res = self::_executeCurl($url, self::METHOD_POST, $params);
		return $res;
	}

	private static function _executeCurl($url, $method, $params = NULL) {
		$ch = curl_init($url);
		curl_setopt_array($ch, self::_getCURLOpts($method, $params));
		if(($result = curl_exec($ch)) === false) {
			$error = curl_error($ch);
			curl_close($ch);
			throw new Exception($error);
		}
		curl_close($ch);
		return $result;
	}

	private static function _getCURLOpts($method, $params = NULL) {

		$options = [
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $method,
			CURLOPT_RETURNTRANSFER => true, // return a string
			CURLOPT_HEADER => 0,
			CURLINFO_HEADER_OUT => true,
			CURLOPT_AUTOREFERER => true,
			CURLOPT_TIMEOUT => PaysbuyService::TIMEOUT,
			CURLOPT_CONNECTTIMEOUT => PaysbuyService::CONNECT_TIMEOUT,
		];

		// Add POST params if we have some
		if($method==self::METHOD_POST && count($params)) {
			$options += [CURLOPT_POSTFIELDS => http_build_query($params)];
			$options += [CURLOPT_POST => count($params)];
		}

		return $options;

	}

}