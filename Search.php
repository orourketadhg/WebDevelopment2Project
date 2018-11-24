<?php
    session_start();

    // check if session is logged in
    if($_SESSION['LoggedIn']) {


    }
    else {
        header('Location: index.php');

    }
?>