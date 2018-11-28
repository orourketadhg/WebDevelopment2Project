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
    </head>

    <body>
        <form method="post">

            <div id="RegistrationInputFields">

                <?php
                    $Result = FeildsFilled();

                    if ($Result == "Filled") {
                        echo $Result;

                    }
                    else {
                        echo "<p id='Error'>$Result</p>";

                    }

                ?>

                <label for="user">Username:</label>
                <input type="text" name="user" id="user" >


                <label for="Password1">Password:</label>
                <input type="text" name="password1" id="Password1">

                <label for="Password2">confirm password:</label>
                <input type="text" name="password2" id="Password2">

                <label for="Firstname">Firstname:</label>
                <input type="text" name="firstname" id="Firstname">

                <label for="Surname">Surname:</label>
                <input type="text" name="surname" id="Surname">

                <label for="Address1">Address1:</label>
                <input type="text" name="address1" id="Address1">

                <label for="Address2">Address2:</label>
                <input type="text" name="address2" id="Address2">

                <label for="City">City:</label>
                <input type="text" name="city" id="City">

                <label for="Telephone"> Telephone Number:</label>
                <input type="text" name="telephone" id="Telephone">

                <label for="Mobile">Mobile Number:
                <input type="text" name="mobile" id="Mobile">

            </div>

            <input type="submit" value="Register">

            <a href="login.php">Cancel</a>

        </form>

    </body>

</html>
