<?php
/**
 *Author: Daryl Bennett w/help from Jim's code
 *Date: Spring 2014
 *
 *This class represents the navigation bar, and keeps track of state
 */



class Navigation_Bar
{
	private $current_page;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->current_page = "resume";
	}
	
	/**
	 * set the current page
	 */
	public function set_current_page( $page )
	{
		// verify valid pages
		if ($page =="manage" || $page == "contact" || $page == "position" ||  $page == "employment" || $page == "resume" || $page == "clear" || $page == "home" )
		{
			$this->current_page = $page;
		}      
		else
		{
			error_log("tried to set an invalid page as the current navigation page!\n"); 
		}
		
	}
	

	/**
	 * Print a concise (for debugging) string representation of the resume object
	 *
	 * @return string
	 */
	public function __toString()
	{
		if ($this->current_page == "home")     $current_home  = 'class="current"'; else $current_home = "";
		if ($this->current_page == "manage")     $current_manage  = 'class="current"'; else $current_manage  = "";
		if ($this->current_page == "contact")     $current_contact  = 'class="current"'; else $current_contact  = "";
		if ($this->current_page == "position")    $current_position = 'class="current"'; else $current_position = "";
		if ($this->current_page == "employment")  $current_employ   = 'class="current"'; else $current_employ   = "";
		if ($this->current_page == "resume")      $current_resume   = 'class="current"'; else $current_resume   = "";
		if ($this->current_page == "clear")       $current_clear    = 'class="current"'; else $current_clear   = "";
		
		return 
		" 
<div class='container'>
		<!-- Static navbar -->
      <div class='navbar navbar-inverse navbar-fixed-top role='navigation'>
        <div class='container-fluid'>
          <div class='navbar-header'>
            <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
              <span class='sr-only'>Toggle navigation</span>
				<span class='icon-bar'></span>
              <span class='icon-bar'></span>
              <span class='icon-bar'></span>
            </button>
			<a class='navbar-brand' href='#''>Rockin Resume</a>
          </div>
		
		  	<div class='navbar-collapse collapse'>
            <ul class='nav navbar-nav'>

		  		<li  ><a $current_contact data-toggle='tooltip' data-placement='left' title='Go to home/help display' href='index.php'> Home/Help  </a></li>
				<li><a $current_contact data-toggle='tooltip' data-placement='left' title='Enter your personal information' href='contact_information.php'> Contact Information   </a></li>
				<li><a $current_position  data-toggle='tooltip' data-placement='left' title='What position do you seek?' href='position_sought.php'>     Position Sought       </a></li>
				<li><a $current_employ   data-toggle='tooltip' data-placement='left' title='This is your past work experience' href='employment_history.php'>  Employment History    </a></li>
				<li><a $current_resume    data-toggle='tooltip' data-placement='left' title='See your resume!' href='display_resume.php'>      Display Resume        </a></li>
				<li><a $current_manage  data-toggle='tooltip' data-placement='left' title='This is your own personal archive!' href='load.php'>      Manage Resumes        </a></li>
				<!--li><a $current_clear    href='clear_session.php'>       Clear Session (Debug) </a></li-->
			</ul>
			
		</div>

			</div>	
		</div>
			</div>	
		";
	}



}
