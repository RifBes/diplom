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
	if ($request[0] === '4') {
		$query = "SELECT * FROM Students LEFT OUTER JOIN topics_VKR on topics_VKR.student = id_s WHERE group_course = '$request' ORDER BY group_course, surname";
	}
	else{
		$query = "SELECT * FROM Students LEFT OUTER JOIN topics_NIR on topics_NIR.student = id_s WHERE group_course = '$request' ORDER BY group_course, surname";
	}
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
				<th>ФИО</th>
				<th>Группа</th>
				<th>Почта</th>
				<th>Телефон</th>
				<th>Тема работы</th>
			</tr>
			<?php
		} else{
			echo "Ничего нет";
		}
			?>
		</thead>
		<tbody>
			<?php
				while ($stud = mysqli_fetch_assoc($results)) {
							$id_tmp = $stud['id_s'];
							echo "<tr><td><a class='user_idle' href='studentid{$id_tmp}'>$stud[surname] $stud[name] $stud[middle_name]</a></td><td>$stud[group_course]</td><td>$stud[email]</td><td>$stud[phone_number]</td><td>$stud[name_theme]</td></tr>";
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