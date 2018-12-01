<?php


    // function to reserve a book
    function UnreserveBook($user, $ISBN) {

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        // SQL required to unreserve a book
        $ReserveBookSQl1 = "UPDATE `book` SET `Reserved` = 'N' WHERE `ISBN` = '$ISBN';";
        $ReserveBookSQl2 = "DELETE FROM Reserved WHERE Username = '$user' AND ISBN = '$ISBN';";

        // Unreserve book SQL queries
        $SQL3Result = mysqli_query($db, $ReserveBookSQl1);
        $SQL4Result = mysqli_query($db, $ReserveBookSQl2);

        // close connection to database
        mysqli_close($db);

        // if SQL query error
        if(!$SQL4Result) {
            echo "Error Code 1 : SQL Query Error";

        }
        // else if SQL query error
        else if (!$SQL3Result) {
            echo "Error Code 2 : SQL Query Error";

        }

    }


    // function to reserve a book
    function ReserveBook($ISBN, $user) {

        // get current date
        $date = date("d-M-Y");

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        // SQL required to reserve a book
        $ReserveBookSQl1 = "UPDATE `book` SET `Reserved` = 'Y' WHERE `ISBN` = '$ISBN';";
        $ReserveBookSQl2 = "INSERT INTO `Reserved` (`ISBN`, `Username`, `ReservedDate`) VALUES ('$ISBN', '$user', '$date');";

        // reserve book SQL queries
        $SQL1Result = mysqli_query($db, $ReserveBookSQl1);
        $SQL2Result = mysqli_query($db, $ReserveBookSQl2);

        // close connection to database
        mysqli_close($db);

        //if SQL query error
        if(!$SQL1Result) {
            echo "Error Code 3 : SQL Query Error";

        }
        //else if SQL query error
        else if (!$SQL2Result) {
            echo "Error Code 4 : SQL Query Error";

        }

    }


    function getUnreservedBooks($books) {

        $reservableBooks = array();

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB') or die(mysqli_error($db));

        $result = mysqli_query($db, "SELECT BookTitle FROM book WHERE Reserved = 'N'");

        mysqli_close($db);

        if (!$result) {
            return "Error Code 5 : SQL Query Error";

        }
        else {

            //turn rows into a 1D array
            While($row = mysqli_fetch_row($result)) {
                $reservableBooks[] = $row[0];
            }

            return $reservableBooks;

        }

    }
