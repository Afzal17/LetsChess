<!DOCTYPE html>
<html>

	<?php
		// Header Navigation
		include('header/header.php');
		// Database File & Functions & Classes
		include('database/database.php');

		// If Check
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$naam = $_POST['naam'];
			$telefoonnummer = $_POST['telefoonnummer'];


			$sql = "INSERT INTO schaakvereniging (naam, telefoonnummer) VALUES (:naam, :telefoonnummer)";

			$placeholder = [
				'naam'=>$naam,
				'telefoonnummer'=>$telefoonnummer
			];

			$db = new database();
			$db->insert($sql, $placeholder, 'schaakverenigingen.php');

		} // End of the if check

	?>

	<body>

		<h1 style="text-align: center">Add Schaakvereniging</h1>

		<div class="container">
			<form action="add_schaakverenigingen.php" method="POST">
				<label for="naam">Schaakvereniging:</label>
				<input type="text" name="naam" required><br>
				<label for="telefoonnummer" name="telefoonnummer" required>Telefoonnummer</label>
				<input type="text" name="telefoonnummer"><br>
				<input type="submit" value="Add Schaakvereniging">
			</form>
		</div>

	</body>

</html>