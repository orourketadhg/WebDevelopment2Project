<?php
    // ToDo : Add search by category
    // ToDo : Add display table
    // ToDo : Add only 5 books per table
    // ToDo : Add functionality for next and previous 5 books in table
    // ToDo : Add ability to reserve book

    include 'phpFunctions/SessionCheck.php';
    include 'phpFunctions/Searching.php';

    $Categories = DropDownCategories();
 ?>

<html lang="en">
    <?php SessionCheck();?>
    <head>
        <title>Userpage</title>
    </head>

    <body>
        <a href="UserReservedBooks.php">My Reserved Books</a>
        <a href="Logout.php">Logout</a>

        <form method="post">
            <?php

                if ($_POST) {
                    $TextResult = TextSearch($_POST['SearchBox']);

                    if ($TextResult!= array()) {
                        print_r($TextResult);

                    }
                }
            ?>

            <div>
                <label for="SearchBox">Search:</label>
                <input type="text" name="SearchBox" id="SearchBox">

                <select name="SearchCategory">

                </select>

            </div>

            <input type="submit" name="Submit">

        </form>

    </body>

</html>
