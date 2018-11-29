<?php include 'phpFunctions/Login.php' ?>

<?php
    /*
		Test Case 1: No inputs in fields
		Test Case 2: Username doesn't Exist
		Test Case 3: Username correct, Password incorrect
		Test Case 4: Username and Password correct - login successful
	*/
?>

<html lang="en">
    <head>
        <title>Login</title>

    </head>

    <body>

        <form method="post">

            <div id="ErrorCodes">
                <?php
                    //Test the inputs
                    $Result = TestInput();

                    if ($Result == "Logging in") {
                        session_start();
                        $_SESSION["LoggedIn"] = True;
                        $_SESSION['Username'] = $_POST['user'];

                        header('Location: UserPage.php?page=0');
                    }
                    else {
                        echo "<p id='Error'>$Result</p>";
                    }
                ?>
            </div>

            <div id="InputFields">
                <label for="Username">Username:</label>
                <input type="text" name="user" id="Username">

                <br>

                <label for="Password">password:</label>
                <input type="password" name="password" id="Password">

            </div>

            <input type="submit" value="Login">
            <a href="Register.php">Register</a>

        </form>

    </body>
</html>
