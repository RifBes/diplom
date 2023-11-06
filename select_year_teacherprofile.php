<?php 
include "db_conn.php";

if (isset($_POST['request'])) {

	$users_id = $_COOKIE['teacherid'];
	//print($users_id);

	$request = $_POST['request'];
	//print($request);

	if ($request === 'none_year') {
		exit();
	}
	$query = "SELECT * FROM `topics_VKR` WHERE teacher ='$users_id' AND year = '$request'";

	$results = mysqli_query($conn, $query);

	$count = mysqli_num_rows($results);
?>

<div class="listOfSmth_thm">
	<table class="table">
		<?php

		if ($count) {
		?>
		<thead>
			<tr>
				<th>Название</th>
			</tr>
			<?php
		} else{
			echo "В этот год преподаватель не работал со студентами";
		}
			?>
		</thead>
		<tbody>
			<?php
				while ($VKR = mysqli_fetch_assoc($results)) {
					echo "<tr><td>$VKR[name_theme]</td></tr>";
				};
			?>
		</tbody>
	</table>
</div>
<?php 
}
?>