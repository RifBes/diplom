<?php
	include "db_conn.php";
	$title = "Настройки";
	require "blocks/header.php";
?>
	<?php
		$users_id = $_SESSION["user_id_s"];
		$query = mysqli_query($conn, "SELECT * FROM `Students` WHERE id_s = '$users_id';");
		$array = mysqli_fetch_array($query);
	?>
	<div class="intro_settings_stud">
		<h1><center>Настройки профиля</center></h1>
		<h5><center>Студент <?=$array['surname']?> <?=$array['name']?> <?=$array['middle_name']?></center></h5>
		<div class="settings_profile_stud">
			<div class="settings_box">
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
					<h4>Пароль</h4>
					<input type="password" name="pass_change">
					<h4>Повторите пароль</h4>
					<input type="password" name="pass_change_two">
					<button type="submit" name="submit" class="btn_save">Сохранить</button>
				</form>
			</div>
		</div>
	</div>

<?php
	require "blocks/footer.php";
?>