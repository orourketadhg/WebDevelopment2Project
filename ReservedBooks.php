<?php

    // Todo : Add Display Reserved Books functionality - only 5 books per page
    // Todo : Add un-reserve book functionality

    //start session
    session_start();

    function UnreserveBook($db, $user, $ISBN) {

        echo $db;
        echo $user;
        echo $ISBN;

        /*
        $ReserveBookSQl1 = "UPDATE Book SET Reserved = N WHERE ISBN = '$ISBN';";
        $ReserveBookSQl2 = "DELETE * FROM Reserved WHERE Username = '$user' AND ISBN = '$ISBN';";

        $SQL3Result = mysqli_query($db, $ReserveBookSQl1);
        $SQL4Result = mysqli_query($db, $ReserveBookSQl2);

        if(!$SQL4Result) {
            echo "Database Failure: Error Code 2";

        }
        else if (!$SQL3Result) {
            echo "Database Failure: Error Code 3";

        }
        */

    }

    // check if session is logged in
    if($_SESSION['LoggedIn']) {

        // open database connection
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        // get sessions username
        $user = $_SESSION['Username'];

        // SQL required for Reserved Books page
        $userReservedSQl = "SELECT ISBN, BookTitle, Author, Year, Edition, CategoryDesc, Reserved FROM Book JOIN Reserved USING (ISBN) JOIN Category USING (CategoryID) WHERE Username = '$user';";

        $SQLResult = mysqli_query($db, $userReservedSQl);


        // if SQL result returns a NULL value - Error code 1
        if (!$SQLResult) {
            echo "Database Failure: Error Code 1";

        }
        // else generate table from SQL data
        else {

            $bookArraySQL = Array();

            // add each book array to a array (2D array)
            while($row = mysqli_fetch_row($SQLResult)) {
                $bookArraySQL[] = $row;

            }

            //create table
            echo "<table border=1>";

            // Table Column names
            echo "<tr>";
            echo "<th>ISBN</th>";
            echo "<th>Book Title</th>";
            echo "<th>Author</th>";
            echo "<th>Edition</th>";
            echo "<th>Year</th>";
            echo "<th>Category</th>";
            echo "<th>Reserved</th>";
            echo "<th>Unreserve</th>";
            echo "</tr>";

            //loop through queried books array
            for ($i = 0; $i < count($bookArraySQL); $i++) {

                echo "<tr>";

                //loop through each book printing its data
                for ($j = 0; $j < 8; $j++) {
                    if ($j != 7) {
                        echo "<td>";
                        echo $bookArraySQL[$i][$j];
                        echo "</td>";
                    }
                    // create button to unreserve book
                    else if ($bookArraySQL[$i][7] != 'Y') {
                        $book = $bookArraySQL[$i][0];
                        echo "<td>";
                        echo "<form method='post'>";
                        //echo "<input type='hidden' name='$j'>";
                        echo "<input type='submit' name='$j' value='Unreserve'>";
                        echo "</form>";
                        //echo "<button type='button' name=''>Unreserve</button>";
                        echo "</td>";
                    }

                }

                echo "</tr>";

            }

            echo "</table>";
        }

        for ($i = 0; $i < count($bookArraySQL); $i++) {

            if (isset($_POST[$j])) {
                UnreserveBook($db, $user, $bookArraySQL[$i][0]);
            }


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
        header('Location: login.php');

    }

?>

<html>
    <form method="post">
        <input type="submit" value="Logout" name="Logout">
    </form>
</html>

