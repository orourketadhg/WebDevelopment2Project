<?php
    //Todo : add search functionality
    //Todo : Only display 5 books per page of searched books

    //start session
    session_start();

    // check if session is logged in
    if($_SESSION['LoggedIn']) {

        // open database connection
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        // close database connection
        mysqli_close($db);


    }
    else {
        header('Location: index.php');

    }
?>