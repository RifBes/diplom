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
	<div class="intro_settings">
		<h1><center>Настройки профиля</center></h1>
		<h5><center>Преподаватель <?=$array['surname']?> <?=$array['name']?> <?=$array['middle_name']?></center></h5>
		<div class="settings_profile">
			<div class="settings_box">
				<h3><center>Изменить личные данные</center></h3>
				<form action="settings_inc.php" method="post">
					<div style="background: #F2DEDE; color: red; border-radius: 5px; text-align: center; margin: 20px auto;
">
						<?php 
							if (isset($_GET['error'])) {
								if ($_GET['error'] == "emptyinput") {
									echo "<p>Заполните хотя бы одно поле</p>";
								}
								else if ($_GET['error'] == "wrongPhone") {
									echo "<p>Некорректный номер телефона</p>";
								}
								else if ($_GET['error'] == "wrongPasswordFill") {
									echo "<p>Заполните два поля с паролем</p>";
								}
								else if ($_GET['error'] == "wrongPassChange") {
									echo "<p>Пароли должны совпадать</p>";
								}
							}
						?>
					</div>
					<h4>Почта</h4>
					<input type="email" name="email_change" placeholder="<?=$array['email']?>">
					<h4>Телефон</h4>
					<input type="tel" name="phone_change" pattern="+7[0-9]{10}" placeholder="+7**********">
					<small>Пример: +7**********</small>
					<h4>Пароль</h4>
					<input type="password" name="pass_change">
					<h4>Повторите пароль</h4>
					<input type="password" name="pass_change_two">
					<button type="submit" name="submit" class="btn_save">Сохранить</button>
				</form>
			</div>
		</div>
		<div class="settings_profile_thema">
			<div class="settings_box">
				<h3><center>Добавить новую тему работы</center></h3>
				<form action="add_theme.php" method="post">
					<div style="background: #F2DEDE; color: red; border-radius: 5px; text-align: center; margin: 20px auto;
">
						<?php 
							if (isset($_GET['error'])) {
								if ($_GET['error'] == "emptyinput_theme") {
									echo "<p>Заполните название и год</p>";
								}
								else if ($_GET['error'] == "wrongData") {
									echo "<p>Некорректный год</p>";
								}
								else if ($_GET['error'] == "wrongDatatype") {
									echo "<p>Год должен быть числом</p>";
								}
								else if ($_GET['error'] == "wrongstudent") {
									echo "<p>Такого студента нет</p>";
								}
							}
						?>
					</div>
					<h4>ВКР или НИР</h4>
					<select required name="select_type">
						<option value='NIR'>НИР</option>
						<option value='VKR'>ВКР</option>
					</select>
					<h4>Название темы</h4>
					<textarea type="text" name="name_thema" rows="4" cols="30"></textarea>
					<h4>Студент</h4>
					<input type="text" name="student_thema">
					<small>Необязательное поле</small><br>
					<small>Введите ФИО студента. Пример: Иванов Иван Иванович</small>
					<h4>Год</h4>
					<input type="text" name="year_thema">
					<h4>Тип темы</h4>
					<?php
						//выбор типа темы
						$query_theme = mysqli_query($conn, "SELECT * FROM `themes`;");

						while ($theme_type = mysqli_fetch_assoc($query_theme)){
							$arr[] = $theme_type['type_name'];
						}
						echo "
							<select required name='select_theme' class='slct_theme'>
								<option value='1'>$arr[0]</option>
								<option value='2'>$arr[1]</option>
								<option value='3'>$arr[2]</option>
								<option value='4'>$arr[3]</option>
								<option value='5'>$arr[4]</option>
								<option value='6'>$arr[5]</option>
							</select>
						";
					?>
					<button type="submit" name="submit" class="btn_save">Сохранить</button>
				</form>
			</div>
		</div>
	</div>

<?php
	require "blocks/footer.php";
?>