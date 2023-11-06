<?php 

if (isset($_POST['submit'])) {

	$username = $_POST['uid'];
	$pwd = $_POST['pwd'];

	require_once 'db_conn.php';
	require_once 'functions.php';

	if (emptyInputLogin($username, $pwd) !== false) {
		header("Location: ../login.php?error=emptyinput");
		exit();
	}

	loginUser($conn, $username, $pwd);

} 
else{
	header("Location: ../login.php");
	exit();
}