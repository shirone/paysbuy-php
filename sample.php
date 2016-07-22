<?php

include dirname(__FILE__).'/lib/Paysbuy.php';

PaysbuyService::setup([
	'psbID' => '0276761817',
	'username' => 'aomchom@paysbuy.com',
	'secureCode' => 'A1A849792963F2E5C5FAACFB8494C696'
]);

$code = PaysbuyPaynow::authenticate([
	'method' => '1',
	'language' => 'E',
	'inv' => '201607211',
	'itm' => 'An item being paid for!',
	'amt' => 3,
	'curr_type' => 'TH',
	'resp_front_url' => 'http://blah.com/front.php',
	'resp_back_url' => 'http://blah.com/back.php'
]);

var_dump($code);