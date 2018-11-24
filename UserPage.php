<?php
	session_start();

	if($_SESSION['LoggedIn'] == true) {
		
		echo '<form method="post">';
		echo '<input type="submit" value="Logout" name="Logout">';
		echo '</form>';
		
		echo "In Session";
		$result = $_POST['Logout'];
		
		if($result){
			session_destroy();
			header ('Location: index.php');
			
		}
		
	}
	else {
		echo "Please Log In";
	}
?>
