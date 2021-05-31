<?php
		// Header Navigation
		include('header/header.php');
		// Database File & Functions & Classes
		include('database/database.php');
		// New Database Instance
		$db = new database();
		// Making a variable for our dropdown to select
		$schaakverenigingen = $db->select("SELECT * FROM schaakvereniging", []);

		if($_SERVER['REQUEST_METHOD'] == 'POST') {

			$sql = "INSERT INTO speler VALUES (:id, :voornaam, :tussenvoegsel, :achternaam, :schaakvereniging_id, :neemtDeel)";

			$placeholder = [

				'id'=> NULL,
				'voornaam'=>$_POST['voornaam'],
				'tussenvoegsel'=>$_POST['tussenvoegsel'],
				'achternaam'=>$_POST['achternaam'],
				'schaakvereniging_id'=>$_POST['schaakvereniging'],
				'neemtDeel'=> 0
			];
			 var_dump($placeholder);


			$db->insert($sql, $placeholder, 'spelers.php');

		}

	?>

<body>

		<h1 style="text-align: center;">Add Spelers</h1>

		<div class="content">
			<form action="add_spelers.php" method="POST">
				<!--<input type="hidden" name="id" value="<?php //echo($_GET['id']) ?>">-->
				<label for="voornaam">Voornaam:</label>
				<input type="text" name="voornaam" required><br>
				<label for="tussenvoegsel">Tussenvoegsel:</label>
				<input type="text" name="tussenvoegsel"><br>
				<label for="achternaam">Achternaam:</label>
				<input type="text" name="achternaam" required><br>

				<label for="schaakvereniging">Selecteer Schaakvereniging</label>

				<?php if(is_array($schaakverenigingen) && !empty($schaakverenigingen)) { ?>
				<select name="schaakvereniging" required>
					<?php foreach($schaakverenigingen as $vereniging){?>
						<option value="<?php echo $vereniging['id'];?>">
							<?php echo $vereniging['naam'];?>
						</option>
					<?php } ?>
				</select><br><br>
				<?php }else { ?>
					<p class="warning">First add a schaakvereniging</p>
				<?php } ?>

				<input type="submit" value="Add Schaakvereniging">

			</form>
		</div>

</body>