<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate id.',
		'default' => 'Id: invalid input.'
    ),
	
	'order_id' => array
    (
        'required' => 'Order Id: required.',
        'length' => 'Order Id: must be 8 characters.',
        'msg_duplicate' => 'Order Id: duplicate order id.',
		'default' => 'Order Id: invalid input.'
    ),

	'branch_id' => array
    (
        'required' => 'Branch Id: required.',
        'length' => 'Branch Id: must be between 2 - 50 letters.',
        'default' => 'Branch Id: invalid input.'
    ), 

	'customer_id' => array
    (
        'required' => 'Customer Id: required.',
        'length' => 'Customer Id: must be 8 characters.',
		'default' => 'Customer Id: invalid input.'
    ),
		
	'order_date' => array
    (
        'required' => 'Order Date: required.',
		'length' => 'Order Date: must be 10 characters.',
        'alpha_dash' => 'Order Date: date format is incorrect (YYYY-MM-DD).',
		'default' => 'Order Date: invalid input.'
    ),
	
	'order_status' => array
    (
        'required' => 'Order Status: required.',
        'length' => 'Order Status: must be 3 - 20 characters.',
        'msg_new' => 'Order Status: status cannot be "NEW" for filled order.',
		'default' => 'Order Status: invalid input.'
    ),

	'status_change_date' => array
    (
        'required' => 'Status Change Date: required.',
		'length' => 'Status Change Date: must be 10 characters.',
        'alpha_dash' => 'Status Change Date: date format is incorrect (YYYY-MM-DD).',
		'default' => 'Status Change Date: invalid input.'
    ),
	
	'order_details' => array
    (
        'required' => 'Order Detail: required.',
		'zero_orderdetails' => 'Order Detail: zero products selected, at least one required.', 
		'usertext_required' => 'Order Detail: user text required, must be 3 or more characters.',
        'default' => 'Order Detail: invalid input.'
    ),

	'inventory_checkout_type' => array
    (
        'required' => 'Inventory Checkout Type: required.',
		'length' => 'Inventory Checkout Type: must be 6 characters.',
        'default' => 'Inventory Checkout Type: invalid input.'
    ),
	
	'inventory_checkout_status' => array
    (
        'required' => 'Inventory Checkout Status: required.',
		'length' => 'Inventory Checkout Status: must be 10 characters.',
        'default' => 'Inventory Checkout Status: invalid input.'
    )
);