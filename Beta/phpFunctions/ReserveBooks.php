<?php

    // function to reserve a book
    function UnreserveBook($user, $ISBN) {

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        // SQL required to unreserve a book
        $ReserveBookSQl1 = "UPDATE Book SET Reserved = N WHERE ISBN = '$ISBN';";
        $ReserveBookSQl2 = "DELETE * FROM Reserved WHERE Username = '$user' AND ISBN = '$ISBN';";

        // Unreserve book SQL queries
        $SQL3Result = mysqli_query($db, $ReserveBookSQl1);
        $SQL4Result = mysqli_query($db, $ReserveBookSQl2);

        // close connection to database
        mysqli_close($db);

        // if SQL query error
        if(!$SQL4Result) {
            return "Error Code 1 : SQL Query Error";

        }
        // else if SQL query error
        else if (!$SQL3Result) {
            return "Error Code 2 : SQL Query Error";

        }
        // else book is unreserved
        else {
            return "Unreserved Book";

        }


    }


    // function to reserve a book
    function ReserveBook($user, $ISBN) {

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        // get current date
        $date = date("d-M-Y");

        // SQL required to reserve a book
        $ReserveBookSQl1 = "UPDATE Book SET Reserved = Y WHERE ISBN = '$ISBN';";
        $ReserveBookSQl2 = "INSERT INTO Reserved (ISBN, Username, ReservedDate) VALUES ('$ISBN', '$user', '$date');";

        // reserve book SQL queries
        $SQL1Result = mysqli_query($db, $ReserveBookSQl1);
        $SQL2Result = mysqli_query($db, $ReserveBookSQl2);

        // close connection to database
        mysqli_close($db);

        //if SQL query error
        if(!$SQL1Result) {
            return "Error Code 3 : SQL Query Error";

        }
        // else if SQL query error
        else if (!$SQL2Result) {
            return "Error Code 4 : SQL Query Error";

        }
        // else book is reserved
        else {
            return "Book Reserved";

        }

    }


    function getUnreservedBooks($books) {

        $bookTitles = array();

        for ($i = 0; $i < count($books); $i++) {
            $bookTitles[] = $books[$i][1];

        }

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB') or die(mysqli_error($db));

        // SQL required for text box search
        $searchQuerySQL = "SELECT BookTitle FROM Book WHERE Reserved = 'N' AND BookTitle IN '$bookTitles'; ";

        // SQL query for text box search
        $Result = mysqli_query($db, $searchQuerySQL);

        // close connection to database
        mysqli_close($db);

        // if SQL query failed
        if ($Result == false) {
            return "Error Code 1 : SQL Query Error";

        } // else SQL query success
        else if ($Result == true){
            // create empty array for queried books
            $ReservableBooks = array();

            // turn query result into usable array
            while($row = mysqli_fetch_row($Result)) {
                $ResultBooks[] = $row[0];

            }

            // return queried books
            return $ReservableBooks;

        }

    }
