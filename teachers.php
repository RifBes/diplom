<?php
	$title = "Преподаватели";
	require "blocks/header.php";
?>
	<div class="intro">
		<h1><center>Преподаватели</center></h1>
		<p>Здесь вы можете ознакомиться со списом преподавателей кафедры 805.</p>
		<button class="download_btn" id='word'>Скачать список</button>
		<div id='teachers' class="listOfSmth">
			<?php
				include "db_conn.php";

				$result = mysqli_query($conn, "SELECT * FROM `teachers` ORDER BY teachers.surname");
				echo "
				<table cellpadding='5'>
				<thead>
					<tr>
						<th>ФИО</th>
						<th>Должность</th>
						<th>Почта</th>
						<th>Телефон</th>
					</tr>
				</thead>
				";
				while ($teacher = mysqli_fetch_assoc($result)) {
							$id_tmp = $teacher['id_p'];
							$name = $teacher['name'];
							$surname = $teacher['surname'];
							$middle_name = $teacher['middle_name'];
							$post = $teacher['post'];
							$email = $teacher['email'];
							$phone = $teacher['phone_number'];
							echo "<tr><td><a class='user_idle' href='teacherid{$id_tmp}'>$surname $name $middle_name</a></td><td>$post</td><td>$email</td><td>$phone</td></tr>";
						};
				echo "</table>";
			?>
		</div>
	</div>
	
<script type="text/javascript">
	$(document).ready(function(){
		$("#word").click(function(){
			$('#teachers').tableExport({
				type:'word',
				fileName: 'Список преподавателей'
			});
		});
	});
</script>

<?php
	require "blocks/footer.php";
?>