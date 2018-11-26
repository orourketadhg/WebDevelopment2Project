<?php

    //Todo : add link to search page
    //Todo : add link to users reserved books
    //Todo : Add ability to reserve book

    // function to reserve book
    function ReserveBook($db, $user, $ISBN) {

        $date = date("d-M-Y");

        $ReserveBookSQl1 = "UPDATE Book SET Reserved = Y WHERE ISBN = '$ISBN';";
        $ReserveBookSQl2 = "INSERT INTO Reserved (ISBN, Username, ReservedDate) VALUES ('$ISBN', '$user', '$date');";

        $SQL1Result = mysqli_query($db, $ReserveBookSQl1);
        $SQL2Result = mysqli_query($db, $ReserveBookSQl2);

        if(!$SQL1Result) {
            echo "Database Failure: Error Code 3";

        }
        else if (!$SQL2Result) {
            echo "Database Failure: Error Code 4";

        }

    }

    //start the session
	session_start();

	//check session is logged in
	if($_SESSION['LoggedIn'] == true) {


        // Turn SQL query result into usable format
        $bookArraySQL = Array();

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

		    echo $_SESSION['Next'];
		    echo $_SESSION['Previous'];

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
            echo "<th>Reserve</th>";
            echo "</tr>";

            // Todo : fix bug requiring 2 button presses for next and previous

            // create empty array for book ISBN's to be used to get the id of the book to be reserved
            $bookReserveISBN = Array();

            // Loop through books printing 5 to the page at any one time
            for($i = $_SESSION['Previous']; $i < $_SESSION['Next']; $i++) {

                echo "<tr>";

                // loop through each book printing its data
                for($j = 0; $j < 8; $j++) {
                    // add book ISBN to ISBN array
                    $bookReserveISBN[] = $bookArraySQL[$i][0];

                    if ($j != 7) {
                        echo "<td>";
                        echo $bookArraySQL[$i][$j];
                        echo "</td>";
                    }
                    // create button to reserve book
                    else if ($bookArraySQL[$i][6] != 'Y') {
                        echo "<td>";
                        // set
                        echo "<button type='button' id='reserveButton' name='$j'>Reserve</button>";
                        echo "</td>";
                    }
                    // if book already reserved
                    else if ($bookArraySQL[$i][6] == 'Y'){
                        echo "<td>";
                        echo "Unable to reserve";
                        echo "</td>";
                    }

                }

                echo  "</tr>";

            }

            echo "</table>";

        }

        if (isset($_POST['Previous']) && $_SESSION['Previous'] != 0) {
            $_SESSION['Next'] = $_SESSION['Next'] - 5;
            $_SESSION['Previous'] = $_SESSION['Previous'] - 5;

        }

        if (isset($_POST['Next']) && ($_SESSION['Next'] != count($bookArraySQL))) {
            $_SESSION['Next'] = $_SESSION['Next'] + 5;
            $_SESSION['Previous'] = $_SESSION['Previous'] + 5;

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
    <!-- Logout, previous and next Button html -->
	<form method="post">
        <input type="submit" value="Previous" name="Previous">
        <input type="submit" value="Next" name="Next">
		<input type="submit" value="Logout" name="Logout">

	</form>

</html>