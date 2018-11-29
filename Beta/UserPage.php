<?php
    // ToDo : Add functionality for next and previous 5 books in table
    // ToDo : Add ability to reserve book

    include 'phpFunctions/HomeFunctions.php';

    onLoad();
 ?>

<html lang="en">

    <head>
        <title>Userpage</title>
    </head>

    <body>
        <a href="UserPage.php?page=0">Home</a>
        <a href="UserReservedBooks.php">My Reserved Books</a>
        <a href="Logout.php">Logout</a>

        <form method="post">

            <div>
                <label for="SearchBox">Search:</label>
                <input type="text" name="SearchBox" id="SearchBox">

                <?php DropDown();?>

            </div>

            <input type="submit" name="Submit">

        </form>

    </body>

</html>


