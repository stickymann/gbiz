<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate id.',
		'default' => 'Id: invalid input.'
    ),
	
	'customer_id' => array
    (
        'required' => 'Customer Id: required.',
        'length' => 'Customer Id: must be 8 characters.',
        'msg_duplicate' => 'Customer Id: duplicate customer id.',
		'default' => 'Customer Id: invalid input.'
    ),

	'customer_type' => array
    (
        'required' => 'Customer Type: required.',
        'length' => 'Customer Type: must be 8 characters.',
		'default' => 'Customer Type: invalid input.'
    ),
		
	'first_name' => array
    (
        'required' => 'First Name: required.',
        'length' => 'First Name: must be between 2 - 255 letters.',
        'default' => 'First Name: invalid input.'
    ),  
	
	'last_name' => array
    (
        'required' => 'Last Name: required.',
        'length' => 'Last Name: must be between 2 - 255 letters.',
        'default' => 'Last Name: invalid input.'
    ),    

    'address1' => array
    (
        'required' => 'Street Address: Street Address is required.',
        'length' => 'Street Address: Street Address must be between 1 - 255 letters.',
        'default' => 'Street Address: invalid input.'
    ),
	
	'city' => array
    (
        'required' => 'City: required.',
        'length' => 'City: must be between 1 - 255 letters.',
        'default' => 'City: invalid input.'
    ),
	
	'region_id' => array
    (
        'required' => 'Region Id: required.',
        'numeric' => 'Region Id: must be numeric.',
        'default' => 'Region Id: invalid input.'
    ),
	
	'country_id' => array
    (
        'required' => 'Country Id: required.',
        'length' => 'Country Id: must be 2 letters.',
		'default' => 'Country Id: invalid input.'
    ),
	
	'date_of_birth' => array
    (
        'length' => 'Date Of Birth: must be 10 characters.',
        'alpha_dash' => 'Date Of Birth: date format is incorrect (YYYY-MM-DD).',
		'default' => 'Date Of Birth: invalid input.'
    ),
	
	'gender' => array
    (
        'required' => 'Gender: required, must be[M/F/N].',
        'alpha' => 'Gender: must be[M/F/N].',
        'length' => 'Gender: must be 1 character.',
        'default' => 'Gender: invalid input.'
    ),

	'email_address' => array
    (
        'email' => 'Email Address: format is incorrect.',
        'default' => 'Email Address: invalid input.'
    ),
	
	'phone_home' => array
    (
        'numeric' => 'Phone Number(home): must be 7 digits.',
        'default' => 'Phone Number(home): invalid input.'
    ),

	'phone_work' => array
    (
        'numeric' => 'Phone Number(work): must be 7 digits.',
        'default' => 'Phone Number(work): invalid input.'
    ),

	'phone_mobile1' => array
    (
        'required' => 'Phone Number(mobile1): required.',
		'numeric' => 'Phone Number(mobile1): must be 7 digits.',
        'default' => 'Phone Number(mobile1): invalid input.'
    ),

	'phone_mobile2' => array
    (
        'numeric' => 'Phone Number(mobile2): must be 7 digits.',
        'default' => 'Phone Number(mobile2): invalid input.'
    ),
	
	'driver_permit' => array
    (
        'required' => 'Driver\'s Permit: required.',
        'default' => 'Driver\'s Permit: invalid input.'
    ),
	
	'driver_permit_expiry_date' => array
    (
        'length' => 'Driver\'s Permit Expiry Date: must be 10 characters.',
        'alpha_dash' => 'Driver\'s Permit Expiry Date: format is incorrect (YYYY-MM-DD).',
		'default' => 'Driver\'s Permit Expiry Date: invalid input.'
    ),
		
	'branch_id' => array
    (
        'required' => 'Branch Id: required.',
        'length' => 'Branch Id: must be between 2 - 50 letters.',
        'default' => 'Branch Id: invalid input.'
    )
);
