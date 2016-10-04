# Company Info Plugin for Wordpress

This is a simple wordpress plugin to let you store the company phone number and address for output in the theme.

After activating the plugin, you will notice a new menu in admin called "Company Information."

Clicking on that will take you to the options page where you can specify a company phone number and address.

To display the Company Info on your site:
1) you can use a shortcode to diisplay the phone number or the address in your sites content.  Simply use [CompanyInfo type=phone] to dispplay the phone number or [CompanyInfo type=address] to display the address.

2) If you would like to display the phone number or address in your Theme, just use the CI_display() function.
CI_display take one string argument which specifies the type of data to return.  This can either be 'phone' or 'address'.
This function will return the formatted value but will not actually display it.  To display it you have to follow you call to CI_display with an echo statement.

```
<?php
  $phone = CI_display('phone');
  echo $phone;
  
  $address = CI_display('address');
  echo $address;
?>
```
