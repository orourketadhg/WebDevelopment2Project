<?php
	session_start();

	//check session is logged in
	if($_SESSION['LoggedIn'] == true) {

	    // open database connection
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');
		
		//echo "In Session";

		//SQL required for showing all books
		$bookSQL = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryID, Reserved FROM Book";
		//$reserveBookSQL = "UPDATE Book SET (Reserved = 'Y') WHERE ISBN = '$ISBN';";

		$books = mysqli_query($db, $bookSQL);

		if(!$books) {
		    echo "Database Failure: Error Code 1";

        }
		else {

            //turn $books into a 3 dimensional array
            //Dimension 1 : groups of 5 books
            //Dimension 2 : one of the 5 books in Dimension 1
            //Dimension 3 : access data piece of one books in Dimension 2

            $bookArray = Array(Array(Array()));
            $bookArraySQL = Array();


            while($row = mysqli_fetch_row($books)) {
                $bookArraySQL[] = $row;

            }

            //loop through groups of 5
            for($i = 0; $i < 2; $i++) {

                //loop through each book in a group of 5
                for($j = 0; $i < 5; $i++) {

                    //add book instance data to BookArray
                    for($k = 0; $k < 7; $k++) {
                        $bookArray[$i][$j][$k] = $bookArraySQL[$k];


                    }

                }

            }

//            print_r($bookArray);

            echo "<table border=1>";



            $i = 0;

            for($j = 0; $j < 5; $j++) {

                echo "<tr>";

                for($k = 0; $k < 7; $k++){
                    echo "<td>";
                    echo ($bookArray[$i][$j][$k]);
                    echo "</td>";
                }

                echo "</tr>";

            }

//		    while ($row = mysqli_fetch_row($books)) {
//                echo "<tr><td>";
//                echo ($row[0]);
//                echo "</td><td>";
//                echo ($row[1]);
//                echo "</td><td>";
//                echo ($row[2]);
//                echo "</td><td>";
//                echo ($row[3]);
//                echo "</td><td>";
//                echo ($row[4]);
//                echo "</td><td>";
//                echo ($row[5]);
//                echo "</td><td>";
//                echo ($row[6]);
//                echo "</td></tr>";
//            }

            echo "</tr>";

            echo "</table>";

        }

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
		header('Location: index.php');

	}

?>

<html>
	<form method="post">
		<input type="submit" value="Logout" name="Logout">

	</form>

</html>