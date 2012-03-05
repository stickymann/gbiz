<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate id.',
		'default' => 'Id: invalid input.'
    ),
	
	'vehicle_id' => array
    (
        'required' => 'Vehicle Id: required.',
        'length' => 'Vehicle Id: must be 3 - 20 characters.',
        'msg_duplicate' => 'Vehicle Id: duplicate id.',
		'default' => 'Vehicle Id: invalid input.'
    ),
	
	'owner_id' => array
    (
        'required' => 'Owner Id: required.',
        'length' => 'Owner Id: must be 8 characters.',
		'default' => 'Owner Id: invalid input.'
    ),
	
	'device_id' => array
    (
        'required' => 'Device Id: required.',
        'length' => 'Device Id: must be 3 - 50 characters.',
		'default' => 'Device Id: invalid input.'
    ),
	
	'chassis_number' => array
    (
        'required' => 'Chassis Number: required.',
        'length' => 'Device Id: must be 3 - 50 characters.',
		'default' => 'Chassis Number: invalid input.'
    ),

	'make' => array
    (
        'required' => 'Make: required.',
        'length' => 'Make: must be 3 - 50 characters.',
		'default' => 'Make: invalid input.'
    ),
		
	'model' => array
    (
        'required' => 'Model: required.',
        'length' => 'Model: must be 3 - 50 characters.',
		'default' => 'Model: invalid input.'
    ),

	'color' => array
    (
        'required' => 'Color: required.',
        'length' => 'Color: must be 3 - 50 characters.',
		'default' => 'Color: invalid input.'
    ),
		
	'installer' => array
    (
        'required' => 'Installer: required.',
        'length' => 'Installer: must be 3 - 50 characters.',
		'default' => 'Installer: invalid input.'
    ),
		
	'location' => array
    (
        'required' => 'Location: required.',
        'length' => 'Location: must be 3 - 50 characters.',
		'default' => 'Location: invalid input.'
    ),
	
	'installation_date' => array
    (
        'required' => 'Installation Date: required.',
		'length' => 'Installation Date: must be 10 characters.',
        'alpha_dash' => 'Installation Date: format is incorrect (YYYY-MM-DD).',
		'default' => 'Installation Date: invalid input.'
    )
);