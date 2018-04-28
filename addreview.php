<html>

    <head>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <title>MovieGrade | New Review</title>
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
			<a class="active" href="">Add Review</a>
			<a href="addmovie.php">Add Movie</a>
			<a href="adddirector.php">Add Director</a>
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
				<h3 align="center">Add a Review!</h3>
				<div class="row" align="center">	
				<form action="addreview.php" method="POST">
                   <label> Review ID</label>
                   <input type="text" name="review_id" required="required" /> <br/>
                   <label>Movie Title</label>
                   <input type="text" name="title" required="required" /> <br/>
                   <label>Rating</label>
                   <input type="text" name="rating" required="required" /> <br/>
                   <label>Comments</label>
                   <input type="text" name="comments" required="required" /> <br/>
                   <input class="button button-1" type="submit" value="Post Review"/>
                </form>
					
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
	
    $review_id = mysqli_real_escape_string($link, $_POST['review_id']);
	$title = mysqli_real_escape_string($link, $_POST['title']);
    $mov_id = mysqli_query($link, "Select movie_id FROM movie WHERE title = '$title'")->fetch_object()->movie_id;
    $rating = mysqli_real_escape_string($link, $_POST['rating']);
	$comments = mysqli_real_escape_string($link, $_POST['comments']);
	$bool = true;
	
	mysqli_select_db($link, "movie_grade") or die("Cannot connect to database");
	
	$query = mysqli_query($link, "Select * from review");
	
	while($row = mysqli_fetch_array($query)) {
		$table_user = $row['user_id'];
        $table_mov_id = $row['movie_id'];
        $table_rev_id = $row['review_id'];
		
		if($user == $table_user && $table_mov_id == $mov_id) { //checks if the username is already found in the table
			$bool = false;
			Print '<script>alert("Review already made by this user for this movie!");</script>';
			Print '<script>window.location.assign("addreview.php");</script>';
		} else if ($review_id == $table_rev_id) {
            $bool = false;
            Print '<script>alert("Review ID not unique!");</script>';
			Print '<script>window.location.assign("addreview.php");</script>';
        }
	}
	
	if($bool) { //if it wasn't taken, go ahead and do the insert of all the data.
		mysqli_query($link, "INSERT INTO review (review_id, user_id, movie_id, review_rating, review_text) VALUES ('$review_id', '$user', '$mov_id', '$rating', '$comments')");
		Print '<script>alert("Successfully Added!");</script>';
		Print '<script>window.location.assign("addreview.php");</script>';
        $rev_id++;
	}
}
?>
