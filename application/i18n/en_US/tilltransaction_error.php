<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate Id.',
		'default' => 'Id: invalid input.'
    ),
	
	'tilltransaction_id' => array
    (
        'required' => 'Tilltransaction Id: required.',
        'length' => 'Tilltransaction Id: must be 16 characters.',
        'msg_duplicate' => 'Tilltransaction Id: duplicate Tilltransaction Id.',
		'default' => 'Tilltransaction Id: invalid input.'
    ),

	'till_id' => array
    (
        'required' => 'Till Id: required.',
        'length' => 'Till Id: must be 2 - 59 characters.',
        'msg_till' => 'Till Id: Not current user till or till does not exist.',
		'default' => 'Till Id: invalid input.'
    ),
	
	'amount' => array
    (
        'required' => 'Amount: required.',
		'numeric' => 'Amount: must be numeric.',
        'default' => 'Amount: invalid input.'
    ),
	
	'transaction_type' => array
    (
        'required' => 'Transaction Type: required.',
        'length' => 'Transaction Type: must be 4 - 11 characters.',
		'default' => 'Transaction Type: invalid input.'
    ),

	'transaction_date' => array
    (
        'required' => 'Transaction Date: required.',
		'length' => 'Transaction Date: must be 10 characters.',
        'alpha_dash' => 'Transaction Date: date format is incorrect (YYYY-MM-DD).',
		'default' => 'Transaction Date: invalid input.'
    ),

	'movement' => array
    (
        'required' => 'Movement: required.',
        'length' => 'Movement: must be "IN" or "OUT".',
  		'default' => 'Movement: invalid input.',
    ),

	'reason' => array
    (
        'required' => 'Reason: required.',
        'length' => 'Reason: must be 2 - 255 characters.',
		'default' => 'Reason: invalid input.'
    )
);