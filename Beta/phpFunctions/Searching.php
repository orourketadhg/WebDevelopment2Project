<?php

    // function get books from search box
    function TextSearch($input, $start_from, $limit) {

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB') or die(mysqli_error($db));

        // real escape string check
        $input = mysqli_real_escape_string($db, $input);

        // SQL required for text box search
        $searchQuerySQL = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryDesc, Reserved FROM Book JOIN Category USING (CategoryID) WHERE BookTitle LIKE '%$input%' OR Author LIKE '%$input%' LIMIT $start_from, $limit;;";

        // SQL query for text box search
        $Result = mysqli_query($db, $searchQuerySQL);

        // close connection to database
        mysqli_close($db);

        // if SQL query failed
        if ($Result == false) {
            return "Error Code 2 : SQL Query Error";

        } // else SQL query success
        else if ($Result == true){
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


    // function to return the number of books in a search
    function TextSearchCount ($input) {

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB') or die(mysqli_error($db));

        // real escape string check
        $input = mysqli_real_escape_string($db, $input);

        // SQL required for text box search
        $searchQuerySQL = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryDesc, Reserved FROM Book JOIN Category USING (CategoryID) WHERE BookTitle LIKE '%$input%' OR Author LIKE '%$input%';";

        // SQL query for text box search
        $Result = mysqli_query($db, $searchQuerySQL);

        // close connection to database
        mysqli_close($db);

        // if SQL query failed
        if ($Result == false) {
            return "Error Code 2 : SQL Query Error";

        } // else SQL query success
        else if ($Result == true){
            // create empty array for queried books
            $ResultBooks = array();

            // turn query result into usable array
            while($row = mysqli_fetch_row($Result)) {
                $ResultBooks[] = $row;

            }

            // return number of books found by searchKey
            return count($ResultBooks);

        }

    }


    // function to get the dropdown menu options
    function DropDownCategoryList() {

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB') or die(mysqli_error($db));

        // SQL required to get dropdown menu items
        $dropdownCategoryList = "SELECT CategoryDesc FROM Category";

        // SQL query to get category options
        $CategoriesResult = mysqli_query($db, $dropdownCategoryList);

        // close connection to database
        mysqli_close($db);

        // if query failure
        if ($CategoriesResult == false) {
            return "Error Code 3 : Query Error";
        }
        // else query success
        else {
            // empty array for categories
            $Categories = array();

            //turn rows into a 1D array
            While($row = mysqli_fetch_row($CategoriesResult)) {
                $Categories[] = $row[0];
            }

            return $Categories;

        }

    }


    // function to get the result of the drop down menu
    function DropDownSearch($input, $start_from, $limit) {

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB') or die(mysqli_error($db));

        // SQL required to get books by category
        $CategoryQuerySQL = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryDesc, Reserved FROM Book JOIN Category USING (CategoryID)WHERE CategoryDesc = '$input' LIMIT $start_from, $limit;";

        // SQL query for books by category
        $CategoryQueryResult = mysqli_query($db, $CategoryQuerySQL);

        // close connection to database
        mysqli_close($db);

        // if query failure
        if ($CategoryQueryResult == false) {
            return "Error Code 4 : Query Error";

        }
        // else query success
        else {
            // create empty array for books
            $CategoryBooks = array();

            // turn query into usable array of books
            While($row = mysqli_fetch_row($CategoryQueryResult)) {
                $CategoryBooks[] = $row;
            }

            // return array full of books by specified category
            return $CategoryBooks;

        }

    }


    // function to get the number of books in a category
    function DropDownSearchCount($input) {
        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB') or die(mysqli_error($db));

        // SQL required to get books by category
        $CategoryQuerySQL = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryDesc, Reserved FROM Book JOIN Category USING (CategoryID)WHERE CategoryDesc = '$input';";

        // SQL query for books by category
        $CategoryQueryResult = mysqli_query($db, $CategoryQuerySQL);

        // close connection to database
        mysqli_close($db);

        // if query failure
        if ($CategoryQueryResult == false) {
            return "Error Code 4 : Query Error";

        }
        // else query success
        else {
            // create empty array for books
            $CategoryBooks = array();

            // turn query into usable array of books
            While($row = mysqli_fetch_row($CategoryQueryResult)) {
                $CategoryBooks[] = $row;
            }

            // return number of books in category
            return count ($CategoryBooks);

        }

    }


    // function to show all books at the start of a page
    function allBooks($start_from, $limit) {

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB') or die(mysqli_error($db));

        // SQL required to get all books
        $BooksQuerySQL = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryDesc, Reserved FROM Book JOIN Category USING (CategoryID) LIMIT $start_from, $limit;";

        // SQL query for all books
        $BooksQueryResult = mysqli_query($db, $BooksQuerySQL);

        // close connection to database
        mysqli_close($db);

        // if query failure
        if ($BooksQueryResult == false) {
            return "Error Code 1 : Query Error";

        }
        // else query success
        else {
            // create empty array for books
            $Books = array();

            // turn query into usable array of books
            While($row = mysqli_fetch_row($BooksQueryResult)) {
                $Books[] = $row;
            }

            // create Table of all books
            return $Books;

        }

    }

