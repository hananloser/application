<?php
/*
	// 
	//Author 	: Abdul Karim AL-H.
	//Country 	: Indonesia
	//Copyright @2020
	//Please Subscribe

	//Note 		: for Describe 
	//For Develeoper  : 
	//this controller to handle Authentication system
	//if you has a problem.... please contact our developer.! 
*/
class Template
{
	 var $template_data = array();
	
	function set($name, $value)
		{
			# code...
			$this->template_data[$name] = $value;

		}
	function load($template= '',
					 $view='',
					  $view_data=array(),
					   $return=FALSE)
		{
			# code...
			$this->CI=&get_instance();
			$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
			return $this->CI->load->view($template, $this->template_data, $return);
		}
}