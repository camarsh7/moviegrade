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

   <?php
      function buildQuery($initType, $init_id, $interType, $inter_id, $retrieve){

        if(strncmp($initType, $interType, 1) > 0){
          $temp = $interType;
          $interType = $initType;
          $initType = $temp;

          $temp = $inter_id;
          $inter_id = $init_id;
          $init_id = $inter_id;
        }

        $init_prefix = " = \"";
        $init_postfix = "\"";
        $inter_prefix = " = \"";
        $inter_postfix = "\"";

        if(empty($init_id)){
          $init_prefix = " IS ";
          $init_id = "NOT NULL";
          $init_postfix = "";
        }

        if(empty($inter_id)){
          $inter_prefix = " IS ";
          $inter_id = "NOT NULL";
          $inter_postfix = "";
        }

        if(strcmp($initType, "Actor") == 0){
          if(strcmp($interType, "Director") == 0){
            echo "Querying Actor, Director: ";
            if(strcmp($retrieve, "Average Rating of Joint Projects") == 0){
              return "SELECT aname, dname, SUM(avg_ranging)/COUNT(avg_ranging)"
              . " FROM (SELECT Actor.aname, Director.dname, Movie.avg_ranging"
              . " FROM Actor, Director, Movie, Casts, Directs"
              . " WHERE Actor.actor_id" . $init_prefix . $init_id . $init_postfix
              . " AND Actor.actor_id = Casts.actor_id AND"
              . " Casts.movie_id = Movie.movie_id AND"
              . " Movie.movie_id = Directs.movie_id AND"
              . " Directs.director_id = Director.director_id AND"
              . " Director.director_id" . $inter_prefix . $inter_id . $inter_postfix . ") AS t;";
            }else{
              return "SELECT aname, dname, title"
              . " FROM (SELECT Actor.aname, Director.dname, Movie.title"
              . " FROM Actor, Director, Movie, Casts, Directs"
              . " WHERE Actor.actor_id" . $init_prefix . $init_id . $init_postfix
              . " AND Actor.actor_id = Casts.actor_id AND"
              . " Casts.movie_id = Movie.movie_id AND"
              . " Movie.movie_id = Directs.movie_id AND"
              . " Directs.director_id = Director.director_id AND"
              . " Director.director_id" . $inter_prefix . $inter_id . $inter_postfix . ") AS t;";
            }
          }else if (strcmp($interType, "Genre") == 0){
            echo "Querying Actor, Genre: ";
            if(strcmp($retrieve, "Average Actor Rating in Genre") == 0){
              return "SELECT aname, gname, SUM(avg_ranging)/COUNT(avg_ranging)"
              . " FROM (SELECT Actor.aname, Genre.gname, Movie.avg_ranging"
              . " FROM Actor, Genre, Movie, Casts WHERE Actor.actor_id"
              . $init_prefix . $init_id . $init_postfix
              . " AND Actor.actor_id = Casts.actor_id"
              . " AND Casts.movie_id = Movie.movie_id"
              . " AND Movie.genre = Genre.genre_id"
              . " AND Genre.genre_id" . $inter_prefix . $inter_id . $inter_postfix . ") AS t;";
            }else if(strcmp($retrieve, "All Actors in Genre") == 0){
              return "SELECT DISTINCT aname, actor_id, gname"
              . " FROM (SELECT Actor.aname, Actor.actor_id, Genre.gname"
              . " FROM Actor, Movie, Casts, Genre WHERE"
              . " Actor.actor_id" . $init_prefix . $init_id . $init_postfix . " AND"
              . " Actor.actor_id = Casts.actor_id AND"
              . " Casts.movie_id = Movie.movie_id AND"
              . " Movie.genre = Genre.genre_id AND"
              . " Genre.genre_id" . $inter_prefix . $inter_id . $inter_postfix . ") AS t;";
            }else if(strcmp($retrieve, "All Genres for an Actor") == 0){
              return "";
            }
          }else if (strcmp($interType, "movie") == 0){
            echo "actor, movie";
          }else if (strcmp($interType, "review") == 0){
            echo "actor, review";
          }else if (strcmp($interType, "user") == 0){
            echo "actor, user";
          }
        }else if (strcmp($initType, "director") == 0){
          if (strcmp($interType, "genre") == 0){
            echo "director, genre";
          }else if (strcmp($interType, "movie") == 0){
            echo "director, movie";
          }else if (strcmp($interType, "review") == 0){
            echo "director, review";
          }else if (strcmp($interType, "user") == 0){
            echo "director, user";
          }
        }else if (strcmp($initType, "genre") == 0){
          if (strcmp($interType, "movie") == 0){
            echo "genre, movie";
          }else if (strcmp($interType, "review") == 0){
            echo "genre, review";
          }else if (strcmp($interType, "user") == 0){
            echo "genre, user";
          }
        }else if (strcmp($initType, "movie") == 0){
          if (strcmp($interType, "review") == 0){
          echo "actor, review";
          } else if (strcmp($interType, "user") == 0){
            echo "movie, user";
          }
        }else if (strcmp($initType, "review") == 0){
          if (strcmp($interType, "user") == 0){
          echo "review, user";
          }
        }
      }
    ?>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
    $(function() {
      $("#initType").change(function() {
        $("#retrieve").load("textData/" + $("#initType").val() + $("#interType").val() + ".html");
      });
      $("#interType").change(function() {
        $("#retrieve").load("textData/" + $("#initType").val() + $("#interType").val() + ".html");
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
                Type: <select id = "initType" name = "initType">               <!--selects the first table for query-->
                  <option value = "default">No Selection</option>
                  <option name = "actor" value = "Actor">Actor</option>
                  <option name = "director" value = "Director">Director</option>
                  <option name = "movie" value = "Movie">Movie</option>
                  <option name = "review" value = "Review">Review</option>
                  <option name = "user" value = "User">User</option>
                  <option name = "genre" value = "Genre">Genre</option>
                </select>
                ID: <input type="text" name="init_id"/> <br/>
              </div>
              <div align = "center">
                Interacting Type: <select id = "interType" name = "interType">   <!--selects the second table for query-->
                  <option value = "default">No Selection</option>
                  <option name = "actor" value = "Actor">Actor</option>
                  <option name = "director" value = "Director">Director</option>
                  <option name = "movie" value = "Movie">Movie</option>
                  <option name = "review" value = "Review">Review</option>
                  <option name = "user" value = "User">User</option>
                  <option name = "genre" value = "Genre">Genre</option>
                </select>
                ID: <input type="text" name="inter_id"/> <br/>
              </div>
              <div align = "center">
                Data: <select id = "retrieve" name = "retrieve">        <!--selects the data retrievable-->
                  <option value = "default">Select data to retrieve</option>
                  <option name = "hide" value = "hide">Hide All</option>
                  <option name = "hide1" value = "hide1">Hide Top</option>
                  <option name = "hide2" value = "hide2">Hide Bottom</option>
                  <option name = "show" value = "show">Show All</option>
                </select>
                <input class="button button-1" type="submit" value="Run Query"/>
              </div>
            </form>

            <div align = "center">
              <?php
              if($_SERVER["REQUEST_METHOD"] == "POST") {
                $link = mysqli_connect("127.0.0.1", "root", "", "movie_grade");


                $init_type = mysqli_real_escape_string($link, $_POST['initType']);
                $init_id = mysqli_real_escape_string($link, $_POST['init_id']);
                $inter_type = mysqli_real_escape_string($link, $_POST['interType']);
                $inter_id = mysqli_real_escape_string($link, $_POST['inter_id']);
                $retrieve = mysqli_real_escape_string($link, $_POST['retrieve']);

                mysqli_select_db($link, "movie_grade") or die("Cannot connect to database");
                echo buildQuery($init_type, $init_id, $inter_type, $inter_id, $retrieve);
                $query = mysqli_query($link, buildQuery($init_type, $init_id, $inter_type, $inter_id, $retrieve));

                echo "<table class='u-full-width'>";
                echo "<tr><td style='font-weight:bold'>" . "Director ID" . "</td><td style='font-weight:bold'>" . "Director Name" . "</td><tr>";
                while($row = mysqli_fetch_array($query)){
                  echo "<tr><td>" . $row[0] . "</td><td> " . $row[1] . "</td><td>" . $row[2] . "</td></tr>";
                }
                echo "</table>";

              }
              ?>
            </div>
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
