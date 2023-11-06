<?php
	include "db_conn.php";
	$title = "Темы НИРС";
	require "blocks/header.php";
?>
	<div class="intro">
		<h1><center>НИРС</center></h1>
		<p>На этой странице представлены актуальные темы научно-исследовательских работ, которые предлагают преподаватели.</p>
		<div class="search_filter">
			<h5>Поиск по фильтрам:</h5>
			<?php
				$query_theme = mysqli_query($conn, "SELECT * FROM `themes`;");
				$query_teacher = mysqli_query($conn, "SELECT * FROM `teachers` ORDER BY surname;");
				//while ($theme_type = mysqli_fetch_assoc($query_theme)){
				//				$arr[] = $theme_type['type'];
				//			}
				echo "Выберите преподавателя<br>
				<select name='select_teacher' id='select_teacher'>";
				echo "<option value='none_teacher' selected=''></option>";
				while ($teacher_pick = mysqli_fetch_array($query_teacher)) {
					echo '<option value="'. $teacher_pick['id_p'] .'">' . $teacher_pick['surname'] .' '. $teacher_pick['name'] .' '. $teacher_pick['middle_name'] . '</option>';
				}
				echo "
				</select>
				";
				echo "<br>Выберите направление работы<br>
					<select name='select_type_theme' id='select_type_theme'>";
					echo "<option value='none_theme' selected=''></option>";
					while ($theme_pick = mysqli_fetch_array($query_theme)) {
						echo '<option value="'. $theme_pick['id_t'] .'">' . $theme_pick['type_name'] . '</option>';
					}
				echo "</select>
				";
			?>
		</div>
		<button class="download_btn" id="themes">Скачать список</button>
		<div id="theme" class="listOfSmth">
			<?php
			//++++++++++++++++++++++++++
				$d = getdate();
				//проверка на то, чтобы корректно выводить темы и их даты
				if ($d['mon'] === 'September' or $d['mon'] === 'October' or $d['mon'] === 'November' or $d['mon'] === 'December' or $d['mon'] === 'August') {
					$tyear = $d['year'] + 1;
				} else {
					$tyear = $d['year'];
				}
				// Create a temporary table
				$query = "CREATE TEMPORARY TABLE tmp as SELECT topics_NIR.year as thema_year, topics_NIR.name_theme AS thema, Students.name as stud_name, Students.surname as stud_surname, Students.middle_name as stud_middlename, topics_NIR.student as stud_id, topics_NIR.teacher as teacher_id FROM topics_NIR LEFT OUTER JOIN Students ON topics_NIR.student = Students.id_s;";
				mysqli_query($conn, $query);

				// Execute query
				$query = "SELECT tmp.thema_year, tmp.thema, tmp.stud_name, tmp.stud_surname, tmp.stud_middlename, tmp.stud_id, tmp.teacher_id, teachers.name as teacher_name, teachers.surname as teacher_surname, teachers.middle_name as teacher_middlename FROM tmp LEFT OUTER JOIN teachers ON tmp.teacher_id = teachers.id_p WHERE thema_year = $tyear ORDER BY teacher_surname";
				$results = mysqli_query($conn, $query);

				echo "
				<table cellpadding='5'>
				<thead>
					<tr>
						<th>Название</th>
						<th>Студент</th>
						<th>Преподаватель</th>
					</tr>
				</thead>
				";
				while ($NIR = mysqli_fetch_assoc($results)) {
					$id_s_tmp = $NIR['stud_id'];
					$id_p_tmp = $NIR['teacher_id'];
					echo "<tr><td aria-label='Название темы'>$NIR[thema]</td><td aria-label='Студент'><a class='user_idle' href='studentid{$id_s_tmp}'>$NIR[stud_surname] $NIR[stud_name] $NIR[stud_middlename] <a/></td><td aria-label='Преподаватель'><a class='user_idle' href='teacherid{$id_p_tmp}'>$NIR[teacher_surname] $NIR[teacher_name] $NIR[teacher_middlename]</a></td></tr>";
					};
				echo "</table>";
				$query = "DROP TEMPORARY TABLE tmp";
				mysqli_query($conn, $query);

			?>
		</div>
	</div>

<script type="text/javascript">
		$(document).ready(function(){
			$("#select_type_theme").on('change',function(){
				var value = $(this).val();
				//alert(value);
				$.ajax({
					url: "select_type_theme_NIR.php",
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
			$("#select_teacher").on('change',function(){
				var value = $(this).val();
				//alert(value);
				$.ajax({
					url: "select_teacher_NIR.php",
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
		//СКАЧАТЬ ТАБЛИЧКУ!
	$(document).ready(function(){
		$("#themes").click(function(){
			$('#theme').tableExport({
				type:'word',
				fileName: 'Список проектов'
			});
		});
	});
	</script>
	
<?php
	require "blocks/footer.php";
?>