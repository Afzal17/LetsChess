<!DOCTYPE html>
<html>

	<?php
		// Header Navigation
		include('header/header.php');
		// Database File & Functions & Classes
		include('database/database.php');

		// If Check
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$toernooi = $_POST['toernooi'];

			$sql = "INSERT INTO toernooi (toernooi) VALUES (:toernooi)";

			$placeholder = [
				'toernooi'=>$toernooi
			];

			$db = new database();
			$db->insert($sql, $placeholder, 'toernooien.php');

		} // End of the if check

	?>

	<body>

		<h1 style="text-align: center">Add Toernooi</h1>

		<div class="container">
			<form action="add_toernooien.php" method="POST">
				<label for="toernooi">Toernooi:</label>
				<input type="text" name="toernooi" required>
				<input type="submit" value="Add Toernooi">
			</form>
		</div>

	</body>

</html>