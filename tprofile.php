<?php
	include "db_conn.php";
	$title = "Профиль";
	require "blocks/header.php";
?>
<?php
	$users_id = $_GET['teacherid'];
	$query = mysqli_query($conn, "SELECT * FROM `teachers` WHERE id_p = '$users_id';");
	$array = mysqli_fetch_array($query);
	if (isset($_SESSION["user_id_p"])) {
		$users_id_login = $_SESSION["user_id_p"];
	} else {
		$users_id_login = NULL;
	}

	setcookie('teacherid', $users_id);
?>

	<div class="intro">
		<h1><center>Профиль</center></h1>
		<div class="edit_profile">
			<?php
				if ((isset($users_id_login)) AND ($users_id_login == $users_id)) {
					echo "
						<form action='settings_teac{$users_id_login}'>
						<button class='edit_btn'>Редактировать профиль</button>
						</form> 
						";
					echo "
						<form action='students.php'>
						<button class='edit_btn'>Список всех студентов</button>
						</form> 
						";
					echo "<form action='settings_add_student.php'>
						<button class='edit_btn'>Добавить студента</button>
						</form> ";
				}
			?>
		</div>
		<div class="info_users">
			<span style='font-weight:bold;'>ФИО:</span> <?=$array['surname']?> <?=$array['name']?> <?=$array['middle_name']?><br>
			<span style='font-weight:bold;'>Должность:</span> <?=$array['post']?><br>
			<span style='font-weight:bold;'>Контактные данные:</span><br>Почта: <?=$array['email']?><br>Телефон: <?=$array['phone_number']?>
		</div>
			<div class="student_work">
			<h3>Студенты-выпускники</h3>
			<?php
				$d = getdate();
				//проверка на то, чтобы корректно выводить темы и их даты
				if ($d['mon'] === 'September' or $d['mon'] === 'October' or $d['mon'] === 'November' or $d['mon'] === 'December' or $d['mon'] === 'August') {
					$tyear = $d['year'] + 1;
				} else {
					$tyear = $d['year'];
				}
				// Create a temporary table
				$query = "CREATE TEMPORARY TABLE tmp AS SELECT DISTINCT * FROM topics_VKR WHERE teacher = '$users_id'";
				mysqli_query($conn, $query);

				// Execute query
				$query = "SELECT Students.name, Students.surname, Students.middle_name, Students.group_course, tmp.name_theme AS thema, tmp.student AS STUD_id FROM Students, tmp WHERE id_s = student AND year = $tyear";
				$results = mysqli_query($conn, $query);
				if (mysqli_num_rows($results) > 0){
					echo "
						<table cellpadding='5'>
						<thead>
							<tr>
								<th>Студент</th>
								<th>Группа</th>
								<th>Тема работы</th>
							</tr>
						</thead>
						";

					// Display results
					while($row = mysqli_fetch_assoc($results)) {
						$id_tmp = $row['STUD_id'];
						echo "<tr><td aria-label='Название темы'><a class='user_idle' href='studentid{$id_tmp}'>$row[surname] $row[name] $row[middle_name]</a></td><td aria-label='Группа'>$row[group_course]</td><td aria-label='Тема работы'>$row[thema]</td></tr>";
					}
					echo "</table>";
				} else {
					echo "<p>Нет студентов, с которыми работает преподаватель.</p>";
				}

				// Drop temporary table
				$query = "DROP TEMPORARY TABLE tmp";
				mysqli_query($conn, $query);
			?>
			</div>
		<div class="student_work">
			<h3>Студенты</h3>
			<?php
				// Create a temporary table
				$query = "CREATE TEMPORARY TABLE tmp AS SELECT DISTINCT * FROM topics_NIR WHERE teacher = '$users_id'";
				mysqli_query($conn, $query);

				// Execute query
				$query = "SELECT Students.name, Students.surname, Students.middle_name, Students.group_course, tmp.name_theme AS thema, tmp.student AS STUD_id FROM Students, tmp WHERE id_s = student";
				$results = mysqli_query($conn, $query);
				if (mysqli_num_rows($results) > 0){
					echo "
						<table cellpadding='5'>
						<thead>
							<tr>
								<th>Студент</th>
								<th>Группа</th>
								<th>Тема работы</th>
							</tr>
						</thead>
						";

					// Display results
					while($row = mysqli_fetch_assoc($results)) {
						$id_tmp = $row['STUD_id'];
						echo "<tr><td aria-label='Название темы'><a class='user_idle' href='studentid{$id_tmp}'>$row[surname] $row[name] $row[middle_name]</a></td><td aria-label='Группа'>$row[group_course]</td><td aria-label='Тема работы'>$row[thema]</td></tr>";
					}
					echo "</table>";
				} else {
					echo "<p>Нет студентов, с которыми работает преподаватель.</p>";
				}

				// Drop temporary table
				$query = "DROP TEMPORARY TABLE tmp";
				mysqli_query($conn, $query);
			?>
			</div>

		<div class="pick_year_thema">
			<h3>Темы выпускных работ студентов за прошедшие три года</h3>
			Пожалуйста, выберите год. <br>
			<?php
				$d = getdate();
				//проверка на то, чтобы корректно выводить темы и их даты
				if ($d['mon'] === 'September' or $d['mon'] === 'October' or $d['mon'] === 'November' or $d['mon'] === 'December' or $d['mon'] === 'August') {
					$tyear = $d['year'] + 1;
				} else {
					$tyear = $d['year'];
				}
				$year1 = $tyear - 1;
				$year2 = $year1 - 1;
				$year3 = $year2 - 1;
				echo "<select name='select_year' id='select_year' class='select_year'>
					<option value='none_year' selected=''></option>
					<option value='$year1'>$year1</option>
					<option value='$year2'>$year2</option>
					<option value='$year3'>$year3</option>
				</select>
				";
			?>
		</div>
		<div class="listOfSmth_thm">
			<?php
				//echo "
				//	<table cellpadding='5'>
				//	<thead>
				//		<tr>
				//			<th>Название</th>
				//		</tr>
				//	</thead>
				//	";
				//$query = "SELECT * FROM `topics_VKR` WHERE teacher ='$users_id'";
				//$results = mysqli_query($conn, $query);
				//while ($VKR = mysqli_fetch_assoc($results)) {
				//	echo "<tr><td>$VKR[name]</td></tr>";
				//}
			?>
			</table>
		</div>


		<div class="publish_info">
			<h3>Публикации</h3>
			<?php
				$publish = mysqli_query($conn, "SELECT * FROM `teacher_publications` WHERE author = '$users_id' ORDER BY year;");
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
								echo "<tr><td aria-label='Название'>$name</td><td aria-label='Год'>$year</td><td aria-label='Издательство'>$publishing_house</td></tr>";
							};
					echo "</table>";
				} else {
					echo "<p>На данный момент публикаций нет.</p>";
				}
			?>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#select_year").on('change',function(){
				var value = $(this).val();
				//alert(value);
				$.ajax({
					url: "select_year_teacherprofile.php",
					type:"POST",
					data: 'request=' + value,
					beforeSend:function(){
						$(".listOfSmth_thm").html("<span>Работаем...</span>");
					},
					success:function(data){
						$(".listOfSmth_thm").html(data);
					}
				});
			});
		});
	</script>
<?php
	require "blocks/footer.php";
?>