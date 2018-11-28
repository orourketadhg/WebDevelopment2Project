<?php
        // start session
        session_start();

        // if session is logged in
        if($_SESSION['LoggedIn'] == true) {


        }
        // else session is not logged in
        else {
            header('Location: index.php');

        }
 ?>

<html lang="en">
    <head>
        <title>Userpage</title>
    </head>

    <body>
        <a href="UserReservedBooks.php">My Reserved Books</a>
        <a href="Logout.php">Logout</a>

    </body>

</html>
