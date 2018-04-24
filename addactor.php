<html>

    <head>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <title>MovieGrade | Add Actor</title>
    </head>
	
   <?php
	   session_start(); //starts the session
	   if($_SESSION['user']){ // checks if the user is logged in  
	   }
	   else{
		  header("location: index.php"); // redirects if user is not logged in
	   }
	   $user = $_SESSION['user']; //assigns user value
   ?>
   
    <body>
		<div class="homeTitle">
			<h1 align="center">MovieGrade</h1>
		</div>
		<div class="topnav">
			<a href="home.php">Home</a>
			<a href="addreview.php">Add Review</a>
			<a href="addmovie.php">Add Movie</a>
			<a href="adddirector.php">Add Director</a>
			<a class="active" href="">Add Actor</a>
			<div class="dropdown">
				<div class="dropbtn"><?php Print "$user" ?></div>
				<div class="dropdown-content">
					<a href="">My account</a>
					<a href="logout.php">Logout</a>
				</div>
			</div>			
		</div>
			

		<div class="u-full-width-dark">
			<div class="container">
				<h3 align="center">Add an Actor!</h3>
				<table class="u-full-width">		
				
					
				</table>
			</div>
		</div>	
	</body>
	
		<div class="footer">
			<h3 align="center">Footer</h3>
			<h6 align="center">Copyright 2018 - Chase Marsh</h6>
		</div>
	
</html>