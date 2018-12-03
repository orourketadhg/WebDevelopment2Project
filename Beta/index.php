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
        <link rel="stylesheet" type="text/css" href="Assets/CSS/Style.css">

    </head>

    <body>

        <header id="header">
            <p>Library prototype</p>
        </header>

        <form method="post" id="LoginForm">

            <div id="ErrorCodes">
                <?php
                    //Test the inputs
                    $Result = TestInput();

                    // if result is
                    if ($Result == "Logging in") {

                        session_start();
                        $_SESSION["LoggedIn"] = True;
                        $_SESSION['Username'] = $_POST['user'];

                        header('Location: UserPage.php?page=1&search=all&SearchCategory=&Reserve=');

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

            <input type="submit" value="Login" id="button">
            <a id="link" href="Register.php">Register</a>

        </form>

        <footer>
            Created By Tadhg O'Rourke - C17403574 - Web Development 2 Project
        </footer>

    </body>
</html>
