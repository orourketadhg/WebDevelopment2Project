<?php

    // ToDo : Alter code to allow partial searches

    // function to search either with text box or category
    function SearchType() {

        // if TextBox is filled and Post occurs
        if ($_POST && !empty($_POST['SearchBox'])){
            $TextResult = TextSearch($_POST['SearchBox']);

            if ($TextResult!= array()) {
                print_r($TextResult);

            }

        }
        // else if a category is selected and Post occurs
        else if ($_POST && $_POST['SearchCategory'] != 'Default') {
            $DropDownResult = DropDownSearch($_POST['SearchCategory']);

            if ($DropDownResult!= array()) {
                print_r($DropDownResult);

            }

        }

    }


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


    // function to get the dropdown menu options
    function DropDownCategories() {

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
    function DropDownSearch($input) {

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB') or die(mysqli_error($db));

        // SQL required to get books by category
        $CategoryQuerySQL = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryDesc, Reserved FROM Book JOIN Category USING (CategoryID)WHERE CategoryDesc = '$input'";

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


