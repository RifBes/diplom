<?php 
include "db_conn.php";

if (isset($_POST['request'])) {
	
	$request = $_POST['request'];

	$d = getdate();
				//проверка на то, чтобы корректно выводить темы и их даты
	if ($d['mon'] === 'September' or $d['mon'] === 'October' or $d['mon'] === 'November' or $d['mon'] === 'December' or $d['mon'] === 'August') {
		$tyear = $d['year'] + 1;
	} else {
		$tyear = $d['year'];
	}

	$query = "CREATE TEMPORARY TABLE tmp as SELECT topics_VKR.type as thema_type, topics_VKR.year as thema_year, topics_VKR.name_theme AS thema, Students.name as stud_name, Students.surname as stud_surname, Students.middle_name as stud_middlename, topics_VKR.student as stud_id, topics_VKR.teacher as teacher_id FROM topics_VKR LEFT OUTER JOIN Students ON topics_VKR.student = Students.id_s;";
	mysqli_query($conn, $query);

	if ($request === 'none_theme') {
		$query = "SELECT tmp.thema_year, tmp.thema, tmp.stud_name, tmp.stud_surname, tmp.stud_middlename, tmp.stud_id, tmp.teacher_id, teachers.name as teacher_name, teachers.surname as teacher_surname, teachers.middle_name as teacher_middlename FROM tmp LEFT OUTER JOIN teachers ON tmp.teacher_id = teachers.id_p WHERE thema_year = $tyear ORDER BY teacher_surname";
	} else{
	
		$query = "SELECT tmp.thema_type, tmp.thema_year, tmp.thema, tmp.stud_name, tmp.stud_surname, tmp.stud_middlename, tmp.stud_id, tmp.teacher_id, teachers.name as teacher_name, teachers.surname as teacher_surname, teachers.middle_name as teacher_middlename FROM tmp LEFT OUTER JOIN teachers ON tmp.teacher_id = teachers.id_p WHERE thema_year = $tyear AND tmp.thema_type = '$request' ORDER BY teacher_surname";}
	$results = mysqli_query($conn, $query);

	$count = mysqli_num_rows($results);
?>

<div class="listOfSmth">
	<table class="table">
		<?php

		if ($count) {
		?>
		<thead>
			<tr>
				<th>Название</th>
				<th>Студент</th>
				<th>Преподаватель</th>
			</tr>
			<?php
		} else{
			echo "Ничего нет";
		}
			?>
		</thead>
		<tbody>
			<?php
				while ($VKR = mysqli_fetch_assoc($results)) {
					$id_s_tmp = $VKR['stud_id'];
					$id_p_tmp = $VKR['teacher_id'];
					echo "<tr><td>$VKR[thema]</td><td><a class='user_idle' href='studentid{$id_s_tmp}'>$VKR[stud_surname] $VKR[stud_name] $VKR[stud_middlename] <a/></td><td><a class='user_idle' href='teacherid{$id_p_tmp}'>$VKR[teacher_surname] $VKR[teacher_name] $VKR[teacher_middlename]</a></td></tr>";
				};
				$query = "DROP TEMPORARY TABLE tmp";
				mysqli_query($conn, $query);

			?>
		</tbody>
	</table>
</div>
<?php 
}
?>