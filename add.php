<?php 

	$errors = array('email' =>'', 'title' =>'', 'ingredients' => '');
	$email = $title = $ingredients = '';
	// isset() with _POST checks if there was any post request made on add.php
	// and response backs accordingly.
	// this kind of code can give rise to XSS. (All user to execute any javascript or command)
	// so we use htmlspechialchars to sanitize the received inputs

	if(isset($_POST['submit'])){
		
		if(empty($_POST['email'])){
			$errors['email'] = 'An Email is required';
		}
		else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Enter valid Email Address';
			}
			else{
				$email = htmlspecialchars($email);	
			}
			
		}
		if(empty($_POST['title'])){
			$errors['title'] = 'A Title is required';
		}
		else{
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Enter valid Email Address';
			}
			else{
				$title = htmlspecialchars($title);	
			}
			
		}
		if(empty($_POST['ingredients'])){
			$errors['ingredients'] = 'Ingerdients are required';
		}
		else{
			$ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
				$errors['ingredients'] = 'Enter comma separated ingredients';
			}
			else{
				$ingredients = htmlspecialchars($ingredients);	
			}
		}

		// If there were no error we redirect
		if(!array_filter($errors)){
			// if there were any errors
			header('Location: index.php');
		}
	}
 ?>
<!DOCTYPE html>
<html>
	<?php  include('templates/header.php'); ?>
	<section class="container grey-text">
		<h4 class="center">Add a Pizza</h4>
		<form action="add.php" method="POST" class="white">
			<label>Your Email:</label>
			<input type="text" name="email" value="<?php echo $email ?>">
				<div class="red-text">
					<?php echo $errors['email'] ?>
				</div>
			<label>Pizza Title:</label>
			<input type="text" name="title" value="<?php echo $title ?>">
				<div class="red-text">
					<?php echo $errors['title'] ?>
				</div>
			<label>Ingerdients (comma separated):</label>
			<input type="text" name="ingredients" value="<?php echo $ingredients ?>">
				<div class="red-text">
					<?php echo $errors['ingredients'] ?>
				</div>
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>

		</form>
	</section>
	<?php  include('templates/footer.php'); ?>
</html>