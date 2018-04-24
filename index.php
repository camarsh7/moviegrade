<html>
	<head>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <title>MovieGrade</title>
	</head>
	<body>		
	<div class="container">
		
		<h2 align="center">MovieGrade</h2>
		<table class="u-full-width">
	
			<thead>
				<tr>
					<th>Review Id</th>
					<th>Posted By</th>
					<th>Movie Title</th>
					<th>Rating</th>
					<th>Comments</th>
				</tr>
			</thead>
		
		<?php 
			$link = mysqli_connect("127.0.0.1", "root", "", "movie_grade");//links to the database
			mysqli_select_db($link, "movie_grade") or die("Cannot connect to database");//tries to connect
			$query = mysqli_query($link, "SELECT DISTINCT r.review_id, r.user_id, r.review_rating,
				r.review_text, m.title FROM review r, movie m WHERE r.movie_id = m.movie_id");//all queries will be like this
			
			while($row = mysqli_fetch_array($query)) { //this is how you loop through every row from your query
				Print "<tr>";
					Print '<td align="center">'. $row['review_id'] . "</td>"; // $row['attribute_name'] ios the syntax
					Print '<td align="center">'. $row['user_id'] . "</td>"; //when using php variables inbetween strings, use . $var .							
					Print '<td align="center">'. $row['title']. "</td>";  //as you can see i use PHP to print out HTML elements to format data
					Print '<td align="center">'. $row['review_rating']. "</td>";
					Print '<td align="center">'. $row['review_text']. "</td>";
				Print "</tr>";
			}
		?>
		</table>
		<div align="center">
			<a class="button button-1" href="login.php">LOGIN</a>
			<a class="button button-primary" href="register.php">REGISTER</a>
		</div>
	</div>
	</body>
</html>