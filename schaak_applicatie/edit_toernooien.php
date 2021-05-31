<?php
		// Header Navigation
		include('header/header.php');
		// Database File & Functions & Classes
		include('database/database.php');

		// If Check
		if($_SERVER['REQUEST_METHOD'] == "POST"){

				$toernooi = $_POST["toernooi"];

				$db = new database();

				$sql = "UPDATE toernooi SET toernooi=:toernooi WHERE id=:id";

				$placeholder = [
					'toernooi'=>$toernooi,
					'id'=>$_POST['id']
				];

				$db->edit_or_delete($sql, $placeholder, 'toernooien.php');

		} // End of the if check

	?>

<body>
		<h1 style="text-align: center;">Edit Toernooien</h1>
		<div class="content">
			<form action="edit_toernooien.php" method="POST">
				<input type="hidden" name="id" value="<?php echo($_GET['id']) ?>">
				<label for="toernooi">Toernooi:</label>
				<input type="text" name="toernooi" required>
				<input type="submit" value="Edit Toernooi">
			</form>
		</div>

</body>