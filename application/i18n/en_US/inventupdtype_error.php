<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate id.',
		'default' => 'Id: invalid input.'
    ),
	
	'update_type_id' => array
    (
        'required' => 'Update Type Id: required.',
        'length' => 'Update Type Id: must be 3 - 50 characters.',
        'msg_duplicate' => 'Update Type Id: duplicate id.',
		'default' => 'Update Type Id: invalid input.'
    ),
	
	'description' => array
    (
        'required' => 'Description: required.',
        'length' => 'Description: must be 3 - 50 characters.',
		'default' => 'Description: invalid input.'
    ),
		
	'stock_movement' => array
    (
        'required' => 'Stock Movement: required.',
        'length' => 'Stock Movement: must be 3 - 50 characters.',
		'default' => 'Stock Movement: invalid input.'
    ),
);
