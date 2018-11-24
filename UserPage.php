<?php
	session_start();

	//check session is logged in
	if($_SESSION['LoggedIn'] == true) {
		
		echo "In Session";

		//SQL required for showing all books
		$bookSQL = "SELECT ISBN, BookTitle, Author, Year, CategoryID, Reserved FROM Book";
		$reserveBookSQL = "UPDATE Book SET (Reserved = 'Y') WHERE ISBN = '$ISBN';";

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