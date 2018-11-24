<?php
    session_start();

    // make sure session is logged in to be able to log out
    if($_SESSION['LoggedIn']) {
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
        <a href="UserPage.php">Cancel</a>
    </form>

</html>
