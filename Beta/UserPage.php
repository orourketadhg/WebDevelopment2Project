<?php
    // ToDo : Mass Comment
    // ToDo : CSS
    // ToDo : Write Test Cases
    // ToDo : Clean up of redundant code

    include 'phpFunctions/Pagination.php';
    include 'phpFunctions/SessionCheck.php';

    SessionCheck();
 ?>

<html lang="en">

    <head>
        <title>Userpage</title>
        <link rel="stylesheet" type="text/css" href="Assets/CSS/Style.css">
    </head>

    <body>

        <header>
            Library prototype
        </header>

        <div id="userDiv">

            <form action="UserPage.php?page=1&" method="get" id="UserForm">

                <nav>
                    <a id="link" href="UserPage.php?page=1&search=all&SearchCategory=&Reserve=">Home</a> |
                    <a id="link" href="UserReservedBooks.php?page=1&Unreserve=">My Reserved Books</a> |
                    <a id="link" href="Logout.php">Logout</a>
                </nav>


                <div id="searching">
                    <?php DropDownCategories(); ?>

                    <label for="SearchText">Search:</label>
                    <input type="search" name="search" id="SearchText">

                    <input id="button" type="submit" name="SubmitText">

                </div>

                <?php pagination();?>

            </form>

        </div>

        <footer>
            Created By Tadhg O'Rourke - C17403574 - Web Development 2 Project
        </footer>

    </body>

</html>


