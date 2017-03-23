<?php

function sanitize($data) {
	
	return mysqli_real_escape_string($mysqli, $data);
}

function post($str){
	$a= (!empty($_POST[$str])) ? $_POST[$str]:null;
	return $a;
}

?>