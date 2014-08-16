<?php

require("classes/resume.php");
require("classes/navigation_bar.php");


/**
 *Author: Daryl Bennett
 *Date: Spring 2014
 *
 *These are some basic functions used throughout the program
 */

// Return the value of the parameter $param if it exists.
// Otherwise, return $default.
function getParam ($param, $default)
{
	return (isset($_REQUEST[$param])) ? $_REQUEST[$param] : $default;
}



/**
 * 
 * start the session and load the appropraite variables
 * (as references to the data stored in the session)
 */

function load_session(&$resume, &$navigation_bar)
{
	session_start();
	
	if (! isset($_SESSION['resume']) )
	{
		$_SESSION['resume']         = new Resume();
		$_SESSION['navigation_bar'] = new Navigation_Bar();
	}

	$resume         =  $_SESSION['resume'];
	$navigation_bar =  $_SESSION['navigation_bar'];
}

/**
 *This function is to load all the appropiate variables into
 *the view
 */
function load_view_session (&$resume_view)
{
	//session_start();
	if(! isset($_SESSION['resume_view']))
	{
		$_SESSION['resume_view']    =new Resume();
	}
	$resume_view		= $_SESSION['resume_view'];
}

/**
 *This is a helper function to display a select bar with all the resumes in the database
 */
function createResumeOptions($resumeTypes/*,selected*/)
{
	$result ='';
	//TODO create an option to see which one is selected
	foreach($resumeTypes as $name_id)
	{
		$result= $result . "<option value=$name_id>$name_id</option>";
	}
	return $result;
}

/**
 * Build the common HTML header, including CSS links!
 */
function build_html_page_header( $title, $other )
{
 return "
 	   <!doctype html>
 	   <html>
 		 <head>
 		 	<title> $title </title>
            <link href='CSS/resume.css' rel='stylesheet' type='text/css'/>
            <script src='//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js' type='text/javascript'></script>
   			 <script type='text/javascript' src='controller.js'></script>

            <script type='text/javascript' src='js/bootstrap.min.js'></script>
			<link rel='stylesheet' href='CSS/bootstrap.min.css'/>

			<!--borrowed from http://www.youtube.com/watch?v=XXgI8y0d4LU-->
		 	<script type='text/javascript'>
				$(function(){
					$('#btn-show-modal').click(function(e)){
						e.preventDefault();

						$('#dialog-example').modal('show');					
					});
				$('btn-save').click(function(e){
					e.preventDefault();
					alert('saved!');
					$('#dialog-example').modal('hide');
					});
				});	
			</script>
 		    $other
         </head>
 		";
}

?>

