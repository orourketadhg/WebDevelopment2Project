<?php
    /*
     * Test Case 1 : User tries to access page out of session
     * Test Case 2 : Search for author or book title
     * Test Case 3 : Search for books by category via dropdown
     * Test Case 4 : Ability to reserve a book if available
     */

    //Todo : add search functionality
    //Todo : add drop down category ID search

    //start session
    session_start();

    // check if session is logged in
    if($_SESSION['LoggedIn']) {

        // open database connection
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        //getting drop down menu options form database
        $dropdownCategoryList = "SELECT CategoryDesc FROM Category";

        $CategoriesResult = mysqli_query($db, $dropdownCategoryList);

        // generate dropdown
        if ($CategoriesResult) {

            //array creation
            $Categories = Array();

            //turn rows into a 1D array
            While($row = mysqli_fetch_row($CategoriesResult)) {
                $Categories[] = $row[0];
            }

            //test what is in Category list
            //print_r($Categories);

            //create dropdown menu with options
            echo "<select name='dropdown'>";

            echo '<option value="0">-- Chose a Category --</option>';

            //loop through and add categories from list
            for ($i = 0; $i < count($Categories); $i++) {

                echo "<option value='$Categories[$i]'>$Categories[$i]</option>";

            }


            echo "</select>";

        }


        // text box - search
        if (isset($_POST['Search']) && !empty($_POST['SearchText'])){

            $SearchText = mysqli_real_escape_string($db, $_POST['SearchText']);

            $searchSQLText = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryID, Reserved FROM Book WHERE BookTitle = '$SearchText' OR Author = '$SearchText';";

            $Books = mysqli_query($db, $searchSQLText);

            if ($Books) {

                $bookArraySQL = Array();

                // add each row array to a array (2D array)
                while($row = mysqli_fetch_row($Books)) {
                    $bookArraySQL[] = $row;

                }

                echo "<table border=1>";

                // Table Column names
                echo "<tr>";
                echo "<th>ISBN</th>";
                echo "<th>Book Title</th>";
                echo "<th>Author</th>";
                echo "<th>Edition</th>";
                echo "<th>Year</th>";
                echo "<th>Category ID</th>";
                echo "<th>Reserved</th>";
                echo "<th>Reserve</th>";
                echo "</tr>";

                for ($i = 0; $i < count($bookArraySQL); $i++) {

                    echo "<tr>";

                    // loop through each book printing its data
                    for ($j = 0; $j < 8; $j++) {
                        // Create table data and reserve buttons
                        if ($j != 7) {
                            echo "<td>";
                            echo $bookArraySQL[$i][$j];
                            echo "</td>";
                        }
                        // create button to reserve book
                        else if ($bookArraySQL[$i][6] != 'Y') {
                            echo "<td>";
                            echo "<button type='button' name=''>Reserve</button>";
                            echo "</td>";
                        }
                        // if book already reserved
                        else if ($bookArraySQL[$i][6] == 'Y'){
                            echo "<td>";
                            echo "Unable to reserve";
                            echo "</td>";
                        }

                    }

                    echo "</tr>";

                }

                echo "</table>";

            }
            else {
                echo "Database Failure: Error Code 1";
                echo "<br>";
                echo "Query Error";

            }


        }

        // dropdown - search
        else if (isset($_POST['Search']) && isset($_POST['dropdown']) != 0){

            echo $dropdownOption = $_POST['dropdown'];

            //echo $dropdownOption;

            $searchSQLText = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryDesc, Reserved FROM Book JOIN Category WHERE CategoryDesc = '$dropdownOption'";




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
        header('Location: login.php');

    }

?>

<html>
    <form method="post">
        <input type="text" name="SearchText">

        <input type="submit" value="Search" name="Search">

        <input type="submit" value="Logout" name="Logout">
    </form>
</html>
