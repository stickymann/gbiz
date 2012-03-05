<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate Id.',
		'default' => 'Id: invalid input.'
    ),
	
	'product_id' => array
    (
        'required' => 'Product Id: required.',
        'length' => 'Product Id: must be 2 - 50 characters.',
        'msg_duplicate' => 'Product Id: duplicate Product Id.',
		'default' => 'Product Id: invalid input.'
    ),

	'type' => array
    (
        'required' => 'Product Type: required.',
        'length' => 'Product Type: must be 2 - 20 characters.',
		'default' => 'Product Type: invalid input.'
    ),
		
	'package_items' => array
    (
        'required' => 'Package Items: required.',
        'length' => 'Package Items: must be between 2 - 255 characters.',
        'default' => 'Package Items: invalid input.'
    ),  
	
	'product_description' => array
    (
        'required' => 'Product Description: required.',
        'length' => 'Product Description: must be between 2 - 255 characters.',
        'default' => 'Product Description: invalid input.'
    ),      
	
	'category' => array
    (
        'required' => 'Category: required.',
        'length' => 'Category:  must be between 2 - 50 characters.',
        'default' => 'Category: invalid input.'
    ),

	'sub_category' => array
    (
        'required' => 'Sub Category: required.',
        'length' => 'Sub Category: must be between 2 - 50 characters.',
        'default' => 'Sub Category: invalid input.'
    ),

	'unit_price' => array
    (
        'numeric' => 'Unit Price: must be value number.',
        'default' => 'Unit Price: invalid input.'
    ),

	'tax_percentage' => array
    (
        'numeric' => 'Tax Percentage: must be value number < 100.',
        'default' => 'Tax Percentage: invalid input.'
    ),

	'taxable' => array
    (
        'required' => 'Taxable: required.',
        'length' => 'Taxable: must be 1 character [Y/N].',
		'default' => 'Taxable: invalid input.'
    ),

	'status' => array
    (
        'required' => 'Status: required.',
        'length' => 'Status: must be 2 - 20 characters.',
		'default' => 'Status: invalid input.'
    )
);