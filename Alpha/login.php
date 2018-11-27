<?php

    /*
        Test Case 1: No inputs in fields
        Test Case 2: Username doesn't Exist
        Test Case 3: Username correct, Password incorrect
        Test Case 4: Username and Password correct - login successful
    */

    function Login()
    {
        //connect to database
        $db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');

        //check if inputs are set -- Test Case 1
        if (!empty($_POST['user']) && !empty($_POST['password'])) {
            //get inputs and check if they are mysql functions
            $user = mysqli_real_escape_string($db, $_POST['user']);
            $pswd = mysqli_real_escape_string($db, $_POST['password']);

            //check if user exists
            $sql_username = "SELECT Username FROM Users WHERE Username = '$user'";
            $userLoginTest = mysqli_query($db, $sql_username);


            $sql_password = "SELECT Username, Password FROM Users WHERE Username = '$user' and Password = '$pswd'";
            $userpasswordTest = mysqli_query($db, $sql_password);

            //Query 1 Failure
            if ($userLoginTest == false) {
                return "DataBase Failure: Error Code 1";
            } //Query 2 Failure
            else if ($userpasswordTest == false) {
                return "DataBase Failure: Error Code 2";
            } else {

                //turn query into array
                $userLogin = mysqli_fetch_row($userLoginTest);
                $userpassword = mysqli_fetch_row($userpasswordTest);

                //testing sql queries output
                //print_r($userLogin);
                //print_r($userpassword);

                //Username doesn't exist -- Test Case 2
                if ($user != $userLogin[0]) {
                    return "Input Failure: Error 1 - Username incorrect";

                } else {
                    //User and Password match -- Test Case 4
                    if ($userpassword[1] == $pswd && $userLogin[0] == $user) {
                        session_start();
                        $_SESSION["LoggedIn"] = True;
                        $_SESSION["Username"] = $user;
                        $_SESSION["Password"] = $pswd;
                        $_SESSION["Previous"] = 0;
                        $_SESSION["Next"] = 5;
                        header('Location: UserPage.php');

                    } else {
                        //Password doesn't match Username -- Test Case 3
                        return "Input Failure: Error 2 - Password incorrect";

                    }

                }

            }

        }

    }

    mysqli_close($db);

