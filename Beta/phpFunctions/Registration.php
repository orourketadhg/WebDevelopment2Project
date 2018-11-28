<?php

    // Function to check if all input fields are filled
    function FeildsFilled(){

        // if all inputs are filled
        if (!empty($_POST['user']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['firstname']) && !empty($_POST['surname']) && !empty($_POST['address1']) && !empty($_POST['address2']) && !empty($_POST['city']) && !empty($_POST['mobile']) && !empty($_POST['telephone'])) {
            return "Filled";

        }
        // else not all inputs are filled
        else {
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

        }
        // else number is not numeric
        else {
            return "Error Code 4 : Phone Number Must Be Numeric";

        }

    }
