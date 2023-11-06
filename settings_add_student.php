<?php
	include "db_conn.php";
	$title = "Настройки";
	require "blocks/header.php";
?>

<?php
	$users_id = $_SESSION["user_id_p"];
	$query = mysqli_query($conn, "SELECT * FROM `teachers` WHERE id_p = '$users_id';");
	$array = mysqli_fetch_array($query);
?>

<div class="intro">
	<h1><center>Добавить студента</center></h1>
	<h5><center>Преподаватель <?=$array['surname']?> <?=$array['name']?> <?=$array['middle_name']?></center></h5>
	<div class="settings_add_stud">
			<div class="settings_box">
				<h2><center>НИР</center></h2>
				<form action="add_student.php" method="post">
					<div style="background: #F2DEDE; color: red; border-radius: 5px; text-align: center; margin: 20px auto;
">
					<?php 
						if (isset($_GET['error'])) {
							if ($_GET['error'] == "emptyinput_stud") {
								echo "<p>Заполните поля</p>";
							}
							else if ($_GET['error'] == "wrongstudent") {
								echo "<p>Такого студента нет</p>";
							}
						}
					?>
					</div>
					<?php
						$sql = "SELECT * FROM `topics_NIR` WHERE student is NULL and teacher = '$users_id';";
						$query = mysqli_query($conn, $sql);
						echo "<h4>Выберите тему</h4>";
					?>
					<select required name="select_theme" class='slct_theme'>
						<option value='none_theme' selected=''></option>
					<?php
						while ($theme_pick = mysqli_fetch_array($query)) {
							echo '<option value="'. $theme_pick['id_n'] .'">' . $theme_pick['name_theme'] . '</option>';
						}
					?>
					</select>
					<h4>Студент</h4>
					<input type="text" name="student_thema">
					<small>Введите ФИО студента. Пример: Иванов Иван Иванович</small>
					<button type="submit" name="submit" class="btn_save">Сохранить</button>
				</form>
			</div>
		</div>
	
</div>

<?php
	require "blocks/footer.php";
?>