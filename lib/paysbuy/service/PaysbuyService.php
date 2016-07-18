<?php

class PaysbuyService {

	public static function getURL($operation) {
		return self::getDomain() . '/' . static::ENDPOINT_URL . '/' . $operation;
	}

	public static function getDomain() {
		return PAYSBUY_TESTMODE ? PAYSBUY_TEST_DOMAIN : PAYSBUY_LIVE_DOMAIN;
	}

	private static function _getUserDets() {

	}


}