<html>

    <head>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <title>MovieGrade | Add Movie</title>
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
			<a class="active" href="">Add Movie</a>
			<a href="adddirector.php">Add Director</a>
			<a href="addactor.php">Add Actor</a>
      <a href="addcasting.php">Casting</a>
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
				<h3 align="center">Add a Movie!</h3>
				<div align="center">
                    <form align="center" action="addmovie.php" method="POST">
                        Movie ID: <input type="text" name="movie_id" required="required" /> <br/>
                        Movie Title: <input type="text" name="title" required="required" /> <br/>
                        Movie Genre ID: <input type="text" name="genre" required="required" /> <br/>
						Movie Director ID: <input type="text" name="director" required="required" /> <br/>
                    <input class="button button-1" type="submit" value="Add"/>
                    </form>
                </div>
                <div align="center">
                    <table class="u-full-width">
                        <?php
                         $link = mysqli_connect("127.0.0.1", "root", "", "movie_grade");

                         echo "<table class='u-full-width'>";
                         $query = mysqli_query($link, "Select * from movie");
                         echo "<tr><td style='font-weight:bold'>" . "Movie ID" . "</td><td style='font-weight:bold'>" . "Title" . "</td><td style='font-weight:bold'>" . "Genre ID" . "</td><td style='font-weight:bold'>" . "Average Rating" . "</td><tr>";
                         while($row = mysqli_fetch_array($query))
                              {
                              $movie_id = $row['movie_id'];
                              $sql = "SELECT avg(review_rating) AS rating FROM review WHERE movie_id = '$movie_id'";

                              if($stmt = mysqli_prepare($link, $sql)){
                                if(mysqli_stmt_execute($stmt)){
                                    $avgcontainer = mysqli_stmt_get_result($stmt);
                                    while($avgrow = mysqli_fetch_array($avgcontainer)){
                                        $rating = $avgrow['rating'];
                                        mysqli_query($link, "Update movie SET 'avg_ranging' = '$rating' where movie_id ='$movie_id'");
                                    }
                                }
                              }
                              $genre_id = $row['genre'];
                              $sql = "SELECT gname FROM genre WHERE genre_id = '$genre_id'";

                              if($stmt = mysqli_prepare($link, $sql)){
                                if(mysqli_stmt_execute($stmt)){
                                    $genrecontainer = mysqli_stmt_get_result($stmt);
                                    while($genrerow = mysqli_fetch_array($genrecontainer)){
                                        $genre = $genrerow['gname'];
                                        echo "<tr><td>" . $row['movie_id'] . "</td><td> " . $row['title'] . "</td><td> " . $genre . "</td><td> " . $row['avg_ranging'] . "</td></tr>";
                                    }
                                }
                              }
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

	$title = mysqli_real_escape_string($link, $_POST['title']);
    $genre = mysqli_real_escape_string($link, $_POST['genre']);
    $movie_id = mysqli_real_escape_string($link, $_POST['movie_id']);
	$director_id = mysqli_real_escape_string($link, $_POST['director']);
    $avg_ranging = 0;

	$bool = true;

	mysqli_select_db($link, "movie_grade") or die("Cannot connect to database");

	$query = mysqli_query($link, "Select * from movie");

	while($row = mysqli_fetch_array($query)) {
		$table_movie = $row['movie_id'];

		if($movie_id == $table_movie) { //checks if the username is already found in the table
			$bool = false;
			Print '<script>alert("Movie ID already in system!");</script>';
			Print '<script>window.location.assign("addmovie.php");</script>';
		}
	}

	if($bool) { //if it wasn't taken, go ahead and do the insert of all the data.
        mysqli_query($link, "INSERT INTO movie (movie_id, title, avg_ranging, genre) VALUES ('$movie_id', '$title', '$avg_ranging', '$genre')");
        mysqli_query($link, "INSERT INTO directs (movie_id, director_id) VALUES ('$movie_id', '$director_id')");
		Print '<script>window.location.assign("addmovie.php");</script>';
	}
}
?>
