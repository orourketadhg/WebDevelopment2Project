<?php

    // function get books from search box
    function TextSearch($input) {

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB') or die(mysqli_error($db));

        // real escape string check
        $input = mysqli_real_escape_string($db, $input);

        // SQL required for text box search
        $searchQuerySQL = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryID, Reserved FROM Book WHERE BookTitle = '$input' OR Author = '$input';";

        // SQL query for text box search
        $Result = mysqli_query($db, $searchQuerySQL);

        // close connection to database
        mysqli_close($db);


        // if SQL query failed
        if ($Result == false) {
            return "Error Code 1 : SQL Query Error";

        }
        // else SQL query success
        else {

            // empty array for the new search
            $ResultBooks = Array();

            // append book from query to empty array
            while ($row = mysqli_fetch_row($Result)) {
                $ResultBooks[] = $row;

            }

            // return books from search
            return $ResultBooks;

        }

    }