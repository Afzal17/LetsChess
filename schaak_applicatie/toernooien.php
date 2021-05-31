<!DOCTYPE html>
<html>

	<?php

		// Include Navigation
		include('header/header.php');
		// Include Database File
		include('database/database.php');
		// New Database Instance
		$db = new database();
		// Select * toernooi
		$result_set = $db->select("SELECT * FROM toernooi", []);
		// Get Array Keys
		$columns = array_keys($result_set[0]);
		// Get Array Values
		$result_set1 = $db->select("SELECT * FROM toernooi", []);
		// if check for delete toernooi
		if(isset($_GET['id'])) {
			$db->edit_or_delete("DELETE FROM toernooi WHERE id=:id", ['id'=>$_GET['id']], "toernooien.php");
		}



	?>

	<body>

		<h1 style="text-align: center">Toernooien</h1>

		<div class="content">
			<a href="add_toernooien.php" style="padding-bottom: 10px;">Add Toernooi</a>

			<table>

				<tr>
					<!--
						Foreach loop where we want the first index of the array
					-->
					<?php foreach($columns as $column) { ?>
						<th><?php echo $column ?></th>
					<?php } ?>

					<th colspan="2">Action</th>
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
							<a href="edit_toernooien.php?id=<?php echo $row_id; ?>">Edit</a>

							<!-- Here you can delete the id and the rest of the values -->
							<a
								onclick="return confirm('You are deleting a toernooi')"
								href="toernooien.php?id=<?php echo $row_id; ?>">Delete
							</a>
						</td>
					</tr>


				<?php } ?>



			</table>

		</div>



	</body>

</html>