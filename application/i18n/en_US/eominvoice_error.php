<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate id.',
		'default' => 'Id: invalid input.'
    ),
	
	'batch_id' => array
    (
        'required' => 'Batch Id: required.',
        'length' => 'Batch Id: must be 16 characters.',
        'msg_duplicate' => 'Batch Id: duplicate order id.',
		'default' => 'Batch Id: invalid input.'
    ),

	'batch_description' => array
    (
        'required' => 'Batch Description: required.',
        'length' => 'Batch Description: must be 1 - 255 characters.',
		'default' => 'Batch Description: invalid input.'
    ),
	
	'batch_date' => array
    (
        'required' => 'Batch Date: required.',
		'length' => 'Batch Date: must be 10 characters.',
        'alpha_dash' => 'Batch Date: date format is incorrect (YYYY-MM-DD).',
		'default' => 'Batch Date: invalid input.'
    ),
	
	'batch_details' => array
    (
        'required' => 'Batch Details: required.',
		'zero_batchdetails' => 'Batch Details: zero orders selected, at least one required.', 
        'default' => 'BaTCH Details: invalid input.'
    )
);