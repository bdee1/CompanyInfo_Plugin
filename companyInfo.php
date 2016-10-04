<?php
   /*
   Plugin Name: Company Info
   Plugin URI: http://www.blairdee.com
   Description: This plugin adds an admin panel which lets you specify a company phone number and address to store in the wordpress database.  You can use a shortcode to easily drop the info onto any page.
   Version: 1.0
   Author: Blair Dee
   Author URI: http://www.blairdee.com
   License: GPL2
   */
   
   
// Define our plugin's wrapper class
if ( !class_exists( "CompanyInfo" ) )
{
	class CompanyInfo
	{
		
		/*
		*  Constructor
		*
		*  This is the constructor function for our plugin class
		*
		*  @param	N/A
		*  @return	N/A
		*/
		function __construct()
		{
			//specify a method to run on plugin activation
			//register_activation_hook( __FILE__, array($this, 'run_on_activate') );
			
			// incudes
			include_once('api.php'); //include the functions which caan be called from a theme.
			
			
			// adds our plugin options page to admin
			add_action('admin_menu', array($this, 'CI_add_settings_page'));
			
			// Default settings options into database if they do NOT exist
			if(get_option('CI_phone')==null)
				update_option('CI_phone','');
			if(get_option('CI_street_address')==null)
				update_option('CI_street_address','');
			if(get_option('CI_city')==null)
				update_option('CI_city','');
			if(get_option('CI_state')==null)
				update_option('CI_state','');
			if(get_option('CI_zip')==null)
				update_option('CI_zip','');
			
			// This adds support for a "CompanyInfo" shortcode
			 add_shortcode( 'CompanyInfo', array( $this, 'CI_shortcode_fn' ) );
			 
		} //end constructor method
		
		/*
		*  CI_add_settings_page
		*
		*  add the custom menu item to admin
		*
		*  @param	N/A
		*  @return	N/A
		*/
		function CI_add_settings_page () {
			add_menu_page('Company Info Settings', 'Company Information', 'manage_options', 'CI-admin-settings', array($this, 'CI_admin_settings'), 'dashicons-location-alt', 30);
		}
		
		/*
		*  CI_admin_settings
		*
		*  display and process the admin settings page
		*
		*  @param	N/A
		*  @return	N/A
		*/
		//
		function CI_admin_settings() {
			// get default option values from database
			$CI_phone = get_option( 'CI_phone');
			if (strlen($CI_phone)) {
				$ar_phone = explode("-", $CI_phone);
				$CI_phone_1 = $ar_phone[0];
				$CI_phone_2 = $ar_phone[1];
				$CI_phone_3 = $ar_phone[2];
			}
			
			$CI_street_address = get_option('CI_street_address');
			$CI_city = get_option('CI_city');
			$CI_state = get_option('CI_state');
			$CI_zip = get_option('CI_zip');
			
			if(isset($_POST['submit'])){
				//get values from form post
				// Get all $_POST values into variables
				$CI_phone_1 = $_POST['phone_number_1'];
				$CI_phone_2 = $_POST['phone_number_2'];
				$CI_phone_3 = $_POST['phone_number_3'];
				$CI_phone = $CI_phone_1 . "-" . $CI_phone_2 . "-" . $CI_phone_3;
				$CI_street_address = $_POST['street_address'];
				$CI_city = $_POST['city'];
				$CI_state = $_POST['state'];
				$CI_zip = $_POST['zip'];
				
				// insert values into wp_options
				update_option('CI_phone', $CI_phone);
				update_option('CI_street_address', $CI_street_address);
				update_option('CI_city', $CI_city);
				update_option('CI_state', $CI_state);
				update_option('CI_zip', $CI_zip);
				
				echo '<div class="notice notice-success is-dismissable">';
				echo '<p> ' . _e( 'Company Info Updated!' ) . '</p>';
				echo '</div>';
				
				
			}// End IF: Check for submit post
			
			
			echo '<form action="admin.php?page=CI-admin-settings" method="post" name="settings_update">';
			echo '<div class="wrap"><h2>Company Information</h2></div>';
			echo '<p>Enter your company information below.</p>';
			echo '<label for="phone_number">Phone Number</label><br>';
			echo '<input type="text" name="phone_number_1" id="phone_number_1" value="'.$CI_phone_1.'" size="3">';
			echo '<input type="text" name="phone_number_2" id="phone_number_2" value="'.$CI_phone_2.'" size="3">';
			echo '<input type="text" name="phone_number_3" id="phone_number_3" value="'.$CI_phone_3.'" size="4">';
			echo '<br>';
			echo '<label>Address</label><br>';
			echo '<input type="text" name="street_address" id="street_address" value="'.$CI_street_address.'" size="30"><br>';
			echo '<input type="text" name="city" id="city" value="'.$CI_city.'" size="30">, <input type="text" name="state" id="state" value="'.$CI_state.'" size="2"><br>';
			echo '<input type="text" name="zip" id="zip" value="'.$CI_zip.'" size="5"><br>';
			
			submit_button();
			echo '</form>';
		} // End Function:	CI_admin_settings
		
		
		/*
		*  CI_shortcode_fn
		*
		*  method to handle the shortcode for displaying company info in your site.
		*
		*  @param	$attributes - the sttributes specified in the shortcode
		*  @return	$returnval - the formatted value to be displayed
		*/
		function CI_shortcode_fn( $attributes ) {
			// get optional attributes and assign default values if not present
			//type can be either 'phone' or 'address'
			extract( shortcode_atts( array( 'type' => 'phone' ), $attributes ) );
			
			$returnval = CI_display($type);
			return $returnval;
		}
	
	} // End Class
} // End If

// Instantiating the Class
if (class_exists("CompanyInfo")) {
	$CompanyInfo = new CompanyInfo();
}
