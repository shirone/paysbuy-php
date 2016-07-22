<?php

defined('PAYSBUY_LIVE_DOMAIN') || define('PAYSBUY_LIVE_DOMAIN', 'https://www.paysbuy.com');
defined('PAYSBUY_TEST_DOMAIN') || define('PAYSBUY_TEST_DOMAIN', 'https://demo.paysbuy.com');
defined('PAYSBUY_TESTMODE') || define('PAYSBUY_TESTMODE', FALSE);

$main = dirname(__FILE__)."/paysbuy/";

require_once $main.'PaysbuyPaynow.php';
