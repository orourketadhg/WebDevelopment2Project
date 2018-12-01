<?php
    // ToDo : Add ability to reserve book

    include 'phpFunctions/Pagination.php';
    include 'phpFunctions/SessionCheck.php';

    SessionCheck();
 ?>

<html lang="en">

    <head>
        <title>Userpage</title>
    </head>

    <body>
        <a href="UserPage.php?page=1&search=all&SearchCategory=&Reserve=">Home</a>
        <a href="UserReservedBooks.php?page=1&Unreserve=">My Reserved Books</a>
        <a href="Logout.php">Logout</a>

        <form action="UserPage.php?page=1&" method="get">

            <div id="searching">
                <?php DropDownCategories(); ?>

                <label for="SearchText">Search:</label>
                <input type="search" name="search" id="SearchText">

                <input type="submit" name="SubmitText">

            </div>

            <?php pagination();?>

        </form>

    </body>

</html>


