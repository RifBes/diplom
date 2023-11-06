<?php
	include "db_conn.php";
	$title = "Профиль";
	require "blocks/header.php";
?>

<?php
	$users_id = $_GET['studentid'];
	$query = mysqli_query($conn, "SELECT * FROM `Students` WHERE id_s = '$users_id';");
	$array = mysqli_fetch_array($query);
	if (isset($_SESSION["user_id_s"])) {
		$users_id_login = $_SESSION["user_id_s"];
	} else {
		$users_id_login = NULL;
	}
?>

	<div class="intro">
		<h1><center>Профиль</center></h1>
		<div class="edit_profile">
			<?php
				if ((isset($users_id_login)) AND ($users_id_login == $users_id)) {
					echo "
						<form action='settings_stud{$users_id_login}'>
						<button class='edit_btn'>Редактировать профиль</button>
						</form> 
						";
				}
			?>
		</div>
		<div class="info_users">
			<span style='font-weight:bold;'>ФИО:</span> <?=$array['surname']?> <?=$array['name']?> <?=$array['middle_name']?><br>
			<span style='font-weight:bold;'>Курс:</span> <?=$array['course']?><br>
			<span style='font-weight:bold;'>Группа:</span> <?=$array['group_course']?><br>
			<span style='font-weight:bold;'>Контактные данные:</span><br>Почта: <?=$array['email']?><br>Телефон: <?=$array['phone_number']?>
		</div>
		<div class="student_work">
			<h3>Преподаватель, с которым сейчас работает студент</h3>
			<?php
				// Create a temporary table
				$query = "CREATE TEMPORARY TABLE tmp AS SELECT DISTINCT * FROM topics_VKR WHERE student = '$users_id'";
				mysqli_query($conn, $query);

				// Execute query
				$query = "SELECT teachers.name, teachers.surname, teachers.middle_name, tmp.name_theme AS thema, tmp.teacher AS TEACHER_id FROM teachers, tmp WHERE id_p = teacher";
				$results = mysqli_query($conn, $query);
				if (mysqli_num_rows($results) > 0){
					echo "
						<table cellpadding='5'>
						<thead>
							<tr>
								<th>Преподаватель</th>
								<th>Тема работы</th>
							</tr>
						</thead>
						";

					// Display results
					while($row = mysqli_fetch_assoc($results)) {
						$id_tmp = $row['TEACHER_id'];
						echo "<tr><td><a class='user_idle' href='teacherid{$id_tmp}'>$row[surname] $row[name] $row[middle_name]</a></td><td>$row[thema]</td></tr>";
					}
					echo "</table>";
				} else {
					echo "<p>Студент пока что не работает с преподавателем.</p>";
				}

				// Drop temporary table
				$query = "DROP TEMPORARY TABLE tmp";
				mysqli_query($conn, $query);
			?>
			
		</div>
		<div class="publish_info">
			<h3>Публикации</h3>
			<?php
				$publish = mysqli_query($conn, "SELECT * FROM `student_publications` WHERE author = '$users_id';");
				if (mysqli_num_rows($publish) > 0){
					echo "
					<table cellpadding='5'>
					<thead>
						<tr>
							<th>Название</th>
							<th>Год</th>
							<th>Издательтво</th>
						</tr>
					</thead>
					";
					while ($pub = mysqli_fetch_assoc($publish)) {
								$name = $pub['name'];
								$year = $pub['year'];
								$publishing_house = $pub['publishing_house'];
								echo "<tr><td>$name</td><td>$year</td><td>$publishing_house</td></tr>";
							};
					echo "</table>";
				} else {
					echo "<p>На данный момент публикаций нет.</p>";
				}
			?>
		</div>
	</div>
<?php
	require "blocks/footer.php";
?>