<?php

    include 'Searching.php';
    include 'SessionCheck.php';

    // URL : UserPage.php?page=X&maxPage=X&search=X


    // Function to generate dropdown menu for categories
    function DropDownCategories() {

        $Categories = DropDownCategoryList();

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


    function DropDownReservable($books) {

        $reservable = getUnreservedBooks($books);

        // create drop down
        echo '<label for="ReserveBox">Reserve a book:</label>';
        echo '<select name="Reservebook" id="ReserveBox">';

        echo '<option name="Default">-- Choose a book to reserve --</option>';

        // give category options
        for($i = 0; $i < count($reservable); $i++) {
            echo "<option name=$reservable[$i]>$reservable[$i]</option>";

        }

        echo ' </select>';

    }

    // function to display a group of 5 books
    function display($books) {

        // ToDo : add dropdown with book titles

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

        for ($i = 0; $i < count($books); $i++) {

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


    function pagination() {

        $pagePlus = $_GET['page'] + 1;
        $pageMinus = $_GET['page'] - 1;

        if ($_GET['page'] == 1) {
            echo "<a href='UserPage.php?page=$pagePlus'>Next</a>";

            display(allBooks(5 * ($_GET['page'] - 1) , 5));

        }
        else if ($_GET['page'] == 3) {
            echo "<a href='UserPage.php?page=$pageMinus'>Previous</a>";

            display(allBooks( 5 * ($_GET['page'] - 1), 5));

        }
        else {
            echo "<a href='UserPage.php?page=$pageMinus'>Previous</a>";
            echo "<a href='UserPage.php?page=$pagePlus'>Next</a>";

            display(allBooks(5 * ($_GET['page'] - 1) , 5));

        }

    }



