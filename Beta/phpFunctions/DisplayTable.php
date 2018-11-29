<?php

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