<?php
/*
Plugin Name: Salay Slip Management
Plugin URI: https://www.haysky.com/
Description: Salary slips, List of Employees, KYC forms etc.
*/
error_reporting(E_ERROR | E_PARSE);
function hs_mat_admin_menu() {
	add_menu_page('HR Management', 'HR Management', 'manage_options', 'admin_salary_slip', 'admin_salary_slip', 'dashicons-heart', '2');
	add_submenu_page('admin_salary_slip', 'Employees', 'Employees', 'manage_options', 'employees', 'employees');
	add_submenu_page('admin_salary_slip', 'Salary slips', 'Salary slips', 'manage_options', 'list_of_salary_slips', 'list_of_salary_slips'); //*/
}
add_action('admin_menu', 'hs_mat_admin_menu');


function salary_slip() {
	include(dirname(__FILE__) . '/salary_slip.php');
}

function admin_salary_slip() {
	include(dirname(__FILE__) . '/admin_salary_slip.php');
}

function list_of_salary_slips() {
	include(dirname(__FILE__) . '/list_of_salary_slips.php');
}

function employees() {
	include(dirname(__FILE__) . '/employees.php');
}