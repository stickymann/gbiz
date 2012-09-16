<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate id.',
		'default' => 'Id: invalid input.'
    ),
	
	'certificate_id' => array
    (
        'required' => 'Certificate Id: required.',
        'length' => 'Certificate Id: must be 13 -17 characters.',
        'msg_duplicate' => 'Certificate Id: duplicate certificate id.',
		'default' => 'Certificate Id: invalid input.'
    ),

	'certificate_status' => array
    (
        'required' => 'Certificate Status: required.',
        'length' => 'Certificate Status: must be 2 - 10 characters.',
        'active_cert' => 'Certificate Status: active certificate for vehicle already exist.',
		'default' => 'Certificate Status: invalid input.'
    ),

	'vehicle_id' => array
    (
        'required' => 'Vehicle Id: required.',
        'length' => 'Vehicle Id: must be 2 - 100 characters.',
		'default' => 'Vehicle Id: invalid input.'
    ),
	
	'chassis_number' => array
    (
        'required' => 'Chassis Number: required.',
		'length' => 'Chassis Number: must be 2 - 100 characters.',
		'default' => 'Chassis Number: invalid input.'
    ),
	
	'vehicle_type' => array
    (
        'required' => 'Vehicle Type: required.',
		'length' => 'Vehicle Type: must be 2 - 100 characters.',
        'default' => 'Vehicle Type: invalid input.'
    ),

	'vehicle_make' => array
    (
        'required' => 'Vehicle Make: required.',
		'length' => 'Vehicle Make: must be 2 - 100 characters.',
        'default' => 'Vehicle Make: invalid input.'
    ),

	'vehicle_model' => array
    (
        'required' => 'Vehicle Model: required.',
		'length' => 'Vehicle Model: must be 2 - 100 characters.',
        'default' => 'Vehicle Model: invalid input.'
    ),

	'vehicle_colour' => array
    (
        'required' => 'Vehicle Colour: required.',
		'length' => 'Vehicle Colour: must be 2 - 100 characters.',
        'default' => 'Vehicle Colour: invalid input.'
    ),

	'first_name' => array
    (
        'required' => 'First Name: required.',
		'length' => 'First Name: must be 2 - 100 characters.',
        'default' => 'First Name: invalid input.'
    ),

	'last_name' => array
    (
        'required' => 'Last Name: required.',
		'length' => 'Last Name: must be 2 - 100 characters.',
        'default' => 'Last Name: invalid input.'
    ),

	'address1' => array
    (
        'required' => 'Client Address: required.',
		'length' => 'Client Address: must be 2 - 100 characters.',
        'default' => 'Client Address: invalid input.'
    ),

	'city' => array
    (
        'required' => 'Client City: required.',
		'length' => 'Client City: must be 2 - 100 characters.',
        'default' => 'Client City: invalid input.'
    ),

	'installation_type' => array
    (
        'required' => 'Installation Type: required.',
		'length' => 'Installation Type: must be 2 - 100 characters.',
        'default' => 'Installation Type: invalid input.'
    ),

	'device_model' => array
    (
        'required' => 'Device Model: required.',
		'length' => 'Device Model: must be 2 - 100 characters.',
        'default' => 'Device Model: invalid input.'
    ),

	'device_serial_no' => array
    (
        'required' => 'Device Serial No: required.',
		'length' => 'Device Serial No: must be 2 - 100 characters.',
        'default' => 'Device Serial No: invalid input.'
    ),

	'commision_fld01' => array
    (
        'required' => 'Commision Fld01: required.',
		'length' => 'Commision Fld01: must be yes, no or n/a.',
        'default' => 'Commision Fld01: invalid input.'
    ),

	'commision_fld02' => array
    (
        'required' => 'Commision Fld02: required.',
		'length' => 'Commision Fld02: must be yes, no or n/a.',
        'default' => 'Commision Fld02: invalid input.'
    ),

	'commision_fld03' => array
    (
        'required' => 'Commision Fld03: required.',
		'length' => 'Commision Fld03: must be yes, no or n/a.',
        'default' => 'Commision Fld03: invalid input.'
    ),

	'commision_fld04' => array
    (
        'required' => 'Commision Fld04: required.',
		'length' => 'Commision Fld04: must be yes, no or n/a.',
        'default' => 'Commision Fld04: invalid input.'
    ),

	'commision_fld05' => array
    (
        'required' => 'Commision Fld05: required.',
		'length' => 'Commision Fld05: must be yes, no or n/a.',
        'default' => 'Commision Fld05: invalid input.'
    ),

	'commision_fld06' => array
    (
        'required' => 'Commision Fld06: required.',
		'length' => 'Commision Fld06: must be yes, no or n/a.',
        'default' => 'Commision Fld06: invalid input.'
    ),

	'commision_fld07' => array
    (
        'required' => 'Commision Fld07: required.',
		'length' => 'Commision Fld07: must be yes, no or n/a.',
        'default' => 'Commision Fld07: invalid input.'
    ),

	'commision_fld08' => array
    (
        'required' => 'Commision Fld08: required.',
		'length' => 'Commision Fld08: must be yes, no or n/a.',
        'default' => 'Commision Fld08: invalid input.'
    ),

	'commision_fld09' => array
    (
        'required' => 'Commision Fld09: required.',
		'length' => 'Commision Fld09: must be yes, no or n/a.',
        'default' => 'Commision Fld09: invalid input.'
    ),

	'commision_fld10' => array
    (
        'required' => 'Commision Fld10: required.',
		'length' => 'Commision Fld10: must be yes, no or n/a.',
        'default' => 'Commision Fld10: invalid input.'
    ),

	'commision_fld11' => array
    (
        'required' => 'Commision Fld11: required.',
		'length' => 'Commision Fld11: must be yes, no or n/a.',
        'default' => 'Commision Fld11: invalid input.'
    ),

	'commision_fld12' => array
    (
        'required' => 'Commision Fld12: required.',
		'length' => 'Commision Fld12: must be yes, no or n/a.',
        'default' => 'Commision Fld12: invalid input.'
    ),

	'usrinstr_fld01' => array
    (
        'required' => 'Usrinstr Fld01: required.',
		'length' => 'Usrinstr Fld01: must be yes, no or n/a.',
        'default' => 'Usrinstr Fld01: invalid input.'
    ),

	'usrinstr_fld02' => array
    (
        'required' => 'Usrinstr Fld02: required.',
		'length' => 'Usrinstr Fld02: must be yes, no or n/a.',
        'default' => 'Usrinstr Fld02: invalid input.'
    ),

	'usrinstr_fld03' => array
    (
        'required' => 'Usrinstr Fld03: required.',
		'length' => 'Usrinstr Fld03: must be yes, no or n/a.',
        'default' => 'Usrinstr Fld03: invalid input.'
    ),

	'usrinstr_fld04' => array
    (
        'required' => 'Usrinstr Fld04: required.',
		'length' => 'Usrinstr Fld04: must be yes, no or n/a.',
        'default' => 'Usrinstr Fld04: invalid input.'
    ),

	'usrinstr_fld05' => array
    (
        'required' => 'Usrinstr Fld05: required.',
		'length' => 'Usrinstr Fld05: must be yes, no or n/a.',
        'default' => 'Usrinstr Fld05: invalid input.'
    ),

	'usrinstr_fld06' => array
    (
        'required' => 'Usrinstr Fld06: required.',
		'length' => 'Usrinstr Fld06: must be yes, no or n/a.',
        'default' => 'Usrinstr Fld06: invalid input.'
    ),

	'usrinstr_fld07' => array
    (
        'required' => 'Usrinstr Fld07: required.',
		'length' => 'Usrinstr Fld07: must be yes, no or n/a.',
        'default' => 'Usrinstr Fld07: invalid input.'
    ),

	'usrinstr_fld08' => array
    (
        'required' => 'Usrinstr Fld08: required.',
		'length' => 'Usrinstr Fld08: must be yes, no or n/a.',
        'default' => 'Usrinstr Fld08: invalid input.'
    ),

	'usrinstr_fld09' => array
    (
        'required' => 'Usrinstr Fld09: required.',
		'length' => 'Usrinstr Fld09: must be yes, no or n/a.',
        'default' => 'Usrinstr Fld09: invalid input.'
    ),

	'usrinstr_fld10' => array
    (
        'required' => 'Usrinstr Fld10: required.',
		'length' => 'Usrinstr Fld10: must be yes, no or n/a.',
        'default' => 'Usrinstr Fld10: invalid input.'
    ),

	'usrinstr_fld11' => array
    (
        'required' => 'Usrinstr Fld11: required.',
		'length' => 'Usrinstr Fld11: must be yes, no or n/a.',
        'default' => 'Usrinstr Fld11: invalid input.'
    ),

	'usrinstr_fld12' => array
    (
        'required' => 'Usrinstr Fld12: required.',
		'length' => 'Usrinstr Fld12: must be yes, no or n/a.',
        'default' => 'Usrinstr Fld12: invalid input.'
    ),

	'variations' => array
    (
        'required' => 'Variations: required.',
		'length' => 'Variations: must be 2 - 100 characters.',
        'default' => 'Variations: invalid input.'
    ),

	'validation_period' => array
    (
        'required' => 'Validation Period: required.',
		'length' => 'Validation Period: must be 2 - 100 characters.',
        'default' => 'Validation Period: invalid input.'
    ),

	'expiry_date' => array
    (
        'required' => 'Expiry Date: required.',
		'length' => 'Expiry Date: must be 10 characters.',
        'alpha_dash' => 'Expiry Date: date format is incorrect (YYYY-MM-DD).',
		'default' => 'Expiry Date: invalid input.'
	),

	'issue_date' => array
    (
        'required' => 'Issue Date: required.',
		'length' => 'Issue Date: must be 10 characters.',
        'alpha_dash' => 'Issue Date: date format is incorrect (YYYY-MM-DD).',
		'default' => 'Issue Date: invalid input.'
	),

	'signature_name' => array
    (
        'required' => 'Signature Name: required.',
		'length' => 'Signature Name: must be 2 - 100 characters.',
        'default' => 'Signature Name: invalid input.'
    ),

	'signature_position' => array
    (
        'required' => 'Signature Position: required.',
		'length' => 'Signature Position: must be 2 - 100 characters.',
        'default' => 'Signature Position: invalid input.'
    )
);