<?php

    // ToDo : Add ability to change Pages via button clicks
    // ToDo : Add separate books in groups of books of 5 or less
    // ToDo : Get the search option

    // change header to form link with new URL variables

    include 'Searching.php';
    include 'SessionCheck.php';

    // URL : UserPage.php?page=X&maxPage=X&search=X


    // Function to generate dropdown menu for categories
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


    // Function for main checks and actions
    function onLoad() {
        SessionCheck();

    }


    function pages() {

        echo "<form method='post'>";

        echo "<input type='submit' name='Previous' value='Previous'>";
        echo "<input type='submit' name='Next' value='Next'>";

        echo "</form>";

        $page = $_GET['page'];

        if (isset($_POST['Previous']) && $_GET['page'] != 0) {
            $page = updatePageNumber(-1);

        }
        else if (isset($_POST['Next']) && $_GET['maxPage'] != $page) {
            $page = updatePageNumber(1);

        }


        if (isset($_GET['search']) == 'all') {

            $books = StartBooks();

            // separate books into groups of 5
            $separatedBooks = array_chunk($books, 5);

            $bookCount = count($separatedBooks[$page]);

            display($separatedBooks[$page], $bookCount);

        }


    }


    // function to display a group of 5 books
    function display($books, $bookCount) {

        // create table
        echo "<table border=1>";

        // create row for column headers
        echo "<tr>";

        echo "<th>ISBN</th>";
        echo "<th>Title</th>";
        echo "<th>Author</th>";
        echo "<th>Edition</th>";
        echo "<th>Year</th>";
        echo "<th>Category</th>";
        echo "<th>Reserved</th>";

        echo "</tr>";

        for ($i = 0; $i < $bookCount; $i++) {

            echo '<tr>';

            for ($j = 0; $j < 7; $j++) {
                echo "<td>";
                echo $books[$i][$j];
                echo "</td>";

            }

            echo '</tr>';

        }

        echo "</table>";

    }


    // function to decide on page numbering
    function getMaxPage($Books) {

        // seperate books into groups of 5
        $separatedBooks = array_chunk($Books, 5);

        //return the number of groups as the max pages
        return count($separatedBooks);

    }


    //function to either increment of decrement the page number
    function updatePageNumber($option) {

        //get the page variable from URL
        $pageNumber = $_GET['page'];

        if ($option == '1') {
            return $pageNumber + 1;
        }
        else if ($option == '-1') {
            return $pageNumber - 1;
        }

    }


