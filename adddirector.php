<html>

    <head>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <title>MovieGrade | Add Director</title>
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
			<a class="active" href="">Add Director</a>
			<a href="addactor.php">Add Actor</a>
      <a href="advancedQueries.php">Advanced Queries</a>
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
				<h3 align="center">Add a Director!</h3>
				<table class="u-full-width">
                    <div align="center">
                        <form align="center" action="adddirector.php" method="POST">
                            Director Name: <input type="text" name="dname" required="required" /> <br/>
                            Director ID: <input type="text" name="director_id" required="required" /> <br/>
                        <input class="button button-1" type="submit" value="Add"/>
                        </form>
                    </div>
				</table>
                <div align="center">
                    <table class="u-full-width">
                        <?php
                        $director_col = "Director ID";
                        $link = mysqli_connect("127.0.0.1", "root", "", "movie_grade");

                         echo "<table class='u-full-width'>";
                         $query = mysqli_query($link, "Select * from director");
                         echo "<tr><td style='font-weight:bold'>" . "Director ID" . "</td><td style='font-weight:bold'>" . "Director Name" . "</td><tr>";
                         while($row = mysqli_fetch_array($query))
                              {
                              echo "<tr><td>" . $row['director_id'] . "</td><td> " . $row['dname'] . "</td></tr>";
                              }
                         echo "</table>";
                         mysqli_close($link);
                        ?>
                    </table>
                </div>
			</div>
		</div>
	</body>

		<div class="footer">
			<h3 align="center">Footer</h3>
			<h6 align="center">Copyright 2018 - Chase Marsh</h6>
		</div>

</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$link = mysqli_connect("127.0.0.1", "root", "", "movie_grade");

	$director_id = mysqli_real_escape_string($link, $_POST['director_id']);
    $dname = mysqli_real_escape_string($link, $_POST['dname']);

	$bool = true;

	mysqli_select_db($link, "movie_grade") or die("Cannot connect to database");

	$query = mysqli_query($link, "Select * from director");

	while($row = mysqli_fetch_array($query)) {
		$table_director = $row['director_id'];

		if($director_id == $table_director) { //checks if the username is already found in the table
			$bool = false;
			Print '<script>alert("Director ID already in system!");</script>';
			Print '<script>window.location.assign("adddirector.php");</script>';
		}
	}

	if($bool) { //if it wasn't taken, go ahead and do the insert of all the data.
		mysqli_query($link, "INSERT INTO director (director_id, dname) VALUES ('$director_id', '$dname')");
		Print '<script>window.location.assign("adddirector.php");</script>';
	}
    echo "Director name entered: ". $dname . "<br/>";
    echo "Director ID entered: ". $director_id . "<br/>";
}
?>
