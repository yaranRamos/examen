<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('validation_errors_to_array')){
	function validation_errors_to_array($validation_rules = ''){
	$errors_array = array();
		foreach($validation_rules as $row){
			$field = $row['field'];
			$error = form_error($field);
			if($error)
			$errors_array[$field] = $error;
		}
		return $errors_array;
	}
}