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
        <a href="UserPage.php?page=1&search=all&SearchCategory=">Home</a>
        <a href="UserReservedBooks.php">My Reserved Books</a>
        <a href="Logout.php">Logout</a>

        <form action="UserPage.php?page=1&" method="get">

            <?php pagination();?>

            <div>
                <?php DropDownCategories(); ?>

                <label for="SearchText">Search:</label>
                <input type="search" name="search" id="SearchText">

            </div>

            <input type="submit" name="SubmitText">



        </form>

    </body>

</html>


