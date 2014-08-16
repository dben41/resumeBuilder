<?php

/**
 *Author: Daryl Bennett w/ help from Jimss
 *Date: Spring 2014
 *
 *This is the resume that is generated when a user clicks on
 * the "view" button.
 *
 */

require("Helpers/helper_functions.php");
require("application/db.php");
load_session($resume, $navigation_bar);
$navigation_bar->set_current_page("manage");
echo  build_html_page_header('Manage', '')  .


$statusMsg="";
$resume_view="";
$resume_id="";
//clear the temp vars

 if(isset($_GET['name']))
 {
 	if(resume_exists($_GET['name']))
 	{
 		$resume_id=$_GET['name'];
 		load_view_session($resume_view);
   		 //load
 		load_view($resume_id,$resume_view);
 	} else
 		$resume_view= '<p><em>The specified file does not exist.</em></p>';
 	
 }
 else
 	echo "No file was specified.";
    

//then display the results
echo
"
<!doctype html>
<html lang='en'>
<body>
 


  <hr/>
 <div class='jumbotron'>
 <h2>Your Completed Resume!</h2>
  $resume_view
  <a href='load.php'>Click to go back to Archive Page.</a>
</div>
  </body>
   <footer style='position: fixed; bottom: 0'>
  	This resume id: <strong>$resume_view->id</strong>
  </footer>
</html>
";

?>



