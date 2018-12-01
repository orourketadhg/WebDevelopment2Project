<?php

    include 'Searching.php';
    include 'SessionCheck.php';
    include "ReserveBooks.php";

    // URL : UserPage.php?page=X&maxPage=X&search=X


    // Function to generate dropdown menu for categories
    function DropDownCategories() {

        $Categories = DropDownCategoryList();

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
        echo '<select name="reserveBook" id="ReserveBox">';

        echo '<option name="Default">-- Choose a book to reserve --</option>';

        // give category options
        for($i = 0; $i < count($reservable); $i++) {
            echo "<option name=$reservable[$i]>$reservable[$i]</option>";

        }

        echo '</select>';

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
        echo "<th>Reserve Book</th>";

        echo "</tr>";

        for ($i = 0; $i < count($books); $i++) {

            echo '<tr>';

            for ($j = 0; $j < 8; $j++) {

                if ($j != 7) {
                    echo "<td>";
                    echo $books[$i][$j];
                    echo "</td>";
                }
                else if ($books[$i][6] == 'Y'){
                    echo "<td>";
                    echo "Unable to Reserve";
                    echo "</td>";

                }
                else {
                    $ISBN = $books[$i][0];

                    echo "<td>";
                    echo "<a href='UserPage.php?page=1&search=all&SearchCategory=&Reserve=$ISBN'>Reserve</a>";
                    echo "</td>";

                }

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


        if (isset($_GET['Reserve']) && $_GET['Reserve'] != "") {
            ReserveBook($_GET['Reserve'], $_SESSION['Username']);

            header('Location: UserPage.php?page=1&search=all&SearchCategory=&Reserve=');

        }

        if ($_GET['search'] == 'all') {

            if ($_GET['page'] == 1) {
                display(allBooks(5 * ($_GET['page'] - 1), 5));

                echo "<a href='UserPage.php?page=$pagePlus&search=all&SearchCategory=&Reserve='>Next</a>";

            } else if ($_GET['page'] == 3) {
                display(allBooks(5 * ($_GET['page'] - 1), 5));

                echo "<a href='UserPage.php?page=$pageMinus&search=all&SearchCategory=&Reserve='>Previous</a>";

            } else {
                display(allBooks(5 * ($_GET['page'] - 1), 5));

                echo "<a href='UserPage.php?page=$pageMinus&search=all&SearchCategory=&Reserve='>Previous</a>";
                echo "<a href='UserPage.php?page=$pagePlus&search=all&SearchCategory=&Reserve='>Next</a>";

            }

        }
        else if (($_GET['SearchCategory'] != '--+Choose+a+Category+--' && $_GET['SearchCategory'] != '') && $_GET['search'] == '') {
            $categoryKey = $_GET['SearchCategory'];

            $bookCount = DropDownSearchCount($categoryKey);

            $limit = ceil($bookCount / 5);

            if (isset($_GET['page'])) {

                if ($_GET['page'] == 1) {
                    display(DropDownSearch($categoryKey, 0, 5));

                    echo "<a href='UserPage.php?page=$pagePlus&search=&SearchCategory=$categoryKey&Reserve='>Next</a>";

                }
                else if ($_GET['page'] == $limit){
                    display(DropDownSearch($categoryKey, 5 * ($_GET['page'] - 1), 5));

                    echo "<a href='UserPage.php?page=$pageMinus&search=&SearchCategory=$categoryKey&Reserve='>Previous</a>";

                }
                else {
                    display(DropDownSearch($categoryKey, 5 * ($_GET['page'] - 1), 5));

                    echo "<a href='UserPage.php?page=$pageMinus&search=&SearchCategory=$categoryKey&Reserve='>Previous</a>";
                    echo "<a href='UserPage.php?page=$pagePlus&search=&SearchCategory=$categoryKey&Reserve='>Next</a>";

                }


            }
            else {
                if ($bookCount > 0) {
                    display(DropDownSearch($categoryKey, 0, 5));

                    if ($bookCount > 5) {
                        echo "<a href='UserPage.php?page=2&search=&SearchCategory=$categoryKey&Reserve='>Next</a>";

                    }

                }
                else {
                    echo "No Books Found";

                }
            }

        }
        else if ($_GET['search'] != 'all' && $_GET['search'] != '') {

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

                    echo "<a href='UserPage.php?page=$pagePlus&search=$searchKey&SearchCategory=&Reserve='>Next</a>";

                }
                else if ($_GET['page'] == $limit){

                    display(TextSearch($searchKey, 5 * ($_GET['page'] - 1), 5));

                    echo "<a href='UserPage.php?page=$pageMinus&search=$searchKey&SearchCategory=&Reserve='>Previous</a>";

                }
                else {
                    display(TextSearch($searchKey, 5 * ($_GET['page'] - 1), 5));

                    echo "<a href='UserPage.php?page=$pageMinus&search=$searchKey&SearchCategory=&Reserve='>Previous</a>";
                    echo "<a href='UserPage.php?page=$pagePlus&search=$searchKey&SearchCategory=&Reserve='>Next</a>";

                }

            }
            else {

                if ($bookCount > 0) {
                    display(TextSearch($searchKey, 0, 5));

                    if ($bookCount > 5) {
                        echo "<a href='UserPage.php?page=2&search=$searchKey&SearchCategory=&Reserve='>Next</a>";

                    }

                }
                else {
                    echo "No Books Found";

                }

            }

        }

    }



