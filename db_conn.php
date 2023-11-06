<?php
	$par1_ip="localhost";
	$par2_name="root";
	$par3_p = "";
	$par4_db = "MAI";

	//$par1_ip="localhost";
	//$par2_name="a0807474_MAINIRS";
	//$par3_p = "dbMAInirs2023";
	//$par4_db = "a0807474_MAINIRS";

	$conn = mysqli_connect($par1_ip, $par2_name, $par3_p, $par4_db);

	if ($conn == false){
		echo "Ошибка подключения";
	}