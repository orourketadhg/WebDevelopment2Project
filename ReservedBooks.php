<?php

    // Todo : Add Display Reserved Books functionality - only 5 books per page
    // Todo : Add un-reserve book functionality

    //start session
    session_start();

    function UnreserveBook($db, $user, $ISBN) {

        $date = date("d-M-Y");

        $ReserveBookSQl1 = "UPDATE Book SET Reserved = N WHERE ISBN = '$ISBN';";
        $ReserveBookSQl2 = "DELETE * FROM Reserved WHERE Username = '$user' AND ISBN = '$ISBN';";

        $SQL3Result = mysqli_query($db, $ReserveBookSQl1);
        $SQL4Result = mysqli_query($db, $ReserveBookSQl2);

        if(!$SQL4Result) {
            echo "Database Failure: Error Code 2";

        }
        else if (!$SQL4Result) {
            echo "Database Failure: Error Code 3";

        }

    }

    // check if session is logged in
    if($_SESSION['LoggedIn']) {

        //open database connection
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        //get sessions username
        $user = $_SESSION['Username'];

        // SQL required for Reserved Books page
        //Todo : Fix foreign key bug in linking books and reserved
        $userReservedSQl = "SELECT ISBN, BookTitle, Author, Year, CategoryID, Reserved FROM Book JOIN Reserved  (ISBN) WHERE Username = '$user';";

        $SQLResult = mysqli_query($db, $userReservedSQl);

        if (!$SQLResult) {
            echo "Database Failure: Error Code 1";

        }
        else {

            $bookArraySQL = Array();

            // add each row array to a array (2D array)
            while($row = mysqli_fetch_row($SQLResult)) {
                $bookArraySQL[] = $row;

            }

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

            for ($i = 0; $i < count($bookArraySQL); $i++) {

                echo "<tr>";

                //loop through each book printing its data
                for ($j = 0; $j < 7; $j++) {
                    if ($j != 8) {
                        echo "<td>";
                        echo $bookArraySQL[$i][$j];
                        echo "</td>";
                    }
                    else {
                        echo "<td>";
                        echo '<button type="button">Reserve</button>';
                        echo "</td>";
                    }

                }

                echo "</tr>";

            }

            echo "</table>";
        }


        // close database connection
        mysqli_close($db);

        //logout button is clicked go to confirmation page.
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

