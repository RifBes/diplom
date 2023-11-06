<?php

session_start();

$users_id = $_SESSION["user_id_p"];

if (isset($_POST['submit'])){
	$name_thema = $_POST['name_thema'];
	$student_thema = $_POST['student_thema']; //нужно разделить на имя, фамилию и отчетство
	$year_thema = $_POST['year_thema'];
	//подаются в роли 1 2 3 4 5 6, чтобы было проще объявлять
	$type = $_POST['select_type'];
	$type_theme = $_POST['select_theme'];

	require_once 'db_conn.php';
	require_once 'functions.php';

	if (emptyInputThema($name_thema, $year_thema) !== false) {
		header("Location: ../settings_teacher.php?error=emptyinput_theme");
		exit();
	}

	addTheme($conn, $name_thema, $student_thema, $year_thema, $type, $type_theme, $users_id);

} else{
	header("Location: ../settings_teacher.php");
	exit();
}