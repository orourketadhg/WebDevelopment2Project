<?php

    include 'Searching.php';

    // function to display a table of given books
    function Display($Books)
    {
        //table to display books
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

        // loop through each book
        for ($i = 0; $i < count($Books); $i++) {

            // create row
            echo "<tr>";

            // loop though each book's data
            for ($j = 0; $j < 7; $j++) {
                echo "<td>";
                echo $Books[$i][$j];
                echo "</td>";

            }

            // end row
            echo "</tr>";

        }

    }


    // generate dropdown menu for categories
    function DropDown() {

        $Categories = DropDownCategories();

        // handling default load value
        if (!$_POST) {
            $_POST['SearchCategory'] = '';
        }

        // create drop down
        echo '<label for="CategoryBox">Category:</label>';
        echo '<select name="SearchCategory" id="CategoryBox">';

        echo '<option name="Default">-- Choose a Category --</option>';

        // give category options
        for($i = 0; $i < count($Categories); $i++) {
            echo "<option name=$Categories[$i]>$Categories[$i]</option>";

        }

        echo ' </select>';
    }


    // function to split books into groups of <= 5
    function splitBooks($Books){

        // split books into groups of 5 or less than 5
        $pages = array_chunk($Books, 5);

        PageButtons($pages);

        // get page variable
        $PageNumber = $_SESSION['page'];

        // if the number of pages is greater than 1
        if ($_SESSION['page'] > 1) {
            // display table of books on page
            Display($pages[$PageNumber]);

        }
        // else there is only 1 page of books
        else {
            Display($pages[0]);

        }

    }


    // function to search either with text box or category
    function Books() {


        // if TextBox is filled and Post occurs
        if (isset($_POST['SearchBox']) && !empty($_POST['SearchBox'])){
            $TextResult = TextSearch($_POST['SearchBox']);

            if ($TextResult!= array()) {
                splitBooks($TextResult);
            }

        }
        // else if a category is selected and Post occurs
        else if (isset($_POST['SearchCategory']) && isset($_POST['SearchCategory']) != 'Default') {
            $DropDownResult = DropDownSearch($_POST['SearchCategory']);

            if ($DropDownResult!= array()) {
                splitBooks($DropDownResult);

            }


        }
        // else display all books
        else {
            StartBooks();

        }

    }

    function PageButtons($pageMax) {

        echo '<form method="post">';

        echo '<input type="submit" name="Next" value="Next">';
        echo '<input type="submit" name="Previous" value="Previous">';

        echo '</form>';

        if ($_POST) {

            if (isset($_POST['Next']) && $_SESSION['page'] != $pageMax) {
                $_SESSION['page'] = $_SESSION['page'] + 1;

            } else if (isset($_POST['Previous']) && $_SESSION['page'] != 0) {

                $_SESSION['page'] = $_SESSION['page'] - 1;
            }

        }

    }
