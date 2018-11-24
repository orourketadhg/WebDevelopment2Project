<?php

	/*
		Test Case 1: No inputs in fields 
		Test Case 2: Username Already exists
		Test Case 3: Passwords do not match
		Test Case 4: Passwords length != 6
		Test Case 5: Telephone number length != 10 
		Test Case 6: Telephone number not a number
		Test Case 7: all conditions met - Registration success
	
	*/
	
	//Function to test passwords 
	function PasswordTest($pswd1, $pswd2){
		
		//Passwords don't match -- Test Case 3 
		if(strcmp($pswd1, $pswd2) != 0) {
			echo "Input Failure: Error 2";
			echo "<br>";
			echo "Passwords do not match";
			return 1;
		}
		//Passwords length greater than 6 -- Test Case 4
		else if (strlen($pswd1) != 6) {
			echo "Input Failure: Error 3";
			echo "<br>";
			echo "Password length is incorrect";
			return 1;
			
		}
		else {
			return 0;
			
		}
		
	}
	
	
	//Function to test Telephone number
	function TelephoneTest($phone) {
		
		//Phone number not a number -- Test Case 6
		if(is_numeric($phone) == false) {
			echo "Input Failure: Error 4";
			echo "<br>";
			echo "Telephone Input is not a number";
			return 1;
			
		}
		//Phone Number too long or too short -- Test Case 5
		else if(strlen($phone) != 10){
			echo "Input Failure: Error 5";
			echo "<br>";
			echo "Telephone Input length is incorrect";
			return 1;
			
		}
		else {
			return 0;
			
		}
		
	}
	
	
	//open database connection
	$db = mysqli_connect('localhost:3307', 'root', '', 'LibraryDB');
	
	//Must have inputs -- Test Case 1
	if(!empty($_POST['user']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['firstname'])&& !empty($_POST['surname'])&& !empty($_POST['address1'])&& !empty($_POST['address2']) && !empty($_POST['city'])&& !empty($_POST['phone'])){
		
		//check if input a sql query command and assign to variable
		$user = mysqli_real_escape_string($db, $_POST['user']);
		$pswd1 = mysqli_real_escape_string($db, $_POST['password1']);
		$pswd2 = mysqli_real_escape_string($db, $_POST['password2']);
		$fn = mysqli_real_escape_string($db, $_POST['firstname']);
		$sn = mysqli_real_escape_string($db, $_POST['surname']);
		$add1 = mysqli_real_escape_string($db, $_POST['address1']);
		$add2 = mysqli_real_escape_string($db, $_POST['address2']);
		$city = mysqli_real_escape_string($db, $_POST['city']);
		$phone = mysqli_real_escape_string($db, $_POST['phone']);
		
		//SQL Username Query
		$sql_username = "SELECT Username FROM Users WHERE Username = '$user'";
		$userLoginTest = mysqli_query($db, $sql_username);
		
		//Query 1 Failure
		if($userLoginTest == false){
			echo "DataBase Failure: Error Code 1";
			
		}
		else {
			
			$userLogin = mysqli_fetch_row($userLoginTest);
			
			//Username already exists -- Test Case 2
			if ($user != $userLogin[0]) {
			
				//Test Case 3 and 4
				if(PasswordTest($pswd1, $pswd2) == 0){
					
					//Test Case 5 and 6
					if(TelephoneTest($phone) == 0){
						
						//SQL INSERT Query
						$RegistrationSQL = "INSERT INTO `users`(`Username`, `Password`, `Firstname`, `Surname`, `AddressLine_1`, `AddressLine_2`, `City`, `Telephone`) VALUES ('$user', '$pswd1', '$fn', '$sn', '$add1', '$add2', '$city', '$phone')";
			
						$Registration = mysqli_query($db, $RegistrationSQL);
						if($Registration == false){
							echo "DataBase Failure: Error Code 2";
							echo "<br>";
							echo "Registration Failure";
				
						}
						else{
							echo "Registration Complete";
							header('Location: index.php');
						}
			
					}
				
				}
			
			}
			else {
				echo "Input Failure: Error 6";
				echo "<br>";
				echo "Username already in use";
				
			}
			
		}
		
	}
	
	$sql_username = "SELECT Username FROM Users";
	$userLoginTest = mysqli_query($db, $sql_username);
	$userLogin = mysqli_fetch_row($userLoginTest);
	echo "<br>";
	print_r($userLogin);
	
	
	//Close DataBase Connection
	mysqli_close($db);

?>




<pre>
<form method="post">
	Username: 
	<input type="text" name="user">
	
	password: 
	<input type="text" name="password1">
	
	confirm password:
	<input type="text" name="password2">
	
	Firtname:
	<input type="text" name="firstname">
	
	Surname:
	<input type="text" name="surname">
	
	Address1:
	<input type="text" name="address1">
	
	Address2:
	<input type="text" name="address2">
	
	City:
	<input type="text" name="city">
	
	Phone Number:
	<input type="text" name="phone">
	
	<input type="submit" value="Register">
	
	<a href="index.php">Cancel</a>

</form>