<?php

    // function get books from search box
    function TextSearch($input) {
        if (isset($_POST['SearchBox']) && !empty($_POST['SearchBox'])) {

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
                return "Error Code 2 : SQL Query Error";

            } // else SQL query success
            else {
                // create empty array for queried books
                $ResultBooks = array();

                // turn query result into usable array
                while($row = mysqli_fetch_row($Result)) {
                    $ResultBooks[] = $row;

                }

                // return queried books
                return $ResultBooks;

            }


        }
        else {
            return "Error Code 1 : Text Box must be Filled";

        }

    }


    //function to get the result of the drop down menu
    function DropDownSearch($input) {

    }