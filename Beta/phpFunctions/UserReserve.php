<?php

    include "ReserveFunctions.php";

    function GetUserReserved($user, $start_from, $end, $countOption=0) {
        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        $userReservedBooksSQL = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryDesc FROM book JOIN category Using (CategoryID) JOIN reserved USING (ISBN) WHERE Username = '$user' LIMIT $start_from, $end";

        $result = mysqli_query($db, $userReservedBooksSQL);

        // close connection to database
        mysqli_close($db);

        if (!$result) {
            echo "Error Code 1 : SQL Query Error";

        }
        else {
            $books = array();

            while ($row = mysqli_fetch_row($result)) {
                $books[] = $row;

            }

            if ($countOption == 0) {
                return $books;

            }
            else if ($countOption == 1){
                return count($books);

            }

        }

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
        echo "<th>Unreserve Book</th>";

        echo "</tr>";

        for ($i = 0; $i < count($books); $i++) {

            echo '<tr>';

            for ($j = 0; $j < 7; $j++) {

                if ($j != 6) {
                    echo "<td>";
                    echo $books[$i][$j];
                    echo "</td>";
                }
                else if ($j == 6){
                    $ISBN = $books[$i][0];

                    echo "<td>";
                    echo "<a href='UserReservedBooks.php?page=1&Unreserve=$ISBN'>Unreserve</a>";
                    echo "</td>";

                }

            }

            echo '</tr>';

        }

        echo "</table>";

    }


    function UserReservedPage() {

        $user = $_SESSION['Username'];

        $reservedCount = GetUserReserved($user, 0, 15, 1);

        $pagePlus = $_GET['page'] + 1;
        $pageMinus = $_GET['page'] - 1;

        if (isset($_GET['Unreserve']) && $_GET['Unreserve'] != "") {
            UnreserveBook($user, $_GET['Unreserve']);

        }

        if ($reservedCount > 5) {

            if ($_GET['page'] == 1) {
                display(GetUserReserved($user, 5 * ($_GET['page'] - 1), 5));

                echo "<a href=''>Next</a>";

            } else if ($_GET['page'] == 3) {
                display(GetUserReserved($user, 5 * ($_GET['page'] - 1), 5));

                echo "<a href='UserReservedBooks.php?page=$pageMinus&Unreserve='>Previous</a>";

            } else {
                display(GetUserReserved($user, 5 * ($_GET['page'] - 1), 5));

                echo "<a href='UserReservedBooks.php?page=$pageMinus&Unreserve='>Previous</a>";
                echo "<a href='UserReservedBooks.php?page=$pagePlus&Unreserve='>Next</a>";

            }

        }
        else if ($reservedCount > 0) {
            display(GetUserReserved($user, 5 * ($_GET['page'] - 1), 5));

        }
        else {
            echo "You have No Reserved Books";

        }

    }

