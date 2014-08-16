<?php

/**
 *Author: Daryl Bennett w/ help from Jim's code
 *Date: Spring 2014
 *
 *This allows for a user to type in their information
 *
 */

require("Helpers/helper_functions.php");

echo build_html_page_header("Contact Information", ""); 

echo "<body>";

load_session($resume, $navigation_bar);

$navigation_bar->set_current_page("contact");

echo $navigation_bar;


if (isset($_REQUEST['save'])&&$_REQUEST['name'])
{
	$valid_name  = $resume->person->set_name($_REQUEST['name']);
	$valid_addr  = $resume->person->set_address($_REQUEST['address']);
	$valid_phone = $resume->person->set_phone($_REQUEST['phone']);
	$valid_email = $resume->person->set_email($_REQUEST['email']);

}
else
{
	$valid_name = "";
	$valid_addr = "";
	$valid_phone = "";
	$valid_email = "";
}


echo "
<hr/>


<!--p><a href='#' id='btn-show-modal'>Show modal dialog</a></p>
<div class='modal hide' id='dialog-example'>
  <div class='modal-header'> 
      <h2>Help Menu</h2>
  </div>
   <div class='modal-body'>
      <p>This is how to use my program.</p>
  </div>
   <div class='modal-footer'>
        <a href='#' class='btn'>Close</a>
        <a href='#' class='btn btn-primary'>Save</a>
  </div>
</div-->

<!-- Main component for a primary marketing message or call to action -->
      <div class='jumbotron'>
        <h2>Welcome to the Rockin Resume</h2>
<p> Please enter your name, address, and phone number</p> 

<form method='post'>

<table class='block'>
 <tr>
   <td $valid_name> <font color=red>*</font> Name</td>
   <td><input class='contact' placeholder= 'Please Enter Name' required type='text' name='name'
         value='{$resume->person->name}'></td>
 </tr>
 <tr>
  <td $valid_addr><font color=red>*</font> Address</td>
  <td><input class='contact' placeholder= 'Please Enter Address' required type='text' name='address'
         value='{$resume->person->address}'/></td>
 </tr>
 <tr>
  <td $valid_phone><font color=red>*</font> Phone</td>
  <td><input class='contact' placeholder= 'Please Enter Phone' required type='text' name='phone'
         value='{$resume->person->phone}'/></td>
 </tr>
  <tr>
  <td $valid_email><font color=white>*</font> Email</td>
  <td><input class='email' placeholder= 'Please Enter Email' type='text' name='email'
         value='{$resume->person->email}'/></td>
 </tr>
</table>
<hr />
<p>
<input class ='btn btn-primary'  type='submit' name='save' value='Save'/>
</p>

</form>
<hr />
    <p><font color=red>*</font> Indicates a required field.</p>
      </div> 

		

		
		";



echo "</body>

 <footer style='position: fixed; bottom: 0'>
    Your resume id: <strong>$resume->id</strong>
  </footer>
</html>";






