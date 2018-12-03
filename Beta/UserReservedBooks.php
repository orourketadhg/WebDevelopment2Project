<?php
    include 'phpFunctions/SessionCheck.php';
    include 'phpFunctions/UserReserve.php';

    SessionCheck();
?>

<html lang="en">
    <head>
        <title>Reserved Books</title>
        <link rel="stylesheet" type="text/css" href="Assets/CSS/Style.css">
    </head>

    <body>
        <header>
            Library prototype
        </header>

        <div id="Reserving">

            <nav>
                <a id="link" href="UserPage.php?page=1&search=all&SearchCategory=&Reserve=">Home</a>
                <a id="link" href="Logout.php">Logout</a>
            </nav>

            <?php UserReservedPage(); ?>

        </div>

        <footer>
            Created By Tadhg O'Rourke - C17403574 - Web Development 2 Project
        </footer>

    </body>

</html>
