<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Allows a template to be automatically loaded and displayed. Display can be
 * dynamically turned off in the controller methods, and the template file
 * can be overloaded.
 *
 * To use it, declare your controller to extend this class:
 * `class Your_Controller extends Template_Controller`
 *
 * $Id: template.php 3769 2008-12-15 00:48:56Z zombor $
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
abstract class Template_Controller extends Controller {

	// Template view name
	public $template = 'template';

	// Default to do auto-rendering
	public $auto_render = TRUE;

	/**
	 * Template loading and setup routine.
	 */
	public $randomstring = ""; 
	public $jquery_js	= 'media/js/jquery-1.7.min.js';
	public $easyui_js	= 'media/js/jquery.easyui.min.js';
	public $datepick_js	= 'media/js/jquery.datepick.js';
	
	public $easyui_css	= 'media/css/easyui/gray/easyui.css';
	public $easyui_icon	= 'media/css/easyui/icon.css';
	public $site_css	= 'media/css/site.css';
	public $datepick_css= 'media/css/custom.datepick.css';
	
	public function __construct()
	{
		parent::__construct();
		/** 
			Random string injection to prevent javascript caching
			Added by dunstan.nesbit@gmail.com
		**/
		$rs = new Siterandstr_Controller();
		$this->randomstring	= sprintf('?rash=%s',$rs->getRandomString());
		$this->jquery_js	= $this->jquery_js.$this->randomstring;
		$this->easyui_js	= $this->easyui_js.$this->randomstring;
		$this->datepick_js	= $this->datepick_js.$this->randomstring;
		
		// Load the template
		$this->template = new View($this->template);

		if ($this->auto_render == TRUE)
		{
			// Render the template immediately after the controller method
			Event::add('system.post_controller', array($this, '_render'));
		}
	}

	/**
	 * Render the loaded template.
	 */
	public function _render()
	{
		if ($this->auto_render == TRUE)
		{
			// Render the template when the class is destroyed
			$this->template->render(TRUE);
		}
	}

} // End Template_Controller