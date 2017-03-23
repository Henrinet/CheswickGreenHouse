<!doctype html>
<html lang="en">
<?php include "core/init.php"; ?>
<?php include "includes/head.php"; ?>
<body>
        <div class="brand">Cheswick Green House</div>
        <div class="address-bar">International Finance Center, Hong Kong</div>
<div id="wrap">

<?php 
//include "includes/nav.php";
if (logged_in()) {
	include_once "includes/navLogged.php";
}else{
	include_once "includes/nav.php";
}

?>
<Section id="bigbro">