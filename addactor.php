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
			<h1 align="center">Movie Grade</h1>
		</div>
		<div class="topnav">
			<a href="home.php">Home</a>
			<a href="addreview.php">Add Review</a>
			<a href="addmovie.php">Add Movie</a>
			<a href="adddirector.php">Add Director</a>
      <a href="advancedQueries.php">Advanced Queries</a>
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
                <form action="addactor.php" method="POST">
                    Actor full name: <input type="text" name="name" required="required" style="display: inline" /><!--Form with button next to it-->
                    <input class="button button-1" type="submit" value="Add Actor"> <!-- Button used to add an actor from a form (1 text field)-->
                </form>
				
                <div align="center">
                    <table class="u-full-width">		

                    <?php
                        //Connecting to db and loading actors to a table
                        $actor_col = "Actor ID";
                        $link = mysqli_connect("127.0.0.1", "root", "", "movie_grade");

                        echo "<table class='u-full-width'>";

                        $query = mysqli_query($link, "Select * from actor");

                        echo "<tr>
                                <td style='font-weight:bold'>" . "Actor ID" . "</td>
                                <td style='font-weight:bold'>" . "Actor Name" . "</td>
                              <tr>";

                        while ($row = mysqli_fetch_array($query)) {
                            echo "<tr>
                                    <td>" . $row['actor_id'] . "</td>
                                    <td>" . $row['aname'] . "</td>
                                  </tr>";
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
			<!--<h3 align="center">Footer</h3>-->
			<h6 align="center">Copyright 2018 - Chase Marsh</h6>
		</div>
	
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect("127.0.0.1", "root", "", "movie_grade");
        
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $actor_id = rand(1,100);
        
        $bool = true;
        
        mysqli_select_db($link, "movie_grade") or die("Cannot connect to the database");
        
        $query = mysqli_query($link, "Select * from actor");
        
        while($row = mysqli_fetch_array($query)) {
            $get_ids = $row['actor_id'];
            
            while($actor_id == get_ids){
                $actor_id = rand(1,100); //If an id already exists, re-run rng to use a different number as id
            }
            
        }
        
        if($bool) {
            mysqli_query($link, "INSERT INTO actor (actor_id,aname) VALUES ('$actor_id', '$name')");
            //Bottom line used for debugging!
            //Print '<script>alert("Actor added successfully!");</script>';
            Print '<script>window.location.assign("addactor.php");</script>';
        }
    }
?>
