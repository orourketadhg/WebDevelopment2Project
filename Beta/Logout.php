<?php

    /*
     *  Test Case 1 : User tries to access page out of session
     *  Test Case 2 : User Tries to log out but cancels action
     *  Test Case 3 : User Successfully logs out
     */
    session_start();

    // make sure session is logged in to be able to log out - Test Cae 1
    if($_SESSION['LoggedIn']) {

        // user clicks to confirm logout - Test Case 3
        if (isset($_POST['destroySession'])) {
            $temp = $_POST['destroySession'];
            session_destroy();
            header('Location: index.php');

        }
        else {
            $temp = null;

        }

    }
    else {
        header('Location: index.php');

    }

?>

<html>
    <head>
        <title>Logout</title>
        <link rel="stylesheet" type="text/css" href="Assets/CSS/Style.css">
    </head>

    <body >

        <header>
            Library prototype
        </header>

        <form id="LogoutForm" method="post">

            <h2 id="LogoutTitle"> Logout : </h2>

            <input id="button" type="submit" value="Continue" name="destroySession">

            <!--User cancels logout - Test Case 2 -->
            <a id="link" href="UserPage.php?page=1&search=all&SearchCategory=&Reserve=">Cancel</a>

        </form>

        <footer>
            Created By Tadhg O'Rourke - C17403574 - Web Development 2 Project
        </footer>

    </body>
</html>
