<?php defined('SYSPATH') or die('No direct script access.');

$lang = array
(
    'id' => array
    (
        'required' => 'Id: required.',
        'msg_duplicate' => 'Id: duplicate Id.',
		'default' => 'Id: invalid input.',
    ),
	
	'vw' => array
    (
        'required' => 'Message Read: required.',
		'length' => 'Message Read: must be Y or N.',
		'default' => 'Message Read: invalid input.',
    ),

	'recipient' => array
    (
        'required' => 'Recipient: required.',
        'length' => 'Recipient: must be 1 - 50 characters.',
		'default' => 'Recipient: invalid input.',
    ),
		
	'sender' => array
    (
        'required' => 'Sender: required.',
        'length' => 'Sender: must be between 2 - 50 characters.',
        'default' => 'Sender: invalid input.',
    ),
	
	'subject' => array
    (
        'required' => 'Subject: required.',
        'length' => 'Subject: must be between 1 - 255 characters.',
        'default' => 'Subject: invalid input.',
    ),
	
	'body' => array
    (
        'required' => 'Message: required.',
        'default' => 'Message: invalid input.',
    )  
);
