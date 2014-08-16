<?php
/**
 *Author: Daryl Bennett w/ help of Jim's code
 *Date: Spring 2014
 *
 *This is a class file of the history of jobs
 */



class History
{
	public $jobs;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->jobs = array();
	}
	
	
	/**
	 *  add job
	 *
	 */
	function add_job($job_title, $beg_date, $end_date, $job_desc)
	{
		$this->job[] = new Job($job_title, $beg_date, $end_date, $job_desc);
	}
	
	/**
	 * 
	 * build the java script string for the jobs list
	 * 
	 * @return string
	 */
	function build_java_script()
	{
		$js = "";
		
		for ($i=0; $i< count($this->jobs); $i++)
		{
			$js .= $this->jobs[$i]->build_java_script();
		}
		
		return $js;
	}
	
	/**
	 * set the jobs array based on the input from the form
	 */
	function set_jobs($job_array, $beg_array, $end_array, $des_array)
	{
		$this->jobs = array();
		for ($i=0; $i<count($beg_array); $i++)
		{
			$this->jobs[] = new Job($job_array[$i], $beg_array[$i], $end_array[$i], $des_array[$i]);
		}
	}
	
	/**
	 * 
	 * output an html rep of jobs
	 */
	public function __toString()
	{
		$output = 
		"<table border='1'>
		   <thead>  
		     <tr>
		       <th> Title </th>
		       <th> Start Date </th>
		       <th> End date</th>
		       <th> Description </th>
		     </tr>
		   </thead>
		   <tbody>
	    ";
		
		for ($i=0; $i<count($this->jobs); $i++)
		{
			$output .="<tr><td>{$this->jobs[$i]->title}</td>
			               <td>{$this->jobs[$i]->begin_date}</td>
			               <td>{$this->jobs[$i]->end_date}</td>
			               <td>{$this->jobs[$i]->job_desc}</td></tr>";
		}
		
		$output .= "</tbody></table>";
		
		return $output;
		
		
	}

	/**
	 *Returns the count of the jobs
	 */
	public function length()
	{
		return count($this->jobs);
	}
	
}




class Job
{
	public $title;
	public $begin_date;
	public $end_date;
	public $job_desc;

	/**
	 * Constructor
	 */
	public function __construct($job, $beg, $end, $desc)
	{
		$this->title      = $job;
		$this->begin_date = $beg;
		$this->end_date   = $end;
		$this->job_desc   = $desc;
	}

	/**
	 * Compose JavaScript that will create job forms
	 *
	 */
	public function build_java_script()
	{
		$jVal = $this->title;
		$sVal = $this->begin_date;
		$eVal = $this->end_date;
		$dVal = $this->job_desc;
		$jVal = strtr($jVal, array("\r" => "\\r",	"\n" => "\\n"));
		$sErr = 'false'; // check($sVal);
		$eErr = 'false'; // check($eVal);
		$jErr = 'false'; // check($jVal);
		$dErr = 'false'; //check($jval);
		return "addJob('$jVal', '$sVal', '$eVal', '$dVal', $sErr, $eErr, $jErr, $dErr);\n";
	}


}
