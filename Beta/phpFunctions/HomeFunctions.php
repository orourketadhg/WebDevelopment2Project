<?php

    // ToDo : Add ability to change Pages via button clicks

    // change header to form link with new URL variables

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

    function pages() {

        $page = $_GET['page'];

        echo "<form method='post'>";

        echo "<input type='submit' name='Previous' value='Previous'>";
        echo "<input type='submit' name='Next' value='Next'>";

        echo "</form>";

        if (isset($_POST['Search']) && !empty($_POST['SearchBox'])){
            $input = $_POST['SearchBox'];

            $books = TextSearch($input);

            if (is_string($books)) {
                echo $books;

            }
            else if ($books == array()) {
                echo "No Books Found";
            }
            else {
                // separate books into groups of 5
                $separatedBooks = array_chunk($books, 5);

                //$bookCount = count($separatedBooks[$page]);
                $bookCount = count($books);

                display($separatedBooks[$page], $bookCount);
                DropDownReservable($separatedBooks[$page]);

            }

        }
        else if (isset($_POST['Search']) && $_POST['SearchCategory'] != "Default" && empty($_POST['SearchBox'])) {

            $input = $_POST['SearchCategory'];

            $books = DropDownSearch($input);

            if ($books == array()) {
                echo "Please a word or category to search";

            }
            else {

                // separate books into groups of 5
                $separatedBooks = array_chunk($books, 5);

                //$bookCount = count($separatedBooks[$page]);
                $bookCount = count($books);

                display($separatedBooks[$page], $bookCount);
                DropDownReservable($separatedBooks[$page]);

            }

        }
        else {
            $books = allBooks();

            // separate books into groups of 5
            $separatedBooks = array_chunk($books, 5);

            $bookCount = count($separatedBooks[$page]);

            display($separatedBooks[$page], $bookCount);
            DropDownReservable($separatedBooks[$page]);


        }

    }


    // function to display a group of 5 books
    function display($books, $bookCount) {

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



