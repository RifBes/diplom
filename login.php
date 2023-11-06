<?php
	$title = "Вход";
	require "blocks/header.php";
?>
	<div class="intro">
		<section class="login_body">
			<div class="login-form-form">
				<form action="login_enter.php" method="post">
					<h2>Вход</h2>
					<div style="background: #F2DEDE; color: red; border-radius: 5px; text-align: center; margin: 20px auto;
">
					<?php 
						if (isset($_GET['error'])) {
							if ($_GET['error'] == "emptyinput") {
								echo "<p>Заполните все поля</p>";
							}
							else if ($_GET['error'] == "wrongLogin") {
								echo "<p>Неверный логин</p>";
							}
							else if ($_GET['error'] == "wrongPassword") {
								echo "<p>Неверный пароль</p>";
							}
						}
					?>
				</div>
					<input type="text" name="uid" placeholder="Логин"><br>
					<input type="password" name="pwd" placeholder="Пароль"><br>
					<button type="submit" name="submit">Войти</button>
				</form>

			</div>
		
		</section>
	</div>
<?php
	require "blocks/footer.php";
?>