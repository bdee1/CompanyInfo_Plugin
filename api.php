<?php
/*
*  CI_display
*
*  This is the public function for use in theme.  It is outside the class so it can easily be called by theme developers.
*
*  @param	$type - the type of Company Info to be displayed.  valid types are 'phone' and 'address'
*  @return	$returnval - the formatted value to be displayed
*/
//function for use in themes
function CI_display($type='phone') {
	if ($type =='address') {
		$returnval = get_option('CI_street_address');
		$returnval .= '<br>' . get_option('CI_city') ;
		$returnval .= ', ' . get_option('CI_state') ;
		$returnval .= ' ' . get_option('CI_zip') ;
	} else {
		//if type is phone (default)
		$returnval = get_option('CI_phone');
	}
	
	return $returnval;
}
?>