<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate Id.',
		'default' => 'Id: invalid input.'
    ),
	
	'till_id' => array
    (
        'required' => 'Till Id: required.',
        'length' => 'Till Id: must be 2 - 59 characters.',
        'msg_duplicate' => 'Till Id: duplicate Till Id.',
		'default' => 'Till Id: invalid input.'
    ),

	'till_user' => array
    (
        'required' => 'Till User: required.',
        'length' => 'Till User: must be 2 - 50 characters.',
		'default' => 'Till User: invalid input.'
    ),

	'till_date' => array
    (
        'required' => 'Till Date: required.',
        'length' => 'Till Date: must be 10 characters.',
        'alpha_dash' => 'Till Date: format is incorrect (YYYY-MM-DD).',
		'default' => 'Till Date: invalid input.'
    ),

	'initial_balance' => array
    (
        'required' => 'Initial Balance: required.',
		'numeric' => 'Initial Balance: must be numeric.',
        'default' => 'Initial Balance: invalid input.'
    ),
	
	'status' => array
    (
        'required' => 'Status: required.',
        'length' => 'Status: must be 2 - 20 characters.',
		'default' => 'Status: invalid input.'
    ),

	'expiry_date' => array
    (
        'required' => 'Expiry Date: required.',
        'length' => 'Expiry Date: must be 10 characters.',
        'alpha_dash' => 'Expiry Date: format is incorrect (YYYY-MM-DD).',
		'default' => 'Expiry Date: invalid input.'
    ),

	'expiry_time' => array
    (
        'required' => 'Expiry Time: required, must be (HH:MM:SS).',
        'length' => 'Expiry Time: must be (HH:MM:SS).',
        'default' => 'Expiry Time: invalid input.'
    )
);