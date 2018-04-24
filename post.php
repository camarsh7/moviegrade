<html>

    <head>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <title>My first PHP Website</title>
    </head>
	
	<?php
	session_start(); //starts the session
	if($_SESSION['user']){ // checks if the user is logged in  
	}
	else{
      header("location: index.php"); // redirects if user is not logged in
	}
	$user = $_SESSION['user']; //assigns user value
	$postId = $_GET['id'];

	$link = mysqli_connect("127.0.0.1", "root", "", "first_db");
	mysqli_select_db($link, "first_db") or die("Cannot connect to database");

	?>
   
    <body>
	<h1 align="center">Viewing Post</h1>
	<div class="topnav">
		<a href="./home.php">Home</a>
		<div class="dropdown">
			<div class="dropbtn"><?php Print "$user" ?></div>
			<div class="dropdown-content">
				<a href="">My account</a>
				<a href="logout.php">Logout</a>
			</div>
		</div>			
	</div>

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
		<div class="row">
			<div class="six-columns">
				<h3 align="center">Post <?php echo $postId; ?></h3>
				
				<hr>
			</div>
		</div>
	
	
		
		<div class="blogpost">
			<div class="blogpost-content">
				<?php 
				$query = mysqli_query($link, "SELECT * FROM list WHERE id = '$postId'");
		
				while($row = mysqli_fetch_array($query)) {		
						Print '<h1>' . $row['details'] . '</h1>';
						Print '<div class="date"><p>' . $row['date_posted'] . " - ". $row['time_posted'] . '</p></div>';
						Print '<div class="edited"><p>Last Edited: ' . $row['date_edited']. " - ". $row['time_edited'] . '</p></div>';
						Print '<div class="postbuttons"><a class="button button-1" href="edit.php?id='. $row['id'] .'">edit</a>';
						Print '<a class="button button-1" href="#" onclick="myFunction('.$row['id'].')">delete</a></div>';						
				}
				?>
			</div>
		</div>
	
	
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
	<div class="u-full-width">
		<div class="footer">
		<h2 align="center">Footer</h2>
		<h6 align="center">Copyright 2018 - Chase Marsh</h3>
		</div>
	</div>
</html>