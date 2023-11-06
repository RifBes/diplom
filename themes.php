<?php
	include "db_conn.php";
	$title = "Тип темы";
	require "blocks/header.php";
	$theme_id = $_GET['themenumber'];
	$query = mysqli_query($conn, "SELECT * FROM `themes` WHERE id_t = '$theme_id';");
	$array = mysqli_fetch_array($query);


	setcookie('themeid', $theme_id);
?>

<div class="intro">
	<h1><center>Тема направления</center></h1>
	<h2><center><?=$array['type_name']?></center></h2>
	<div>
		<?php
			if ($theme_id === '1') {
				echo "
				<p>Эта тема касается разработки программного обеспечения, которое используется для обучение и оценки студентов в различных дисциплинах. Такие программные средства могут быть использованы как для онлайн, так и для офлайн обучения, и могут включать в себе несколько форматов, такие как тесты и задания для интерактивного решения задач и проектов.</p>
				<p>Тема позволяет изучить различные способы использования компьютерных технологий для создания программных средств учебного назначения. Это может включать использование языков программирования, библиотек и фреймворков для создания интерактивных симуляций, игр и образовательных проектов.</p>
				<p>Эта тема может быть очень интересной для студентов, которые интересуются пересечением компьютерных технологий и образования, и может дать ценное представление о том, как технологии могут быть использованы для улучшения процесса преподавания и обучения. Изучая эту тему, студенты также могут развить навыки разработки программного обеспечения, проектирования и обучения, что может быть ценным для карьеры в сфере образовательных технологий или смежных областях.</p>
				";
			}
			else if ($theme_id === '2') {
				echo "
				<p>Тема охватывает изучение современных методов теории управления, используемых для моделирования и управления физическими системами. Эти методы могут быть применены в разных областях, таких как инженерия, физика, химия и другие естественно-научные области.</p>
				<p>Общим в этих методах является использование математических моделей для описания физических систем, а также применение методов математического анализа для анализа и понимания поведения этой системы.</p>
				<p>Целью темы является разработка эффективных и действенных методов оптимизации сложных систем и процессов, а также повышение производительности систем реального мира за счет использования передовых математических моделей и алгоритмов.</p>
				";
			}
			else if ($theme_id === '3') {
				echo "
				<p>Тема касается разработки и реализации систем, которые могут обрабатывать информацию, Обработка информации - это обширная и постоянно развивающаяся область, в которой находят применение самые разные приложения - от простых систем автоматизации офиса до крупномасштабных баз данных и сложных инструментов анализа данных. Цель обработки информации - оптимизировать рабочие процессы, автоматизировать повторяющиеся задачи и генерировать выводы из больших объемов данных.</p>
				<p>Системы обработки информации жизненно важны для современных предприятий и организаций, поскольку они позволяют им управлять и анализировать большие объемы данных, улучшать процессы принятия решений и оптимизировать свою деятельность. Эти системы сыграли важнейшую роль в цифровой трансформации предприятий и организаций, и, вероятно, они будут продолжать играть важную роль в будущем, поскольку предприятия стремятся стать более ориентированными на данные и пользователей.</p>
				";
			}
			else if ($theme_id === '4') {
				echo "
				<p>В этой теме обсуждается использование профессиональных программных сред при разработке прикладных программных продуктов. Программные среды - это инструменты, которые помогают разработчикам создавать программный код и тестировать приложения.</p>
				<p>Используя профессиональные среды программирования, разработчики могут повысить свою производительность и эффективность, сократить время создания приложений и улучшить качество кода. Cреды также обеспечивают поддержку многих языков программирования, что облегчает разработчикам работу на выбранном ими языке, независимо от платформы, на которую они ориентируются. Профессиональные среды программирования также предоставляют обширную документацию и учебники, облегчая разработчикам изучение новых технологий и методов.</p>
				<p>Использование профессиональных сред программирования является важнейшим аспектом современной разработки программного обеспечения, и это важный навык для любого разработчика. Изучая и используя эти среды, разработчики могут максимально эффективно использовать свое время и ресурсы и создавать высококачественные, эффективные и инновационные приложения.</p>
				";
			}
			else if ($theme_id === '5') {
				echo "
				<p>Машинное обучение - это методики и техника, которые используются для обучения системы на основе данных. Эти методы используются для обучения алгоритма на обучающем наборе данных, чтобы улучшить его работу на новых, невидимых данных. Целью машинного обучения является создание алгоритмов, которые могут автоматически обучаться на основе данных и делать прогнозы или принимать решения, не будучи явно запрограммированными на это. В машинном обучении используются такие методы, как контролируемое обучение, неконтролируемое обучение и обучение с подкреплением. Эта тема является быстро развивающейся областью информатики и находит применение в различных областях, таких как распознавание образов, обработка естественного языка, компьютерное зрение, робототехника и др.</p>
				";
			}
			else if ($theme_id === '6') {
				echo "
				<p>Эта тема охватывает проектирование, разработку, развертывание и сопровождение программных приложений, обеспечивающих поддержку изучения и применения прикладной математики. Это включает, в частности, программное обеспечение для моделирования, численные решатели, программное обеспечение для оптимизации и программное обеспечение для статистического анализа.</p>
				<p>Данная тема представляет интерес для студентов, которые планируют сделать карьеру в области математического моделирования или вычислительных исследований, а также для тех, кто заинтересован в разработке математического программного обеспечения.</p>
				<p>Цель данной темы - познакомить студентов с принципами компьютерного программирования и разработки программного обеспечения, а также предоставить практический опыт в написании программных приложений, поддерживающих изучение и применение прикладной математики. Результатом изучения данной темы является приобретение студентами навыков и знаний, необходимых для разработки и сопровождения математических программных приложений, а также содействие их способности проводить исследования в области прикладной математики с использованием вычислительных методов.</p>
				";
			}
		?>
	</div>
	<div class="search_filter">
	<?php		
		$q = "CREATE TEMPORARY TABLE tmp1 as SELECT DISTINCT * FROM topics_NIR LEFT OUTER JOIN teachers ON topics_NIR.teacher = teachers.id_p WHERE topics_NIR.type = '$theme_id'";
		mysqli_query($conn, $q);
		$q = "SELECT DISTINCT id_p, name, surname, middle_name FROM tmp1";
		$query_teacher = mysqli_query($conn, $q);


		//$query_teacher = mysqli_query($conn, "SELECT DISTINCT * FROM topics_NIR LEFT OUTER JOIN teachers ON topics_NIR.teacher = teachers.id_p WHERE topics_NIR.type = '$theme_id'");
		//$query_teacher = mysqli_query($conn, "SELECT * FROM `teachers` ORDER BY surname;");
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
		$q = "DROP TEMPORARY TABLE tmp1";
	?>
	<br>Если клетка "студент" пустая, то тема свободна.
	</div>
	<div class="listOfSmth">
			<?php
				// Create a temporary table
				$query = "CREATE TEMPORARY TABLE tmp as SELECT topics_NIR.type AS type_thema, topics_NIR.year as thema_year, topics_NIR.name_theme AS thema, Students.name as stud_name, Students.surname as stud_surname, Students.middle_name as stud_middlename, topics_NIR.student as stud_id, topics_NIR.teacher as teacher_id FROM topics_NIR LEFT OUTER JOIN Students ON topics_NIR.student = Students.id_s;";
				mysqli_query($conn, $query);

				// Execute query
				$query = "SELECT tmp.type_thema, tmp.thema_year, tmp.thema, tmp.stud_name, tmp.stud_surname, tmp.stud_middlename, tmp.stud_id, tmp.teacher_id, teachers.name as teacher_name, teachers.surname as teacher_surname, teachers.middle_name as teacher_middlename FROM tmp LEFT OUTER JOIN teachers ON tmp.teacher_id = teachers.id_p WHERE tmp.type_thema = '$theme_id' ORDER BY teacher_surname";

				$results = mysqli_query($conn, $query);

				echo "
				<table cellpadding='5'>
				<thead>
					<tr>
						<th>Название</th>
						<th>Студент</th>
						<th>Преподаватель</th>
						<th>Год</th>
					</tr>
				</thead>
				";
				echo "<option value='none_type' selected=''></option>";
				while ($VKR = mysqli_fetch_assoc($results)) {
					$id_s_tmp = $VKR['stud_id'];
					$id_p_tmp = $VKR['teacher_id'];
					echo "<tr><td aria-label='Название темы'>$VKR[thema]</td><td aria-label='Студент'><a class='user_idle' href='studentid{$id_s_tmp}'>$VKR[stud_surname] $VKR[stud_name] $VKR[stud_middlename] <a/></td><td aria-label='Преподаватель'><a class='user_idle' href='teacherid{$id_p_tmp}'>$VKR[teacher_surname] $VKR[teacher_name] $VKR[teacher_middlename]</a></td><td aria-label='Год'>$VKR[thema_year]</td></tr>";
					};
				echo "</table>";
				$query = "DROP TEMPORARY TABLE tmp";
				mysqli_query($conn, $query);
			?>
		</div>
	<div class="next_theme">
		<?php
		if ($theme_id != '6') {
			$next_theme = $theme_id + 1;
			echo "<form action='themenumber{$next_theme}'>
					<button class='download_btn'>Следующая тема</button>
				</form>
			";
		} else if ($theme_id === '6'){
			echo "<form action='NIRS.php'>
					<button class='download_btn'>Все темы</button>
				</form>
			";
		}
		?>
	</div>
</div>

<script type="text/javascript">
		$(document).ready(function(){
			$("#select_type_theme").on('change',function(){
				var value = $(this).val();
				//alert(value);
				$.ajax({
					url: "select_type_work.php",
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
					url: "select_type_work.php",
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

<?php
	require "blocks/footer.php";
?>