<?php 
	// connection to database
	$conn = mysqli_connect('localhost', 'root', '', 'yum_pizzas');
	if(!$conn){
		echo mysqli_connect_error();
	}
 ?>