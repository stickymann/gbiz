<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate id.',
		'default' => 'Id: invalid input.',
    ),
	
	'name' => array
    (
        'required' => 'Role Name: required.',
        'alpha' => 'Role Name: must have only alphabetic characters.',
        'length' => 'Role Name: must be between 3 - 50 characters.',
        'msg_duplicate' => 'Role Name: duplicate role name.',
		'default' => 'Role Name: invalid input.',
    ),

	'description' => array
    (
        'required' => 'Description: required.',
        'alpha' => 'Description: must have only alphabetic characters.',
        'length' => 'Description: must be between 3 - 50 characters.',
		'default' => 'Description: invalid input.',
    )
);