<?php
	session_start();

	if($_SESSION['LoggedIn'] == true) {
		
		echo "In Session";
		
		if(isset($_POST['Logout'])){
			$result = $_POST['Logout'];
			header ('Location: Logout.php');
			
		}
		else {
			$result = null;

		}
		
	}
	else {
		header('Location: index.php');

	}

?>

<html>
	<form method="post">
		<input type="submit" value="Logout" name="Logout">

	</form>

</html>