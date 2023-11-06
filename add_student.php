<?php

session_start();

$users_id = $_SESSION["user_id_p"];

if (isset($_POST['submit'])){
	$student_thema = $_POST['student_thema']; //нужно разделить на имя, фамилию и отчетство
	$name_thema = $_POST['select_theme'];

	require_once 'db_conn.php';
	require_once 'functions.php';

	if (emptyInputStud($student_thema, $name_thema) !== false) {
		header("Location: ../settings_add_student.php?error=emptyinput_stud");
		exit();
	}

	addStud($conn, $student_thema, $name_thema, $users_id);

} 
else{
	header("Location: ../settings_add_student.php");
	exit();
}