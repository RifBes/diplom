<?php
	include "db_conn.php";
	$title = "Главная";
	require "blocks/header.php";
?>
	<div class="intro">
		<h1><center>Главная страница</center></h1>
		<div class="Emblema_MAI">
			<img src="assets/pictures/emblema.png" alt="Emblema_MAI" align="left" width="170" height="170" style=" border: 9px solid #ffffff;">
			<br>
			<p>Добро пожаловать на веб-сайт кафедры 805 "Математическая кибернетика". Здесь собраны данные о научно-исследовательских работах, а также хранятся списки актуальных выпускных квалификационных работ. Каждому студенту предлагается возможность изучить список актуальных проектов и выбрать любой понравившийся.</p>
		</div>
		<br><br>
		<h2><center>Направления выпускных и научных работ студентов</center></h2>
		<p>Каждая научная работа и выпускная работа имеет определённый тип. Вы можете ознакомиться с ними ниже, кликнув на интересующую тему.</p>
		<div class="row" style="margin-left: 15px; margin-right: 15px;">
			<div class="col-md-6 col-xl-3">
				<div class="card">
					<img src="assets/pictures/theme1.jpg">
  					<div class="card-body">
  						<?php 
							$query = mysqli_query($conn, "SELECT * FROM `themes` WHERE id_t=1;");
							$array = mysqli_fetch_array($query);
							$thema_id = $array['id_t'];
						echo "
						  	<h4 class='card-title'>$array[type_name]</h4>
						  	<p style='color: grey; font-size: 14px'>Нажмите, чтобы ознакомиться</p>
						  	<a href='themenumber{$thema_id}' class='btn btn-primary'>Перейти</a>";
  						?>
  					</div>
				</div>
			</div>
			<div class="col-md-6 col-xl-3">
				<div class="card">
					<img src="assets/pictures/theme2.jpg">
  					<div class="card-body">
  						<?php 
							$query = mysqli_query($conn, "SELECT * FROM `themes` WHERE id_t=2;");
							$array = mysqli_fetch_array($query);
							$thema_id = $array['id_t'];
						echo "
						  	<h4 class='card-title'>$array[type_name]</h4>
						  	<p style='color: grey; font-size: 14px'>Нажмите, чтобы ознакомиться</p>
						  	<a href='themenumber{$thema_id}' class='btn btn-primary'>Перейти</a>";
  						?>
  					</div>
				</div>
			</div>
			<div class="col-md-6 col-xl-3">
				<div class="card">
					<img src="assets/pictures/theme3.jpg">
  					<div class="card-body">
  						<?php 
							$query = mysqli_query($conn, "SELECT * FROM `themes` WHERE id_t=3;");
							$array = mysqli_fetch_array($query);
						?>
  						<h4 class="card-title"><?=$array['type_name']?></h4>
  						<p style='color: grey; font-size: 14px'>Нажмите, чтобы ознакомиться</p>
  						<a href="themenumber3" class="btn btn-primary">Перейти</a>
  					</div>
				</div>
			</div>
			<div class="col-md-6 col-xl-3">
				<div class="card">
					<img src="assets/pictures/theme4.jpg">
  					<div class="card-body">
  						<?php 
							$query = mysqli_query($conn, "SELECT * FROM `themes` WHERE id_t=4;");
							$array = mysqli_fetch_array($query);
							$thema_id = $array['id_t'];
						echo "
						  	<h4 class='card-title'>$array[type_name]</h4>
						  	<p style='color: grey; font-size: 14px'>Нажмите, чтобы ознакомиться</p>
						  	<a href='themenumber{$thema_id}' class='btn btn-primary'>Перейти</a>";
  						?>
  					</div>
				</div>
			</div>
			<div class="col-md-6 col-xl-3" style="margin-top: 25px;">
				<div class="card">
					<img src="assets/pictures/theme5.jpg">
  					<div class="card-body">
  						<?php 
							$query = mysqli_query($conn, "SELECT * FROM `themes` WHERE id_t=5;");
							$array = mysqli_fetch_array($query);
						$thema_id = $array['id_t'];
						echo "
						  	<h4 class='card-title'>$array[type_name]</h4>
						  	<p style='color: grey; font-size: 14px'>Нажмите, чтобы ознакомиться</p>
						  	<a href='themenumber{$thema_id}' class='btn btn-primary'>Перейти</a>";
  						?>
  					</div>
				</div>
			</div>
			<div class="col-md-6 col-xl-3" style="margin-top: 25px;">
				<div class="card">
					<img src="assets/pictures/theme6.jpg">
  					<div class="card-body">
  						<?php 
							$query = mysqli_query($conn, "SELECT * FROM `themes` WHERE id_t=6;");
							$array = mysqli_fetch_array($query);
						$thema_id = $array['id_t'];
						echo "
						  	<h4 class='card-title'>$array[type_name]</h4>
						  	<p style='color: grey; font-size: 14px'>Нажмите, чтобы ознакомиться</p>
						  	<a href='themenumber{$thema_id}' class='btn btn-primary'>Перейти</a>";
  						?>
  					</div>
				</div>
			</div>
			<div class="col-md-6 col-xl-3" style="margin-top: 25px;">
				<div class="card">
					<img src="assets/pictures/all_nir.jpeg">
  					<div class="card-body">
						  	<h4 class='card-title'>Все темы НИР</h4>
						  	<p style='color: grey; font-size: 14px'>Нажмите, чтобы ознакомиться</p>
						  	<a href='NIRS.php' class='btn btn-primary'>Перейти</a>
  					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	require "blocks/footer.php";
?>