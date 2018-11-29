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


    //function to create drop down to reserve book
    function ReserveDropDown($Books) {

        // create empty array for books that can be reserved
        $Reservable = array();

        // loop through all books
        for ($i = 0; $i < count($Books); $i++) {

            // add book that can be reserved
            if ($Books[$i][6] == 'N') {
                $Reservable[] = $Books[$i][1];

            }
            // else continue
            else {
                continue;

            }

        }

        // handling default load value
        if (!$_POST) {
            $_POST['ReserveBook'] = '';
        }

        // create drop down
        echo '<label for="ReserveBox">Reserve Book:</label>';
        echo '<select name="ReserveBook" id="ReserveBox>';

        // default option
        echo '<option name="DefaultBook">-- Reserve Book --</option>';

        // add title of book to reserve box
        for($i = 0; $i < count($Reservable); $i++) {
            echo "<option name=$Reservable[$i]>$Reservable[$i]</option>";

        }

        echo ' </select>';


    }