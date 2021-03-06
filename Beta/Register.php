<?php include 'phpFunctions/Registration.php' ?>

<?php
    /*
		Test Case 1: No inputs in fields
		Test Case 2: Username Already exists
		Test Case 3: Passwords do not match
		Test Case 4: Passwords length != 6
		Test Case 5: Telephone number length != 10
		Test Case 6: Telephone number not a number
		Test Case 7: mobile number not a number
		Test Case 8: mobile number length != 7
		Test Case 9: all conditions met - Registration success

	*/
?>

<html lang="en">
    <head>
        <title>Registration</title>
        <link rel="stylesheet" type="text/css" href="Assets/CSS/Style.css">
    </head>

    <body>
        <header>
            Library prototype
        </header>


        <form id="RegisterForm" method="post">

            <div id="RegistrationInputFields">

                <?php
                    // create connection to database
                    $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB') or die(mysqli_error($db));

                        // default values
                        $username = null;
                        $password1 = null;
                        $password2 = null;
                        $firstname = null;
                        $surname = null;
                        $address1 = null;
                        $address2 = null;
                        $city = null;
                        $mobile = null;
                        $telephone = null;

                     // if form submitted
                    if ($_POST) {
                        // real escape string check
                        $username = mysqli_real_escape_string($db, $_POST['user']);
                        $password1 = mysqli_real_escape_string($db, $_POST['password1']);
                        $password2 = mysqli_real_escape_string($db, $_POST['password2']);
                        $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
                        $surname = mysqli_real_escape_string($db, $_POST['surname']);
                        $address1 = mysqli_real_escape_string($db, $_POST['address1']);
                        $address2 = mysqli_real_escape_string($db, $_POST['address2']);
                        $city = mysqli_real_escape_string($db, $_POST['city']);
                        $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
                        $telephone = mysqli_real_escape_string($db, $_POST['telephone']);
                    }

                    // close connection to database
                    mysqli_close($db);

                    DataTest($username, $password1, $password2, $firstname, $surname, $address1, $address2, $city, $telephone, $mobile);

                ?>

                <label for="user">Username:</label>
                <input type="text" name="user" id="user" >

                <br>

                <label for="Password1">Password:</label>
                <input type="text" name="password1" id="Password1">

                <br>

                <label for="Password2">confirm password:</label>
                <input type="text" name="password2" id="Password2">

                <br>

                <label for="Firstname">Firstname:</label>
                <input type="text" name="firstname" id="Firstname">

                <br>

                <label for="Surname">Surname:</label>
                <input type="text" name="surname" id="Surname">

                <br>

                <label for="Address1">Address1:</label>
                <input type="text" name="address1" id="Address1">

                <br>

                <label for="Address2">Address2:</label>
                <input type="text" name="address2" id="Address2">

                <br>

                <label for="City">City:</label>
                <input type="text" name="city" id="City">

                <br>

                <label for="Telephone"> Telephone Number:</label>
                <input type="text" name="telephone" id="Telephone">

                <br>

                <label for="Mobile">Mobile Number:
                <input type="text" name="mobile" id="Mobile">

                    <br>

            </div>

            <input id="button" type="submit" value="Register">

            <a id="link" href="index.php">Cancel</a>

        </form>

        <footer>
            Created By Tadhg O'Rourke - C17403574 - Web Development 2 Project
        </footer>

    </body>

</html>
