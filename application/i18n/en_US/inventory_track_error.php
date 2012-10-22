<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate id.',
		'default' => 'Id: invalid input.'
    ),
	
	'product_id' => array
    (
        'required' => 'Product Id: required.',
        'length' => 'Product Id: must be 3 - 50 characters.',
        'msg_duplicate' => 'Product Id: duplicate product/branch combo.',
		'default' => 'Product Id: invalid input.'
    ),

	'stockbatch_id' => array
    (
        'required' => 'Branch Id: required.',
        'length' => 'Branch Id: must be 16 characters.',
		'default' => 'Branch Id: invalid input.'
    ),
	
	'stock_description' => array
    (
        'required' => 'Stock Description: required.',
        'length' => 'Stock Description: must be 3 - 255 characters.',
		'default' => 'Stock Description: invalid input.'
    ),
	
	'stockin_quantity' => array
    (
        'numeric' => 'Stock In Quantity: must be numeric.',
        'default' => 'Stock In Quantity:  invalid input.'
    ),
	
	'stockin_date' => array
    (
        'required' => 'Stock In Date: required.',
		'length' => 'Stock In Date: must be 10 characters.',
        'alpha_dash' => 'Stock In Date: date format is incorrect (YYYY-MM-DD).',
		'default' => 'Stock In Date: invalid input.'
    ),

	'stockbatch_status' => array
    (
        'required' => 'Edit Status: required.',
        'length' => 'Edit Status: must be 3 - 10 characters.',
        'msg_new' => 'Edit Status: status cannot be "NEW", change to complete.',
		'default' => 'Edit Status: invalid input.'
    ),
	
	'stockbatch_details' => array
    (
        'required' => 'Stock Batch Details: required.',
		'zero_details' => 'Stock Batch Details: zero line items, at least one required.', 
		'item_comments_required' => 'Stock Batch Details: item comments required, must be 3 or more characters.',
        'quantity_mismatch' => 'Stock Batch Details: quantity mismatch, quantity must be equal to number of line items.',
		'default' => 'Order Details: invalid input.'
    )
);
