<?php
    include 'phpFunctions/SessionCheck.php';
    include 'phpFunctions/UserReserve.php';

    SessionCheck();
?>

<html lang="en">
    <head>
        <title>Reserved Books</title>
    </head>

    <body>

    <a href="UserPage.php?page=1&search=all&SearchCategory=&Reserve=">Home</a>
    <a href="Logout.php">Logout</a>

    <?php UserReservedPage(); ?>

    </body>

</html>
