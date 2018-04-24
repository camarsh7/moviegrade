<html>

    <head>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <title>MovieGrade | Home</title>
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
		<a class="active" href="">Home</a>
		<a href="addreview.php">Add Review</a>
		<a href="addmovie.php">Add Movie</a>
		<a href="adddirector.php">Add Director</a>
		<a href="addactor.php">Add Actor</a>
		<div class="dropdown">
			<div class="dropbtn"><?php Print "$user" ?></div>
			<div class="dropdown-content">
				<a href="">My account</a>
				<a href="logout.php">Logout</a>
			</div>
		</div>			
	</div>
	
	<!--
		<div class="u-max-full-width">
			<h4 align="center">See a new movie? Review it here!</h4>	
			<div class="container">
				<div class="row">
					<div class="six columns">
						<form action="add.php" method="POST">
								Add more to list: <input type="text" name="details" /> <br/><label class="public[]">
								Public post? <input type="checkbox" name="public[]" value="yes" /> <br/>
							  <input class="button-1" value="Add to list" type="submit">
						</form>
					</div>
					<div class="six columns">		
						<form action="search-form.php" method="POST">
							Looking for something? <input class="button-1" value="Search now" type="submit">
						</form>		
					</div>
				</div>
			</div>
		</div>
	-->
		
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script type="text/javascript">
		$(document).ready(function(){
			$('.search-box input[type="text"]').on("keyup input", function(){
				/* Get input value on change */
				var inputVal = $(this).val();
				var resultDropdown = $(this).siblings(".result");

				if(inputVal.length){
					$.get("backend-search.php", {term: inputVal}).done(function(data){
						// Display the returned data in browser
						resultDropdown.html(data);
					});
				} else{
					resultDropdown.empty();
				}
			});
			
			// Set search input value on click of result item

			$(document).on("click", ".result p", function(){
				$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
				$(this).parent(".result").empty();
			});
		});
	</script>	

	<div class="u-full-width-dark">
	<div class="container">
    <h3 align="center">Movie Grades Below</h3>
	<table class="u-full-width">		
	
			<?php 
			$link = mysqli_connect("127.0.0.1", "root", "", "movie_grade");
			mysqli_select_db($link, "movie_grade") or die("Cannot connect to database");
			$query = mysqli_query($link, "SELECT DISTINCT r.review_id, r.user_id, r.review_rating,
				r.review_text, m.title FROM review r, movie m WHERE r.movie_id = m.movie_id");
			
			while($row = mysqli_fetch_array($query)) {
				Print "<div class='review_box'>";
					//Print '<div class="id_label">Review Id: ';
					//Print '<div class="id_label">' . $row['review_id'] . "</div>";
					Print '<div class="user_label">Posted by: ';
					Print $row['user_id'] . "</div>";	
					Print '<div class="title_label">' . $row['title']. "</div>";
					Print '<div class="rating_label">Rating: ';
					Print $row['review_rating']. "</div>";
					Print '<div class="text_label">Comments: ';
					Print $row['review_text']. "</div>";								
				Print "</div>";
			}
		?>
	</table>
	
	<script>
		function myFunction(id) {
			var r = confirm("Are you sure you want to delete this record?");
			
			if(r == true) {
				window.location.assign("delete.php?id=" + id);
			}
		}
	</script>
	</div>
	</div>	
	</body>
	
		<div class="footer">
		<h3 align="center">Footer</h3>
		<h6 align="center">Copyright 2018 - Chase Marsh</h6>
		</div>
	
</html>