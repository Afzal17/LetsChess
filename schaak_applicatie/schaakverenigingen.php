<!DOCTYPE html>
<html>

	<?php

		// Include Navigation
		include('header/header.php');
		// Include Database File
		include('database/database.php');
		// New Database Instance
		$db = new database();
		// Select * FROM toernooi
		$result_set = $db->select("SELECT * FROM schaakvereniging", []);
		// Get Array Keys
		$columns = array_keys($result_set[0]);
		// Get Array Values
		$result_set1 = $db->select("SELECT * FROM schaakvereniging", []);

		// $_GET['id'] -> DELETE schaakvereniging
		if(isset($_GET['id'])) {
			$db->edit_or_delete("DELETE FROM schaakvereniging WHERE id=:id", ['id'=>$_GET['id']], "Schaakverenigingen.php");
		}


	?>

	<body>

		<h1 style="text-align: center;">Schaakverenigingen</h1>

		<div class="content">
			<a href="add_schaakverenigingen.php" style="padding-bottom: 10px;">Add Schaakvereniging</a>
			<table>

				<tr>
					<?php foreach($columns as $column) { ?>
						<th><?php echo $column ?></th>
					<?php } ?>
				</tr>

				<!-- Foreach loop where we want the values of the array -->
					<?php foreach($result_set1 as $rows => $row) { ?>

						<?php $row_id = $row['id']; ?>
						<tr>
							<?php foreach($row as $row_data) { ?>
							<td>
								<?php echo $row_data ?>
							</td>
							<?php } ?>
							<td>
								<!-- Here you can edit the id and the rest of the values -->
								<a href="edit_schaakverenigingen.php?id=<?php echo $row_id; ?>">Edit</a>

								<!-- Here you can delete the id and the rest of the values -->
								<a
									onclick="return confirm('You are deleting a schaakvereniging')"
									href="Schaakverenigingen.php?id=<?php echo $row_id; ?>">Delete
								</a>
							</td>
						</tr>


					<?php } ?>



			</table>
		</div>
	</body>

</html>