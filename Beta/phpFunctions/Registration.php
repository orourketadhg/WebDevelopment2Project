<?php

    // Function to check if all input fields are filled
    function FieldsFilled(){

        // if all inputs are filled
        if (!empty($_POST['user']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['firstname']) && !empty($_POST['surname']) && !empty($_POST['address1']) && !empty($_POST['address2']) && !empty($_POST['city']) && !empty($_POST['mobile']) && !empty($_POST['telephone'])) {
            return "Filled";

        }
        // else not all inputs are filled
        else if ($_POST){
            return "Error Code 1 : All Fields Must Be Filled";
        }

    }


    // Function to test if passwords match and are 6 characters long
    function PasswordCheck($Password1, $Password2) {

        // if both passwords length are 6 characters long
        if (strlen($_POST['password1']) == 6 && strlen($_POST['password2']) == 6) {

            if ($_POST['password1'] == $_POST['password2']) {
                return "Passwords Match";

            }
            // else passwords don't match
            else {
                return "Error Code 3 : Passwords Don't Match";
            }

        }
        // else password lengths are not equal to 6
        else {
            return "Error Code 2 : Password Length Must Be 6 Characters Long";

        }

    }


    // Function to check that phone numbers are numeric and are the correct length
    function PhoneCheck($number, $length) {

        // if number is numeric
        if (is_numeric($number)) {

            // if number is correct length
            if (strlen($number) == $length) {
                return "Phone Accepted";

            }
            // else number length is incorrect
            else {
                return "Error Code 5 : Phone Number Length is Incorrect";

            }

        }
        // else number is not numeric
        else {
            return "Error Code 4 : Phone Number Must Be Numeric";

        }

    }


    function UserCheck($username) {

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        //SQL Username Query
        $sql_username = "SELECT Username FROM Users WHERE Username = '$username'";
        $usernameExistsQuery = mysqli_query($db, $sql_username);

        // turn SQL query into usable array
        $usernameExists = mysqli_fetch_row($usernameExistsQuery);

        // close connection to database
        mysqli_close($db);

        if ($username != $usernameExists[0]) {
            return "Username Accepted";

        }
        else if ($username == $usernameExists[0]) {
            return "Error Code 6 : Username Taken";

        }
        else {
            return "Error Code 7 : Query Error";

        }


    }


    function CreateUser($username, $password, $firstname, $surname, $address1, $address2, $city, $telephone, $mobile){
        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        // User creation SQL query
        $RegistrationSQL = "INSERT INTO `users`(`Username`, `Password`, `Firstname`, `Surname`, `AddressLine_1`, `AddressLine_2`, `City`, `Telephone`, `Mobile`) VALUES ('$username', '$password', '$firstname', '$surname', '$address1', '$address2', '$city', '$telephone', '$mobile');";
        $Result = mysqli_query($db, $RegistrationSQL);

        // if query failure
        if(!$Result) {
        // close connection to database
            mysqli_close($db);

            return "Error Code 8 : User Creation Error";

        }
        // else query success
        else {
            // close connection to database
            mysqli_close($db);

            return "User Created";

        }


    }


    // function to test all Test Cases
    function DataTest() {

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

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

        // close connection to database
        mysqli_close($db);

        // all fields filled
        $Result = FieldsFilled();

        // if all fields are filled
        if ($Result == "Filled") {
            // testing result
            // echo $Result;

            // username doesn't exist
            $usernameCheck = UserCheck($username);

            // if username doesn't exist
            if ($usernameCheck == "Username Accepted") {
                // testing result
                // echo $usernameCheck;

                // passwords are acceptable
                $passwordCheck = PasswordCheck($password1, $password2);

                // if passwords are acceptable
                if ($passwordCheck == "Passwords Match") {
                    // testing result
                    // echo $passwordCheck;

                    // mobile number is acceptable
                    $mobileCheck = PhoneCheck($mobile, 7);

                    // if mobile number is acceptable
                    if ($mobileCheck == "Phone Accepted") {
                        // testing result
                        // echo $mobileCheck;

                        // telephone number is acceptable
                        $telephoneCheck = PhoneCheck($telephone, 10);

                        // if telephone number is acceptable
                        if ($telephoneCheck == "Phone Accepted") {
                            // testing result
                            // echo $telephoneCheck;

                            // create user
                            $creationCheck = CreateUser($username, $password1, $firstname, $surname, $address1, $address2, $city, $telephone, $mobile);

                            // if user created
                            if ($creationCheck == "User Created") {
                                // testing result
                                echo $creationCheck;

                            }
                            // else user was not created
                            else {
                                echo "<p id='Error'>$creationCheck</p>";

                            }


                        }
                        // else telephone number is not acceptable
                        else {
                            echo "<p id='Error'>$telephoneCheck</p>";

                        }

                    }
                    // else mobile number is not acceptable
                    else {
                        echo "<p id='Error'>$mobileCheck</p>";

                    }

                }
                // else passwords do not match
                else {
                    echo "<p id='Error'>$passwordCheck</p>";

                }

            }
            // else username is taken
            else {
                echo "<p id='Error'>$usernameCheck</p>";

            }

        }
        // else all fields are not full
        else {
            echo "<p id='Error'>$Result</p>";

        }

    }


