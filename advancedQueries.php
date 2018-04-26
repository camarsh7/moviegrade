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
      $("#initType").change(function() {
        $("#interType").load("textData/" + $(this).val() + ".html");
        $("#retrieve").load("textData/" + $("#initType").val() + "_" + $("#interType").val() + ".html");
      });
      $("#interType").change(function() {
        $("#retrieve").load("textData/" + $("#initType").val() + "_" + $("#interType").val() + ".html");
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
                Type: <select id = "initType" name = "Data Type">               <!--selects the first table for query-->
                  <option value = "default">No Selection</option>
                  <option name = "actor" value = "actor">Actor</option>
                  <option name = "director" value = "director">Director</option>
                  <option name = "movie" value = "movie">Movie</option>
                  <option name = "review" value = "review">Review</option>
                  <option name = "user" value = "user">User</option>
                  <option name = "genre" value = "genre">Genre</option>
                </select>
                ID: <input type="text" name="init_id" required="required" /> <br/>
              </div>
              <div align = "center">
                Interacting Type: <select id = "interType" name = "interType">   <!--selects the second table for query-->
                  <option value = "default">Select a data type</option>
                </select>
                ID: <input type="text" name="inter_id" required="required" /> <br/>
              </div>
              <div align = "center">
                Data: <select id = "retrieve" name = "Data to Retrieve">        <!--selects the data retrievable-->
                  <option value = "default">Select data to retrieve</option>
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

  $init_type = mysqli_real_escape_string($link, $_POST['initType']);
  $init_id = mysqli_real_escape_string($link, $_POST['init_id']);
  $inter_type = mysqli_real_escape_string($link, $_POST['interType']);
  $inter_id = mysqli_real_escape_string($link, $_POST['inter_id']);
  $retrieve = mysqli_real_escape_string($link, $_POST['retrieve']);

	mysqli_select_db($link, "movie_grade") or die("Cannot connect to database");

	$query = mysqli_query($link, $retrieve);                                                   //i think this should work...?

  $i = 0;
	while($row = mysqli_fetch_array($query)) {
		$table_results[i] = $row;
    $i = $i+1;                                                                 //again, i think....???????????
	}

//count the number of rows
  $i = count($table_results);
  if(i > 0){
    $j = count($table_results[0]);
  }else{
    $j = 0;
  }
  }
?>
