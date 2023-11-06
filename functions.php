<?php

function loginExists($conn, $login){
	$sql = "SELECT * FROM Students WHERE login_s = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../login.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $login);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		mysqli_stmt_close($stmt);
		return $row;
	}
	else{
		$result = false;
		mysqli_stmt_close($stmt);
		return $result;
	}
}

function TEACHloginExists($conn, $login){
	$sql = "SELECT * FROM teachers WHERE login_t = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../login.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $login);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		mysqli_stmt_close($stmt);
		return $row;
	}
	else{
		$result = false;
		mysqli_stmt_close($stmt);
		return $result;
	}
}

function emptyInputLogin($username, $pwd){
	$result;
	if (empty($username) || empty($pwd)) {
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}

function loginUser($conn, $username, $pwd){
	$loginExists = loginExists($conn, $username);

	//проверяем если логин студента не найден, то ищем такого преподавателя
	if ($loginExists === false) {
		$loginExists = TEACHloginExists($conn, $username);
		if ($loginExists === false) {
			header("location: ../login.php?error=wrongLogin");
			exit();
		}
		$pwd_bd = $loginExists['password_t'];
		$pwd_hash = md5($pwd);
		 if ($pwd_bd == $pwd_hash){
    		session_start();
    		$_SESSION["user_id_p"] = $loginExists['id_p'];
			header("location: ../index.php");
			exit();
    	} else {
    		header("location: ../login.php?error=wrongPassword");
			exit();
    	}
	}
	//Если ничего не нашлось, то пишем ошибку с логином
	if ($loginExists === false) {
		header("location: ../login.php?error=wrongLogin");
		exit();
	}

	$pwd_bd = $loginExists['password_s'];
	$pwd_hash = md5($pwd);

    if ($pwd_bd == $pwd_hash){
    	session_start();
    	$_SESSION["user_id_s"] = $loginExists['id_s'];
		header("location: ../index.php");
		exit();
    } else {
    	header("location: ../login.php?error=wrongPassword");
		exit();
    }
}



//настройки профилей проверка на пустые поля
function emptyInputSettings($new_email, $new_phone, $new_pwd, $new_pwd_repeat){
	$result;

	if (!empty($new_email)) {
		$result = false;
	} else if (!empty($new_phone)) {
		$result = false;
	} else if (!empty($new_pwd) || !empty($new_pwd_repeat)) {
		$result = false;
	}
	else{
		$result = true;
	}
	return $result;
}

function InvalidPhone($conn, $new_phone, $users_id, $new_pwd, $new_pwd_repeat){
	//если правильно написан номер телефона
	if (preg_match('/^\+7[0-9]{10}$/', $new_phone)) {
	    changePhone($conn, $new_phone, $users_id, $new_pwd, $new_pwd_repeat);
	} else {
	    header("location: ../settings_student.php?error=wrongPhone");
		exit();
	}
}

function changePhone($conn, $new_phone, $users_id, $new_pwd, $new_pwd_repeat){
	$sql = "UPDATE `Students` SET `phone_number` = '$new_phone' WHERE `Students`.`id_s` = '$users_id';";
	if ($conn->query($sql) === true) {
		if ($new_pwd !== '' or $new_pwd_repeat !== '') {
			return;
			//если всё пусто, то возвращаемся
		} else {
				header("location: ../settings_student.php");
				exit();
			}
	} else {
		$conn->error;
	}
}

function changeEmail($conn, $new_email, $users_id, $new_phone, $new_pwd, $new_pwd_repeat){
	$sql = "UPDATE `Students` SET `email` = '$new_email' WHERE `Students`.`id_s` = '$users_id';";
	if ($conn->query($sql) === true) {
		//проверяем на пустые значения других ячеек
		if ($new_phone !== '' or $new_pwd !== '' or $new_pwd_repeat !== '') {
			return;
			//если всё пусто, то возвращаемся
		} else {
				header("location: ../settings_student.php");
				exit();
			}
	} else {
		$conn->error;
	}
}

function pwdExists($conn, $users_id, $new_pwd, $new_pwd_repeat){
	if ($new_pwd === '' or $new_pwd_repeat === '') {
		header("location: ../settings_student.php?error=wrongPasswordFill");
		exit();
	}
	else if ($new_pwd !== $new_pwd_repeat) {
		header("location: ../settings_student.php?error=wrongPassChange");
		exit();
	} else {
		changePass($conn, $users_id, $new_pwd, $new_pwd_repeat);
	}
}

function changePass($conn, $users_id, $new_pwd, $new_pwd_repeat){
	$hash_new_pwd = md5($new_pwd);
	$sql = "UPDATE `Students` SET `password_s` = '$hash_new_pwd' WHERE `Students`.`id_s` = '$users_id';";
	if ($conn->query($sql) === true){
		header("location: ../settings_student.php");
		exit();
	}
}

function settingsUser_Stud($conn, $new_email, $new_phone, $new_pwd, $new_pwd_repeat, $users_id){
	if ($new_email !== '') {
		changeEmail($conn, $new_email, $users_id, $new_phone, $new_pwd, $new_pwd_repeat);
	}
	if ($new_phone !== '') {
		$phoneExists = InvalidPhone($conn, $new_phone, $users_id, $new_pwd, $new_pwd_repeat);
	}
	if ($new_pwd !== '' or $new_pwd_repeat !== ''){
		pwdExists($conn, $users_id, $new_pwd, $new_pwd_repeat);
	}
}



//ПРЕПОДАВАТЕЛИ!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

function InvalidPhone_teacher($conn, $new_phone, $users_id, $new_pwd, $new_pwd_repeat){
	//если правильно написан номер телефона
	if (preg_match('/^\+7[0-9]{10}$/', $new_phone)) {
	    changePhone_teacher($conn, $new_phone, $users_id, $new_pwd, $new_pwd_repeat);
	} else {
	    header("location: ../settings_teacher.php?error=wrongPhone");
		exit();
	}
}

function changePhone_teacher($conn, $new_phone, $users_id, $new_pwd, $new_pwd_repeat){
	$sql = "UPDATE `teachers` SET `phone_number` = '$new_phone' WHERE `teachers`.`id_p` = '$users_id';";
	if ($conn->query($sql) === true) {
		if ($new_pwd !== '' or $new_pwd_repeat !== '') {
			return;
			//если всё пусто, то возвращаемся
		} else {
				header("location: ../settings_teacher.php");
				exit();
			}
	} else {
		$conn->error;
	}
}

function changeEmail_teacher($conn, $new_email, $users_id, $new_phone, $new_pwd, $new_pwd_repeat){
	$sql = "UPDATE `teachers` SET `email` = '$new_email' WHERE `teachers`.`id_p` = '$users_id';";
	if ($conn->query($sql) === true) {
		//проверяем на пустые значения других ячеек
		if ($new_phone !== '' or $new_pwd !== '' or $new_pwd_repeat !== '') {
			return;
			//если всё пусто, то возвращаемся
		} else {
				header("location: ../settings_teacher.php");
				exit();
			}
	} else {
		$conn->error;
	}
}

function pwdExists_teacher($conn, $users_id, $new_pwd, $new_pwd_repeat){
	if ($new_pwd === '' or $new_pwd_repeat === '') {
		header("location: ../settings_teacher.php?error=wrongPasswordFill");
		exit();
	}
	else if ($new_pwd !== $new_pwd_repeat) {
		header("location: ../settings_teacher.php?error=wrongPassChange");
		exit();
	} else {
		changePass_teacher($conn, $users_id, $new_pwd, $new_pwd_repeat);
	}
}

function changePass_teacher($conn, $users_id, $new_pwd, $new_pwd_repeat){
	$hash_new_pwd = md5($new_pwd);
	$sql = "UPDATE `teachers` SET `password_t` = '$hash_new_pwd' WHERE `teachers`.`id_p` = '$users_id';";
	if ($conn->query($sql) === true){
		header("location: ../settings_teacher.php");
		exit();
	}
}

function settingsUser_teacher($conn, $new_email, $new_phone, $new_pwd, $new_pwd_repeat, $users_id){
	if ($new_email !== '') {
		changeEmail_teacher($conn, $new_email, $users_id, $new_phone, $new_pwd, $new_pwd_repeat);
	}
	if ($new_phone !== '') {
		$phoneExists = InvalidPhone_teacher($conn, $new_phone, $users_id, $new_pwd, $new_pwd_repeat);
	}
	if ($new_pwd !== '' or $new_pwd_repeat !== ''){
		pwdExists_teacher($conn, $users_id, $new_pwd, $new_pwd_repeat);
	}
}



//+++++++++++++++++++++++++++===ТЕМЫ
function emptyInputThema($name_thema, $year_thema){
	$result;
	if (empty($name_thema) || empty($year_thema)) {
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}

function correctData($year_thema){
	if (!is_numeric($year_thema)) {
    	header("location: ../settings_teacher.php?error=wrongDatatype");
		exit();
	}
	else{
	    return;
	}
}

function addNIR($conn, $name_thema, $student_thema, $year_thema, $type_theme, $users_id){
	if ($student_thema === '') {
		$sql = "INSERT INTO `topics_NIR` (`id_n`, `name_theme`, `teacher`, `student`, `year`, `type`) VALUES (NULL, '$name_thema', '$users_id', NULL, '$year_thema', '$type_theme');";
		if ($conn->query($sql) === true){
			header("location: ../settings_teacher.php");
			exit();
		}
	} else {
		$stud_id_thema = findStudent($conn, $student_thema);
		$sql = "INSERT INTO `topics_NIR` (`id_n`, `name_theme`, `teacher`, `student`, `year`, `type`) VALUES (NULL, '$name_thema', '$users_id', '$stud_id_thema', '$year_thema', '$type_theme');";
		if ($conn->query($sql) === true){
			header("location: ../settings_teacher.php");
			exit();
		}
	}
}

function addVKR($conn, $name_thema, $student_thema, $year_thema, $type_theme, $users_id){
	if ($student_thema === '') {
		$sql = "INSERT INTO `topics_VKR` (`id_v`, `name_theme`, `teacher`, `student`, `year`, `type`) VALUES (NULL, '$name_thema', '$users_id', NULL, '$year_thema', '$type_theme');";
		if ($conn->query($sql) === true){
			header("location: ../settings_teacher.php");
			exit();
		}
	} else {
		$stud_id_thema = findStudent($conn, $student_thema);
		$sql = "INSERT INTO `topics_VKR` (`id_v`, `name_theme`, `teacher`, `student`, `year`, `type`) VALUES (NULL, '$name_thema', '$users_id', '$stud_id_thema', '$year_thema', '$type_theme');";
		if ($conn->query($sql) === true){
			header("location: ../settings_teacher.php");
			exit();
		}
	}
}

function findStudent($conn, $student_thema){
	//разделение слов в массив
	$words = explode(" ", $student_thema);
	$name_stud = $words[1];
	$surname_stud = $words[0];
	$midname_stud = $words[2];

	$sql_s = "SELECT * FROM `Students` where Students.surname = '$surname_stud' and Students.name = '$name_stud' and Students.middle_name = '$midname_stud';";
    $result_s = mysqli_query($conn, $sql_s) or die(mysqli_error($conn));
    $count_s = mysqli_num_rows($result_s);
    if ($count_s > 0) {
        $row_s = mysqli_fetch_array($result_s);
        $stud_id_thema = $row_s['id_s'];
        return $stud_id_thema;
    } else {
    	header("location: ../settings_teacher.php?error=wrongstudent");
		exit();
    }
}


function addTheme($conn, $name_thema, $student_thema, $year_thema, $type, $type_theme, $users_id){
	correctData($year_thema);
	if ($type === 'NIR') {
		addNIR($conn, $name_thema, $student_thema, $year_thema, $type_theme, $users_id);
	}
	else if ($type === 'VKR') {
		addVKR($conn, $name_thema, $student_thema, $year_thema, $type_theme, $users_id);
	}
}

//+++++++++++++++++++++++++++++++++++++++++

function emptyInputStud($student_thema, $name_thema){
	$result;
	if (empty($student_thema) || ($name_thema === 'none_theme')) {
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}


function findStudent_add($conn, $student_thema){
	//разделение слов в массив
	$words = explode(" ", $student_thema);
	$name_stud = $words[1];
	$surname_stud = $words[0];
	$midname_stud = $words[2];

	$sql_s = "SELECT * FROM `Students` where Students.surname = '$surname_stud' and Students.name = '$name_stud' and Students.middle_name = '$midname_stud';";
    $result_s = mysqli_query($conn, $sql_s) or die(mysqli_error($conn));
    $count_s = mysqli_num_rows($result_s);
    if ($count_s > 0) {
        $row_s = mysqli_fetch_array($result_s);
        $stud_id_thema = $row_s['id_s'];
        return $stud_id_thema;
    } else {
    	header("location: ../settings_add_student.php?error=wrongstudent");
		exit();
    }
}

function addStud($conn, $student_thema, $name_thema, $users_id){
	$stud = findStudent_add($conn, $student_thema);
	$sql = "UPDATE `topics_NIR` SET `student` = '$stud' WHERE `topics_NIR`.`id_n` = '$name_thema';";
	if ($conn->query($sql) === true){
			header("location: ../settings_add_student.php");
			exit();
	}
}