<?php
    // ToDo : Add ability to reserve book

    include 'phpFunctions/HomeFunctions.php';

    SessionCheck();
 ?>

<html lang="en">

    <head>
        <title>Userpage</title>
    </head>

    <body>
        <a href="UserPage.php?page=1">Home</a>
        <a href="UserReservedBooks.php">My Reserved Books</a>
        <a href="Logout.php">Logout</a>

        <form method="post">

            <?php pagination();?>

            <div>
                <label for="SearchText">Search:</label>
                <input type="text" name="SearchBox" id="SearchText">

            </div>

            <input type="submit" name="Search">

        </form>

    </body>

</html>


