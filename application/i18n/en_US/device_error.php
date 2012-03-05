<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate id.',
		'default' => 'Id: invalid input.'
    ),
	
	'device_id' => array
    (
        'required' => 'Device Id: required.',
        'length' => 'Device Id: must be 3 - 50 characters.',
        'msg_duplicate' => 'Device Id: duplicate id.',
		'default' => 'Device Id: invalid input.'
    ),
	
	'model' => array
    (
        'required' => 'Model: required.',
        'length' => 'Model: must be 3 - 50 characters.',
		'default' => 'Model: invalid input.'
    ),
		
	'warranty_expiry_date' => array
    (
        'required' => 'Warranty Expiry Date: required.',
		'length' => 'Warranty Expiry Date: must be 10 characters.',
        'alpha_dash' => 'Warranty Expiry Date: format is incorrect (YYYY-MM-DD).',
		'default' => 'Warranty Expiry Date: invalid input.'
    ),
	
	'passcode' => array
    (
        'numeric' => 'Passcode: must be 1-50 digits.',
        'default' => 'Passcode: Invalid Input.'
    ),
	
	'sms_enabled' => array
    (
  		'required' => 'SMS Enabled: required, must be[Y/N].',
        'alpha' => 'SMS Enabled: must be[Y/N].',
        'length' => 'SMS Enabled: must be 1 letter.',
        'default' => 'SMS Enabled: invalid input.'
    ),
	
	'gprs_enabled' => array
    (
  		'required' => 'GPRS Enabled: required, must be[Y/N].',
        'alpha' => 'GPRS Enabled: must be[Y/N].',
        'length' => 'GPRS Enabled: must be 1 letter.',
        'default' => 'GPRS Enabled: invalid input.'
    ),
	
	'imei' => array
    (
        'numeric' => 'Imei: must be 1-50 digits.',
        'default' => 'Imei: invalid input.'
    ),
	
	'phone_device' => array
    (
        'required' => 'Phone (Device#): required.',
		'numeric' => 'Phone (Device#): must be 7 digits.',
        'default' => 'Phone (Device#): invalid input.'
    ),

	'phone_textback1' => array
    (
        'required' => 'Phone (Primary Contact#): required.',
		'numeric' => 'Phone (Primary Contact#): must be 7 digits.',
        'default' => 'Phone (Primary Contact#): invalid input.'
    ),
	
	'phone_textback2' => array
    (
        'numeric' => 'Phone (Secondary Contact#): must be 7 digits.',
        'default' => 'Phone (Secondary Contact#): invalid input.'
    ),

	'gpsgate_user' => array
    (
        'length' => 'Gpsgate User: must be 2 - 50 characters.',
		'default' => 'Gpsgate User: invalid input.'
    ),
	
	'gpsgate_pass' => array
    (
        'length' => 'Gpsgate Pass: must be 2 - 50 characters.',
		'default' => 'Gpsgate Pass: invalid input.'
    ),

	'order_id' => array
    (
        'numeric' => 'Order Id: must be numeric.',
        'default' => 'Order Id:  invalid input.'
    )
);