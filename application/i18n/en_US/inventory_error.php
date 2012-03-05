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

	'branch_id' => array
    (
        'required' => 'Branch Id: required.',
        'length' => 'Branch Id: must be 2 - 50 characters.',
		'default' => 'Branch Id: invalid input.'
    ),
	
	'reorder_level' => array
    (
        'numeric' => 'Reorder Level: must be numeric.',
        'default' => 'Reorder Level: invalid input.'
    ),
	
	'qty_reserved' => array
    (
        'numeric' => 'Quantity Reserved: must be numeric.',
        'default' => 'Quantity Reserved:  invalid input.'
    ),
	
	'qty_reserved' => array
    (
        'numeric' => 'Quantity Reserved: must be numeric.',
        'default' => 'Quantity Reserved:  invalid input.'
    ),
	
	'qty_backordered' => array
    (
        'numeric' => 'Quantity Backordered: must be numeric.',
        'default' => 'Quantity Backordered:  invalid input.'
    ),

	'last_update_type' => array
    (
        'required' => 'Update Type: required.',
        'length' => 'Update Type: must be 3 - 50 characters.',
        'default' => 'Update Type: invalid input.'
    )
);
