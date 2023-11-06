<?php
	$title = "Студенты";
	require "blocks/header.php";
	include "db_conn.php";
?>
	<div class="intro">
		<h1><center>Студенты</center></h1>
		<p>Список студентов всех групп.</p>
		<div class="search_filter">
			<?php
			$query_groups = mysqli_query($conn, "SELECT DISTINCT group_course FROM `Students`;");
				echo "Выберите группу<br>
				<select name='select_group' id='select_group'>";
				echo "<option value='none_group' selected=''></option>";
				while ($group_pick = mysqli_fetch_array($query_groups)) {
					echo '<option value="'. $group_pick['group_course'] .'">' . $group_pick['group_course'] . '</option>';
				}
				echo "
				</select>
				";
				?>
		</div>
		<button class="download_btn" id='word'>Скачать список</button>
		<div id='students' class="listOfSmth">
			<?php
				$result = mysqli_query($conn, "SELECT * FROM Students LEFT OUTER JOIN topics_VKR on topics_VKR.student = id_s ORDER BY group_course, surname");
				echo "
				<table cellpadding='5'>
				<thead>
					<tr>
						<th>ФИО</th>
						<th>Группа</th>
						<th>Почта</th>
						<th>Телефон</th>
						<th>Тема работы</th>
					</tr>
				</thead>
				";
				while ($stud = mysqli_fetch_assoc($result)) {
							$id_tmp = $stud['id_s'];
							echo "<tr><td><a class='user_idle' href='studentid{$id_tmp}'>$stud[surname] $stud[name] $stud[middle_name]</a></td><td>$stud[group_course]</td><td>$stud[email]</td><td>$stud[phone_number]</td><td>$stud[name_theme]</td></tr>";
						};
				echo "</table>";
			?>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#select_group").on('change',function(){
				var value = $(this).val();
				//alert(value);
				$.ajax({
					url: "select_group.php",
					type:"POST",
					data: 'request=' + value,
					beforeSend:function(){
						$(".listOfSmth").html("<span>Работаем...</span>");
					},
					success:function(data){
						$(".listOfSmth").html(data);
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
	$(document).ready(function(){
		$("#word").click(function(){
			$('#students').tableExport({
				type:'word',
				fileName: 'Список студентов'
			});
		});
	});
</script>
<?php
	require "blocks/footer.php";
?>