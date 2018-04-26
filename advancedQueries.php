<html>

    <head>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <title>MovieGrade | Advanced Queries</title>
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

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
    $(function() {
      $("#dataType").change(function() {
        $("#interaction").load("textData/" + $(this).val() + ".html");
      });
      $("#interaction").change(function() {
        $("#retrieve").load("textData/" + $("#dataType").val() + "_" + $("#interaction").val() + ".html");
      });
    });
    </script>

    <body>
		<div class="homeTitle">
			<h1 align="center">MovieGrade</h1>
		</div>
		<div class="topnav">
			<a href="home.php">Home</a>
			<a href="addreview.php">Add Review</a>
			<a href="addmovie.php">Add Movie</a>
			<a href="adddirector.php">Add Director</a>
			<a href="addactor.php">Add Actor</a>
      <a class="active" href="">Advanced Queries</a>
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
				<h3 align="center">Find Information!</h3>
				<table class="u-full-width">
          <div align = "center">
            <form align = "center" action="advancedQueries.php" method="POST">
              <div align = "center">
                Type: <select id = "dataType" name = "Data Type">               <!--selects the first table for query-->
                  <option value = "default">No Selection</option>
                  <option value = "actor">Actor</option>
                  <option value = "director">Director</option>
                  <option value = "movie">Movie</option>
                  <option value = "review">Review</option>
                  <option value = "user">User</option>
                  <option value = "genre">Genre</option>
                </select>
                ID: <input type="text" name="_id" required="required" /> <br/>
              </div>
              <div align = "center">
                Interaction: <select id = "interaction" name = "Interaction">   <!--selects the second table for query-->
                  <option value = "default">Select a data type</option>
                </select>
                ID: <input type="text" name="_id" required="required" /> <br/>
              </div>
              <div align = "center">
                Data: <select id = "retrieve" name = "Data to Retrieve">        <!--selects the data retrievable-->
                  <option value = "default">Select an interaction</option>
                <input class="button button-1" type="submit" value="Run Query"/>
              </div>
            </form>
          </div>
  			</table>
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
		Print '<script>alert("Successfully Added!");</script>';
		Print '<script>window.location.assign("adddirector.php");</script>';
	}
    echo "Director name entered: ". $dname . "<br/>";
    echo "Director ID entered: ". $director_id . "<br/>";
}
?>
