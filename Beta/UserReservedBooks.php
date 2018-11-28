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
        <title>Reserved Books</title>
    </head>

    <body>

    <a href="UserPage.php">Home</a>
    <a href="Logout.php">Logout</a>

    </body>

</html>
