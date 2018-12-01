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

        if (isset($_GET['page'])) {
            $pagePlus = $_GET['page'] + 1;
            $pageMinus = $_GET['page'] - 1;

        }

        if ($_GET['search'] == 'all') {

            if ($_GET['page'] == 1) {
                display(allBooks(5 * ($_GET['page'] - 1), 5));

                echo "<a href='UserPage.php?page=$pagePlus&search=all'>Next</a>";

            } else if ($_GET['page'] == 3) {
                display(allBooks(5 * ($_GET['page'] - 1), 5));

                echo "<a href='UserPage.php?page=$pageMinus&search=all'>Previous</a>";

            } else {
                display(allBooks(5 * ($_GET['page'] - 1), 5));

                echo "<a href='UserPage.php?page=$pageMinus&search=all'>Previous</a>";
                echo "<a href='UserPage.php?page=$pagePlus&search=all'>Next</a>";

            }

        }
        else if ($_GET['search'] != 'all') {

            $searchKey = $_GET['search'];

            if (substr_count($searchKey, '+') > 0) {
                $checkedKey = str_replace('+', ' ', $searchKey);

                $searchKey = $checkedKey;

            }

            $bookCount = TextSearchCount($searchKey);

            $limit = ceil($bookCount / 5);

            if (isset($_GET['page'])) {

                if ($_GET['page'] == 1) {
                    display(TextSearch($searchKey, 0, 5));

                    echo "<a href='UserPage.php?page=$pagePlus&search=$searchKey'>Next</a>";

                }
                else if ($_GET['page'] == $limit){

                    display(TextSearch($searchKey, 5 * ($_GET['page'] - 1), 5));
                    echo "<a href='UserPage.php?page=$pageMinus&search=$searchKey'>Previous</a>";

                }
                else {
                    display(TextSearch($searchKey, 5 * ($_GET['page'] - 1), 5));

                    echo "<a href='UserPage.php?page=$pageMinus&search=$searchKey'>Previous</a>";
                    echo "<a href='UserPage.php?page=$pagePlus&search=$searchKey'>Next</a>";

                }

            }
            else {

                if ($bookCount > 0) {
                    display(TextSearch($searchKey, 0, 5));

                    if ($bookCount > 5) {
                        echo "<a href='UserPage.php?page=2&search=$searchKey'>Next</a>";

                    }

                }
                else {
                    echo "No Books Found";

                }

            }

        }

    }



