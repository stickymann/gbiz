<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate id.',
		'default' => 'Id: invalid input.'
    ),
	
	'telno' => array
    (
        'required' => 'Phone: (Device#) is required.',
		'length' => 'Phone: (Device#) must be 7 digits.',
		'numeric' => 'Phone: (Device#) must be 7 digits.',
        'msg_duplicate' => 'Phone: duplicate phone (Device#).',
		'default' => 'Phone: (Device#) is invalid.'
    ),
	
	'plate' => array
    (
        'required' => 'Vehicle Id: required.',
        'length' => 'Vehicle Id:  must be 3 - 20 characters.',
        'msg_duplicate' => 'Vehicle Id: duplicate vehicle id.',
		'default' => 'Id: invalid input.'
    ),

	'username' => array
    (
        'required' => 'Username: required.',
        'length' => 'Username: must be between 2 - 50 characters.',
        'default' => 'Username: invalid input.'
    ),
	
	'mobile' => array
    (
        'required' => 'Mobile: required.',
        'length' => 'Mobile: must be between 9 - 23 characters.',
        'default' => 'Mobile: invalid input.'
    ),
	
	'totalmoney' => array
    (
        'required' => 'Total Money: required.',
		'numeric' => 'Total Money: must be numeric.',
		'default' => 'Total Money: invalid input.'
    ),

	'centerpassword' => array
    (
        'required' => 'Centerpassword: required.',
		'length' => 'Centerpassword: must be 6 digits.',
		'numeric' => 'Centerpassword: must be numeric.',
		'default' => 'Centerpassword: invalid input.'
    ),
	
	'hasalarm' => array
    (
        'required' => 'Has Alarm: required.',
		'length' => 'Has Alarm: must be 1 digit.',
		'numeric' => 'Has Alarm: must be numeric.',
		'default' => 'Has Alarm: invalid input.'
    ),

	'groupid' => array
    (
        'required' => 'Group Id: required.',
		'numeric' => 'Group Id: must be numeric.',
		'default' => 'Group Id: invalid input.'
    ),

	'modemkind' => array
    (
        'required' => 'Modem Kind: required.',
		'length' => 'Modem Kind: must be 1 digit.',
		'numeric' => 'Modem Kind: must be numeric.',
		'default' => 'Modem Kind: invalid input.'
    )
);
