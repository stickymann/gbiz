<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate Id.',
		'default' => 'Id: invalid input.'
    ),

	'paymentcancel_id' => array
    (
        'required' => 'Payment Cancel Id: required.',
        'length' => 'Payment Cancel Id: must be 16 characters.',
        'msg_duplicate' => 'Payment Cancel Id: duplicate Payment Cancel Id.',
		'default' => 'Payment Cancel Id: invalid input.'
    ),
	
	'payment_id' => array
    (
        'required' => 'Payment Id: required.',
        'length' => 'Payment Id: must be 16 characters.',
		'default' => 'Payment Id: invalid input.'
    ),

	'amount' => array
    (
        'required' => 'Amount: required.',
		'numeric' => 'Amount: must be numeric.',
        'default' => 'Amount: invalid input.'
    ),
	
	'reason' => array
    (
        'required' => 'Reason: required.',
        'length' => 'Reason: must be 10 - 255 characters.',
		'default' => 'Reason: invalid input.'
    )
);