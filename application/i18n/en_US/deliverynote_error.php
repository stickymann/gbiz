<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate id.',
		'default' => 'Id: invalid input.'
    ),
	
	'deliverynote_id' => array
    (
        'required' => 'Deliverynote Id: required.',
        'length' => 'Deliverynote Id: must be 16 characters.',
        'msg_duplicate' => 'Deliverynote Id: duplicate order id.',
		'default' => 'Deliverynote Id: invalid input.'
    ),

	'order_id' => array
    (
        'required' => 'Order Id: required.',
        'length' => 'Order Id: must be 16 characters.',
		'default' => 'Order Id: invalid input.'
    ),

	'deliverynote_date' => array
    (
        'required' => 'Deliverynote Date: required.',
		'length' => 'Deliverynote Date: must be 10 characters.',
        'alpha_dash' => 'Deliverynote Date: date format is incorrect (YYYY-MM-DD).',
		'default' => 'Deliverynote Date: invalid input.'
    ),
	
	'status' => array
    (
        'required' => 'Status: required.',
        'length' => 'Status: must be 3 - 50 characters.',
        'msg_new' => 'Status: status cannot be "NEW" before commit.',
		'default' => 'Status: invalid input.'
    ),
	
	'delivered_by' => array
    (
        'required' => 'Delivered By: required.',
        'length' => 'Delivered By: must be 16 characters.',
		'default' => 'Delivered By: invalid input.'
    ),

	'delivery_date' => array
    (
        'required' => 'Delivery Date: required.',
		'length' => 'Delivery Date: must be 10 characters.',
        'alpha_dash' => 'Delivery Date: date format is incorrect (YYYY-MM-DD).',
		'default' => 'Delivery Date: invalid input.'
    )
);