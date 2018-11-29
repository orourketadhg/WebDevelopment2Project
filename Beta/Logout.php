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
    <form method="post">
        <input type="submit" value="Continue" name="destroySession">

        <!--User cancels logout - Test Case 2 -->
        <a href="UserPage.php?page=0&maxPage=0&search=all">Cancel</a>

    </form>

</html>
