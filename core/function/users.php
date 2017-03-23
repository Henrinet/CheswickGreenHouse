<?php

function logged_in(){
	return (isset($_SESSION["MemberID"])) ? true:false;
}

function user_exists($user) {
	
	global $db, $user, $pass1;

	$search1= trim(mysqli_real_escape_string($db,$user));
	//$search2= trim(mysqli_real_escape_string($db,$pass1));
	$table= "member";
	$sourse_col1= "MemUser";
	//$sourse_col2= "password";
	$field1= "MemberID";
	//$field2= "MemUser";
		
	//$user= sanitize($user);
	$sql= "SELECT ".$field1." FROM ".$table." WHERE ".$sourse_col1." =? ";
	if (!$result = $db->prepare($sql)){
    die('Query failed: (' . $db->errno . ') ' . $db->error);
	}
	
	if (!$result->bind_param('s', $search1)){
    die('Binding parameters failed: (' . $result->errno . ') ' . $result->error);
	}

	if (!$result->execute()){
		die('Execute failed: (' . $result->errno . ') ' . $result->error);
	}
	$result->store_result();
	$result->bind_result($field1);
	$result->fetch();
	//echo $result->num_rows;
	
	return ($result->num_rows == 1) ? true:false;
	/*if ($result->num_rows == 0) {
		die('No username is found. Please login again or sign up!');
	}else{
		echo $field1."<br>";
		return true;
	}
	echo $field1.",".$field2;
	$result->close();*/
}

function user_id_from_username($user){
	global $db, $user, $pass1;

	$search1= trim(mysqli_real_escape_string($db,$user));
	$table= "member";
	$sourse_col1= "MemUser";
	$field1= "MemberID";
			
	$sql= "SELECT ".$field1." FROM ".$table." WHERE ".$sourse_col1." =? ";
	if (!$result = $db->prepare($sql)){
    die('Query failed: (' . $db->errno . ') ' . $db->error);
	}
	
	if (!$result->bind_param('s', $search1)){
    die('Binding parameters failed: (' . $result->errno . ') ' . $result->error);
	}

	if (!$result->execute()){
		die('Execute failed: (' . $result->errno . ') ' . $result->error);
	}
	$result->store_result();
	$result->bind_result($field1);
	$result->fetch();
	
	return ($result->num_rows == 1)	? $field1:false;
}

function login($user, $pass1){
	global $db, $user, $pass1;
	$MemberID=user_id_from_username($user);
	$field1= "MemberID";
	$table= "member";
	$sourse_col1= "MemUser";
	$sourse_col2= "MemPass";
	$user = trim(mysqli_real_escape_string($db,$user));
	$pass1= trim(mysqli_real_escape_string($db,$pass1));
	
	$sql= "SELECT ".$field1." FROM ".$table." WHERE ".$sourse_col1." =? and ".$sourse_col2." =?";
		
	if (!$result = $db->prepare($sql)){
    die('Query failed: (' . $db->errno . ') ' . $db->error);
	}
	
	if (!$result->bind_param('ss', $user, $pass1)){
    die('Binding parameters failed: (' . $result->errno . ') ' . $result->error);
	}

	if (!$result->execute()){
		die('Execute failed: (' . $result->errno . ') ' . $result->error);
	}
	$result->store_result();
	$result->bind_result($field1);
	$result->fetch();
	
	return ($result->num_rows == 1)	? $MemberID:false;
}

function register(){
	
	global $db, $user, $pass1, $fname, $lname, $memtele, $memaddress, $mememail;

	$user= trim(mysqli_real_escape_string($db,$user));
	//set table variable
	$table= "member";
	//set the columns need to insert into db
	$target_col1= "MemUser, MemPass, MemFN, MemLN, MemTele, MemAddress, MemEmail";
	//set insert command
	$sql= "INSERT INTO {$table} ( {$target_col1} ) VALUES ( ?, ?, ?, ?, ?, ?, ?)";
	
	if (!$result = $db->prepare($sql)){
    die('INSERT failed: (' . $db->errno . ') ' . $db->error);
	}
	//set the variables that need to insert
	if (!$result->bind_param('sssssss', $user, $pass1, $fname, $lname, $memtele, $memaddress, $mememail)){
    die('Binding parameters failed: (' . $result->errno . ') ' . $result->error);
	}

	if (!$result->execute()){
		die('Execute failed: (' . $result->errno . ') ' . $result->error);
	}else{
		return true;
	}
}

?>