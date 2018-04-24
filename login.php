<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <title>MovieGrade | Login</title>
	</head>
	<body>
	<div class="login-bg">
	<h1 align="center">MovieGrade</h1>
	<div class="container">
		<div class ="login-box" align="center">
		<h4>Login Here!</h4></br></br>
		<form action="checklogin.php" method="POST">
			Username: <input type="text" name="username" required="required" /> <br/>
			Password: <input type="password" name="password" required="required" /> <br/>
			<a class="button button-1" href="index.php">CANCEL</a>
			<input class="button login-button" type="submit" value="Login"/>
		</form>
		</div>
	</div>
	</div>
	</body>
</html>