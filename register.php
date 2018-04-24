<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
		<title>Register</title>
    </head>
    <body>
		<div class="login-bg">
        <h2 align="center">Registration Page</h2>
		<div class="container">
		<div class ="login-box" align="center">
        <a href="index.php">Click here to go back</a><br/><br/>
        <form action="register.php" method="POST">
           Username: <input type="text" name="username" required="required" /> <br/>
           Password: <input type="password" name="password" required="required" /> <br/>
		   First Name: <input type="text" name="firstname" required="required" /> <br/>
		   Last Name: <input type="text" name="lastname" required="required" /> <br/>
           <input class="button button-1" type="submit" value="Register"/>
        </form>
		</div>
		</div>
		</div>
    </body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") { //notice how my form above has method="POST", well yeah this happens if you do that.
	$link = mysqli_connect("127.0.0.1", "root", "", "movie_grade");
	
	$username = mysqli_real_escape_string($link, $_POST['username']); //this is how you grab a variable from form data.
	$password = mysqli_real_escape_string($link, $_POST['password']);
	$firstname = mysqli_real_escape_string($link, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($link, $_POST['lastname']);
	
	$bool = true;
	
	mysqli_select_db($link, "movie_grade") or die("Cannot connect to database");//Connect to db
	
	$query = mysqli_query($link, "Select * from users"); //query users table
	
	while($row = mysqli_fetch_array($query)) {
		$table_users = $row['username'];
		
		if($username == $table_users) { //checks if the username is already found in the table
			$bool = false;
			Print '<script>alert("Username has been taken!");</script>';
			Print '<script>window.location.assign("register.php");</script>';
		}
	}
	
	if($bool) { //if it wasn't taken, go ahead and do the insert of all the data.
		mysqli_query($link, "INSERT INTO users (user_id,password, fname, lname) VALUES ('$username', '$password', '$firstname', '$lastname')");
		Print '<script>alert("Successfully Registered!");</script>';
		Print '<script>window.location.assign("index.php");</script>';
	}
	
	echo "Username entered: ". $username . "<br/>";
	echo "Password entered: ". $password;
}
?>