<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: name is required.',
        'msg_duplicate' => 'Id: duplicate id.',
		'default' => 'Id: invalid input.'
    ),
	
	'idname' => array
    (
        'required' => 'User Id: required.',
        'alpha' => 'User Id: must have only alphabetic characters.',
        'length' => 'User Id: must be between 3 - 50 characters.',
        'msg_duplicate' => 'User Id: duplicate user id.',
		'default' => 'User Id: invalid input.'
    ),
	
    'username' => array
    (
        'required' => 'Signon Name: required.',
        'alpha' => 'Signon Name: must have only alphabetic characters.',
        'length' => 'Signon Name: must be between 3 - 32 letters.',
        'msg_duplicate' => 'Signon Name: duplicate signon name.',
		'default' => 'Signon Name: invalid input.'
    ),
	
    'fullname' => array
    (
        'required' => 'Fullname: required.',
        'length' => 'Fullname: must be between 3 - 255 letters.',
        'default' => 'Fullname: invalid input.'
    ),    

    'email' => array
    (
        'required' => 'Email Address: required.',
        'email' => 'Email Address: format is incorrect.',
        'default' => 'Email Address: invalid input.'
    ),

   'enable' => array
    (
        'required' => 'Enabled: required, must be[Y/N].',
        'alpha' => 'Enabled: must be[Y/N].',
        'length' => 'Enabled: must be 1 letter.',
        'default' => 'Enabled: invalid input.'
    ),
	
    'expiry_date' => array
    (
        'required' => 'Expiry Date: required (default 2099-12-31).',
        'date' => 'Expiry Date: invalid date',
        'default' => 'Expiry Date: invalid input.'
    ),    
	
	'branch_id' => array
    (
        'required' => 'Branch Id: required.',
        'length' => 'Branch Id: must be between 2 - 50 letters.',
        'default' => 'Branch Id: invalid input.'
    ),

	'department_id' => array
    (
        'required' => 'Department Id: required.',
        'length' => 'Department Id: must be between 2 - 50 letters.',
        'default' => 'Department Id: invalid input.'
    )
);