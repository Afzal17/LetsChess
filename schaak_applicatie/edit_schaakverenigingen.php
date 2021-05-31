<?php
		// Header Navigation
		include('header/header.php');
		// Database File & Functions & Classes
		include('database/database.php');

		// If Check
		if($_SERVER['REQUEST_METHOD'] == "POST"){

				$naam = $_POST["naam"];
				$telefoonnummer = $_POST["telefoonnummer"];

				$db = new database();

				$sql = "UPDATE Schaakvereniging SET naam=:naam, telefoonnummer=:telefoonnummer WHERE id=:id";

				$placeholder = [
					'naam'=>$naam,
					'telefoonnummer'=>$telefoonnummer,
					'id'=>$_POST['id']
				];

				$db->edit_or_delete($sql, $placeholder, 'schaakverenigingen.php');

		} // End of the if check

	?>

<body>

		<h1 style="text-align: center;">Edit Schaakverenigingen</h1>

		<div class="content">
			<form action="edit_schaakverenigingen.php" method="POST">
				<input type="hidden" name="id" value="<?php echo($_GET['id']) ?>">
				<label for="naam">Naam:</label>
				<input type="text" name="naam" required><br>
				<label for="telefoonnummer">Telefoonnummer:</label>
				<input type="text" name="telefoonnummer" required><br>
				<input type="submit" value="Edit Schaakvereniging">
			</form>
		</div>

</body>