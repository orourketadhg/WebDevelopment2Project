<?php
    // ToDo : Add search by text box
    // ToDo : Add search by category
    // ToDo : Add display table
    // ToDo : Add only 5 books per table
    // ToDo : Add functionality for next and previous 5 books in table
    // ToDo : Add ability to reserve book

    include 'phpFunctions/SessionCheck.php';
 ?>

<html lang="en">
    <?php SessionCheck();?>
    <head>
        <title>Userpage</title>
    </head>

    <body>
        <a href="UserReservedBooks.php">My Reserved Books</a>
        <a href="Logout.php">Logout</a>

    </body>

</html>
