<?php
    // ToDo : Add search by category
    // ToDo : Add display table
    // ToDo : Add only 5 books per table
    // ToDo : Add functionality for next and previous 5 books in table
    // ToDo : Add ability to reserve book

    include 'phpFunctions/SessionCheck.php';
    include 'phpFunctions/Searching.php';

    SessionCheck();
    $Categories = DropDownCategories();
 ?>

<html lang="en">

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



                    <?php
                       echo '<label for="CategoryBox">Category:</label>';
                       echo '<select name="SearchCategory" id="CategoryBox">';

                       echo '<option name="Default">-- Choose a Category --</option>';

                        for($i = 0; $i < count($Categories); $i++) {
                            echo "<option name=$Categories[$i]>$Categories[$i]</option>";

                        }

                        echo '</select>';

                        $DropDownResult = $_POST['SearchCategory'];
                        echo $DropDownResult;


                    ?>

            </div>

            <input type="submit" name="Submit">

        </form>

    </body>

</html>
