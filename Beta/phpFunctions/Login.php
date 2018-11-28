<?php

    // Todo : add session and URL data

    // Function to test if both text fields are filled.
    function TestInput() {

        // create connection to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB') or die(mysqli_error($db));

        // default values
        $user = null;
        $password = null;

        // if both fields have been filled
        if (!empty($_POST['user']) && !empty($_POST['password'])) {
            $user = $_POST['user'];
            $password = $_POST['password'];

            // test username
            $userExists = UsernameTest($db, $user);

            // if username exists
            if ($userExists == "Username Exists"){
                $userPasswordExists = PasswordTest($db, $user, $password);

                // if password matches username
                if ($userPasswordExists == "Accepted") {
                    return "Logging in";

                }
                // else return PasswordTest error message
                else {
                    return $userPasswordExists;
                }

            }
            // else return UsernameTest error message
            else {
                return $userExists;

            }

        }
        else if ($_POST) {
            return "Error Code 1 : Both Fields must be filled in";
        }

        mysqli_close($db);

    }


    // Function to test the If the Username Exists
    function UsernameTest($db, $user) {

        // check if user exists with database query
        $sql_username = "SELECT Username FROM Users WHERE Username = '$user'";
        $userLoginTest = mysqli_query($db, $sql_username);

        // turn SQL query into usable array
        $userLogin = mysqli_fetch_row($userLoginTest);

        // if Username exists
        if($userLoginTest && $user == $userLogin[0]) {
            return "Username Exists";

        }
        // else if query error
        else if ($userLoginTest == null) {
            return "Error Code 2 : Username Query Error";

        }
        // else username doesn't exist
        else {
            return "Error Code 3 : Username Doesn't Exist";
        }

    }


    // Function to test if the Username matches the password
    function PasswordTest($db, $user, $password) {

        // check if username and password exist
        $sql_password = "SELECT Username, UserPassword FROM Users WHERE Username = '$user' AND UserPassword = '$password' ";
        $passwordTest = mysqli_query($db, $sql_password);

        // turn SQL query into usable array
        $userUsernamePassword = mysqli_fetch_row($passwordTest);

        // print $user Username and password
        // print_r($userUsernamePassword);

        // if password matches username
        if ($user == $userUsernamePassword[0] && $password == $userUsernamePassword[1]) {
            return "Accepted";

        }
        // else if query error
        else if($passwordTest == null){
            return "Error Code 4 : Password Query Error";

        }
        // else password doesn't match Username
        else {
            return "Error Code 5 : Password Doesn't Match Username";
        }


    }


