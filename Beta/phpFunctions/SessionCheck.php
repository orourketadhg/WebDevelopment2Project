<?php

    // function to check if user in session
    function SessionCheck() {
        // start session
        session_start();

        // if session is logged in
        if($_SESSION['LoggedIn'] == true) {


        }
        // else session is not logged in
        else {
            header('Location: index.php');

        }

    }