<?php 
	// Including the DB configuration
	include('config/db_config.php');

	// Write SQL Query
	$sql = "SELECT title, ingredients, id FROM pizzas ORDER BY created_at";

	// make query & get result
	$result = mysqli_query($conn, $sql);

	// fetch the resulting rows as an array
	// MYSQLI_ASSOC to get the associate array of records data
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// Free $result from the memory
	mysqli_free_result($result);

	// close connection
	mysqli_close($conn);

 ?>
<!DOCTYPE html>
<html>
	<?php  include('templates/header.php'); ?>
	<h4 class="center grey-text">Pizzas!</h4>

	<div class="container">
		<div  class="row">
			<?php foreach ($pizzas as $pizza) : ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($pizza['title']) ?></h6>
							<ul>
								<?php foreach (explode(',', $pizza['ingredients']) as $ingredient) : ?>
									<li><?php echo htmlspecialchars($ingredient) ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="card-action right-align">
							<a href="details.php?id=<?php echo htmlspecialchars($pizza['id']);?>" class="brand-text" >more info</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php  include('templates/footer.php'); ?>
</html>