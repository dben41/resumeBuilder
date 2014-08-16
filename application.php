<?php 
/**Some functions have been ommited for the preview**/


/**
 *This stores a resume, simpler than UPDATE
 */
function save_resume($resume_id,$resume)
{
	try {
		//set resume to have resume id
		$resume->set_id($resume_id);
	
		//delete resume if it already exists in the database
		delete_resume($resume_id);

		//open connection
		$DBH = openDBConnection();
		$DBH->beginTransaction();
		//insert the contact info
		$stmt = $DBH->prepare("INSERT INTO user (id, name, phone, pos_desired, address) 
		VALUES (?,?,?,?,?)");
		$stmt->bindValue(1, $resume->id); //TODO idk what I'll do with this todavia
		$stmt->bindValue(2, $resume->person->name);
		$stmt->bindValue(3, $resume->person->phone);
		$stmt->bindValue(4, $resume->position);
		$stmt->bindValue(5, $resume->person->address);
		$stmt->execute();			

		//Inserts all the jobs 
		$job_count= $resume->jobs->length();
		for ($i =0; $i < $job_count; $i++)
		{
			$stmt = $DBH->prepare("INSERT INTO jobs (title, description, start_date, end_date, id)
				VALUES (?, ?, ?, ?,?)");
			$stmt->bindValue(1, $resume->jobs->jobs[$i]->title);
			$stmt->bindValue(2, $resume->jobs->jobs[$i]->job_desc);
			$stmt->bindValue(3, $resume->jobs->jobs[$i]->begin_date);
			$stmt->bindValue(4, $resume->jobs->jobs[$i]->end_date);
			$stmt->bindValue(5, $resume->id);
			$stmt->execute();			
		}		

		$DBH->commit();
		return true;

	} catch (PDOException $e) {
		reportDBError($e);
	}

}


/**
 *Deletes Resume
 */
function delete_resume($resume_id) {
	try {
		//open connection
		$DBH = openDBConnection();
		$DBH->beginTransaction();
		//delete values
		$stmt = $DBH->prepare("DELETE FROM jobs where id=?");
		$stmt->bindValue(1, $resume_id);
		$stmt->execute();
		$stmt = $DBH->prepare("DELETE FROM user where id=?");
		$stmt->bindValue(1, $resume_id);
		$stmt->execute();
		$DBH->commit();
		return true;

	}
	catch (PDOException $e) {
		reportDBError($e);
	}
}

/**
 *Checks if the resume is in the database
 */
function resume_exists ($resume_id)
{
	try{
		//do the database query
		$DBH = openDBConnection();
		$stmt =$DBH->prepare("SELECT id FROM user WHERE id=?");
		$stmt->bindValue(1,$resume_id);
		$stmt->execute();

		//check if the result is null
		if($row = $stmt->fetch())
		{
			return true;
		} else{
			return false;
		}


	} catch (PDOException $e) {
		reportDBError($e);
	}
}
/**
 *This function loads a resume from the database from $resume_id
 */
function load_resume ($resume_id,$resume)
{
	try
	 {
		$DBH = openDBConnection();
		$stmt = $DBH->prepare("SELECT * FROM user WHERE id=? ");
		$stmt->bindValue(1, $resume_id);
		$stmt->execute();

		//load personal values
		if ($row = $stmt->fetch()) 
		{
			$resume->id = $row['id'];
			$resume->person->name= $row['name'];
			$resume->person->phone = $row['phone'];
			$resume->person->address = $row['address'];		
			$resume->position = $row['pos_desired']; 	
		}
		//get employmeny history
		$stmt = $DBH->prepare("SELECT * FROM jobs WHERE id=? ");	
		$stmt->bindValue(1, $resume->id);	
		$stmt->execute();

		$result = $stmt->fetchAll(); 
		//unset the old vars
		unset($_SESSION['beg']);
		unset($_SESSION['end']);
		unset($_SESSION['job']);
		unset($_SESSION['desc']);
		//create new arrays
		$beg = array();
		$end = array();
		$job = array(); 
		$desc = array(); 

		//add values into arrays
		foreach($result as $r)
		{
			array_push($job, $r['title']);
			array_push($beg, $r['start_date']);
			array_push($end, $r['end_date']);
			array_push($desc, $r['description']);
		}
		
		$resume->jobs->set_jobs($job, $beg, $end, $desc);

	}

	catch (PDOException $e) {
		reportDBError($e);
		echo "There was a fatal error!";
	}

}



