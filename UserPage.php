<?php

    //Todo : add link to search page
    //Todo : add link to users reserved books

    //start the session
	session_start();

	//check session is logged in
	if($_SESSION['LoggedIn'] == true) {

	    // open database connection
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        //test to see if in session
		//echo "In Session";

		//SQL required for showing all books
		$bookSQL = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryID, Reserved FROM Book";
		//$reserveBookSQL = "UPDATE Book SET (Reserved = 'Y') WHERE ISBN = '$ISBN';";

        //books query
		$books = mysqli_query($db, $bookSQL);

		if(!$books) {
		    echo "Database Failure: Error Code 1";

        }
		else {

		    // Turn SQL query result into usable format
            $bookArraySQL = Array();
            // add each row array to a array (2D array)
            while($row = mysqli_fetch_row($books)) {
                $bookArraySQL[] = $row;

            }

            //table to display books
            echo "<table border=1>";

            // Table Column names
            echo "<tr>";
            echo "<th>ISBN</th>";
            echo "<th>Book Title</th>";
            echo "<th>Author</th>";
            echo "<th>Edition</th>";
            echo "<th>Year</th>";
            echo "<th>Category ID</th>";
            echo "<th>Reserved</th>";
            echo "</tr>";

            // Todo : add so user can click button to see next 5 books

            // Loop through books printing 5 to the page at any one time
            for($i = 0; $i < 5; $i++) {

                echo "<tr>";

                //loop through each book printing its data
                for($j = 0; $j < 7; $j++) {
                    echo "<td>";
                    echo $bookArraySQL[$i][$j];
                    echo "</td>";

                }

                echo  "</tr>";

            }

            echo "</table>";

        }

		//logout button is clicked go to confirmation page.
		if(isset($_POST['Logout'])){
			$result = $_POST['Logout'];
			header ('Location: Logout.php');
			
		}
		else {
			$result = null;

		}

		// close database connection
		mysqli_close($db);
		
	}
	else {
	    // if not in session force to index.php
		header('Location: index.php');

	}

?>


<html>
    <!-- Logout Button html -->
	<form method="post">
		<input type="submit" value="Logout" name="Logout">

	</form>

</html>