<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate Id.',
		'default' => 'Id: invalid input.'
    ),
	
	'payment_id' => array
    (
        'required' => 'Payment Id: required.',
        'length' => 'Payment Id: must be 16 characters.',
        'msg_duplicate' => 'Payment Id: duplicate Tilltransaction Id.',
		'default' => 'Payment Id: invalid input.'
    ),

	'branch_id' => array
    (
        'required' => 'Branch Id: required.',
        'length' => 'Branch Id: must be between 2 - 50 letters.',
        'default' => 'Branch Id: invalid input.'
    ),

	'till_id' => array
    (
        'required' => 'Till Id: required.',
        'length' => 'Till Id: must be 2 - 59 characters.',
        'msg_till' => 'Till Id: Not current user till or till does not exist.',
		'default' => 'Till Id: invalid input.'
    ),
	
	'order_id' => array
    (
        'required' => 'Order Id: required.',
        'length' => 'Order Id: must be 16 characters.',
		'msg_orderstatus' => 'Order Id: Order Status is QUOTATION, payments not allowed, change to ORDER.CONFIRMED.',
		'default' => 'Order Id: invalid input.'
    ),

	'amount' => array
    (
        'required' => 'Amount: required.',
		'numeric' => 'Amount: must be numeric.',
        'default' => 'Amount: invalid input.'
    ),
	
	'payment_type' => array
    (
        'required' => 'Transaction Type: required.',
        'length' => 'Transaction Type: must be 4 - 11 characters.',
		'default' => 'Transaction Type: invalid input.'
    ),
	
	'payment_date' => array
    (
        'required' => 'Payment Date: required.',
		'length' => 'Payment Date: must be 10 characters.',
        'alpha_dash' => 'Payment Date: date format is incorrect (YYYY-MM-DD).',
		'default' => 'Payment Date: invalid input.'
    ),
	
	'payment_status' => array
    (
        'required' => 'Payment Status: required.',
        'length' => 'Payment Status: must be 5 - 10 characters.',
		'default' => 'Payment Status: invalid input.'
    )
);