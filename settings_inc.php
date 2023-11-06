<?php

session_start();
if (isset($_SESSION["user_id_s"])) {
	$users_id = $_SESSION["user_id_s"];
}
else if (isset($_SESSION["user_id_p"])){
	$users_id = $_SESSION["user_id_p"];
}

if (isset($_POST['submit'])) {
	$new_email = $_POST['email_change'];
	$new_phone = $_POST['phone_change'];
	$new_pwd = $_POST['pass_change'];
	$new_pwd_repeat = $_POST['pass_change_two'];

	require_once 'db_conn.php';
	require_once 'functions.php';

	if (isset($_SESSION["user_id_s"])) {
		if (emptyInputSettings($new_email, $new_phone, $new_pwd, $new_pwd_repeat) !== false) {
			header("Location: ../settings_student.php?error=emptyinput");
			exit();
		}
		settingsUser_Stud($conn, $new_email, $new_phone, $new_pwd, $new_pwd_repeat, $users_id);
	} else if (isset($_SESSION["user_id_p"])){
		if (emptyInputSettings($new_email, $new_phone, $new_pwd, $new_pwd_repeat) !== false) {
			header("Location: ../settings_teacher.php?error=emptyinput");
			exit();
		}
		settingsUser_teacher($conn, $new_email, $new_phone, $new_pwd, $new_pwd_repeat, $users_id);
	}
} 
else if (isset($_SESSION["user_id_s"])){
	header("Location: ../settings_student.php");
	exit();
} else if (isset($_SESSION["user_id_p"])){
	header("Location: ../settings_teacher.php");
	exit();
}