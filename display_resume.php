<?php

/**
 *Author: Daryl Bennett w/ help from Jim
 *Date: Spring 2014
 *
 *This is the generated resume.
 *
 */

require("Helpers/helper_functions.php");

// first prep the "model"
load_session($resume, $navigation_bar);
$navigation_bar->set_current_page("resume");


//then display the results

echo  build_html_page_header('Resume', '')  .
"

<body>
 

  $navigation_bar

  <hr/>
 <div class='jumbotron'>
  $resume
</div>
  </body>
   <footer style='position: fixed; bottom: 0'>
  	Your resume id: <strong>$resume->id</strong>
  </footer>
</html>
";
?>
