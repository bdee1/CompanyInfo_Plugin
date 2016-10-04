# Company Info Plugin for Wordpress

This is a simple wordpress plugin to let you store the company phone number and address for output in the theme.

After activating the plugin, you will notice a new menu in admin called "Company Information."

Clicking on that will take you to the options page where you can specify a company phone number and address.

##To display the Company Info on your site:
There are two ways to display the stored company info on your website.  You can either use a shortcode, or you can use a function.

###Using the shortcode
Simply use [CompanyInfo type=phone] to display the phone number or [CompanyInfo type=address] to display the address.


###Using the function
If you would like to display the phone number or address in your Theme, just use the CI_display() function.
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
