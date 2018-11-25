<?php

    // Todo : Add Display Reserved Books functionality - only 5 books per page
    // Todo : Add un-reserve book functionality

    //start session
    session_start();

    function UnreserveBook($db, $user, $ISBN) {

        $date = date("d-M-Y");

        $ReserveBookSQl1 = "UPDATE Book SET Reserved = N WHERE ISBN = '$ISBN';";
        $ReserveBookSQl2 = "DELETE * FROM Reserved WHERE Username = '$user' AND ISBN = '$ISBN';";

        $SQL3Result = mysqli_query($db, $ReserveBookSQl1);
        $SQL4Result = mysqli_query($db, $ReserveBookSQl2);

        if(!$SQL4Result) {
            echo "Database Failure: Error Code 2";

        }
        else if (!$SQL4Result) {
            echo "Database Failure: Error Code 3";

        }

    }

    // check if session is logged in
    if($_SESSION['LoggedIn']) {

        //open database connection
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        //get sessions username
        $user = $_SESSION['username'];

        // SQL required for Reserved Books page
        $userReservedSQl = "SELECT ISBN, BookTitle, Author, Year, CategoryID FROM Book JOIN Reserved ON (ISBN) WHERE Username = '$user';";

        $SQLResult = mysqli_query($db, $userReservedSQl);

        if (!$SQLResult) {
            echo "Database Failure: Error Code 1";

        }


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

