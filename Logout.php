<?php
    session_start();
    if (isset($_POST['destroySession'])) {
        $temp = $_POST['destroySession'];
        session_destroy();
        header('Location: index.php');

    }
    else {
        $temp = null;


    }



?>

<html>
    <form method="post">
        <input type="submit" value="Continue" name="destroySession">
        <a href="UserPage.php">Cancel</a>
    </form>

</html>
