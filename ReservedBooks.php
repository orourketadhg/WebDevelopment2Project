<?php

    // Todo : Add Display Reserved Books functionality - only 5 books per page
    // Todo : Add un-reserve book functionality

    //start session
    session_start();

    // check if session is logged in
    if($_SESSION['LoggedIn']) {

        //open database connection
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        //get sessions username
        $user = $_SESSION['username'];

        // SQL required for Reserved Books page
        $userReservedSQl = "SELECT ISBN, BookTitle, Author, Year, CategoryID FROM Book JOIN Reserved ON (ISBN) WHERE Username = '$user';";
        $userDeleteReservedSQL = "DELETE * FROM Reserved WHERE Usernamme = '$user' and ISBN = '$ISBN';";

        // close database connection
        mysqli_close($db);

        //logout button is clicked go to confirmation page.
        if(isset($_POST['Logout'])){
            $result = $_POST['Logout'];
            header ('Location: Logout.php');

        }
        else {
            $result = null;

        }

    }
    else {
        header('Location: index.php');

    }

?>

<html>
    <form method="post">
        <input type="submit" value="Logout" name="Logout">
    </form>
</html>

