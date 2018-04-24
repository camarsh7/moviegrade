<html>
    <head>
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
   ?>
    <body>
        <h2>Home Page</h2>
        
		<p>Hello <?php Print "$user" ?>! </p>
 <!--Display's user name-->
        <a href="logout.php">Click here to go logout</a><br/><br/>
        <form action="add.php" method="POST">
           Add more to list: <input type="text" name="details" /> <br/>
           Public post? <input type="checkbox" name="public[]" value="yes" /> <br/>
           <input type="submit" value="Add to list"/>
        </form>
    <h2 align="center">My list</h2>
	<table border="1px" width="100%">
			<tr>
				<th>Id</th>
				<th>Details</th>
				<th>Post Time</th>
				<th>Edit Time</th>
				<th>Edit</th>
				<th>Delete</th>
				<th>Public Post</th>
			</tr>
			
		<?php 
			if(!empty($_GET['id'])) {
				$id = $_GET['id'];
				$_SESSION['id'] = $id;
				$id_exists = true;
				$link = mysqli_connect("127.0.0.1", "root", "", "first_db");
				mysqli_select_db($link, "first_db") or die("Cannot connect to database");
				$query = mysqli_query($link, "SELECT * FROM list WHERE id='$id'");
				$count = mysqli_num_rows($query);
				if($count > 0) {
					while($row = mysqli_fetch_array($query)) {
						Print "<tr>";
						Print '<td align="center">'. $row['id'] . "</td>";
						Print '<td align="center">'. $row['details'] . "</td>";
						Print '<td align="center">'. $row['date_posted']. " - ". $row['time_posted']."</td>";
						Print '<td align="center">'. $row['date_edited']. " - ". $row['time_edited']. "</td>";
						Print "</tr>";
					}
				} else {
					$id_exists = false;
				}
			}
		?>
	</table>
	<br/>
	<?php
		if($id_exists)
		{
		Print '
		<form action="edit.php" method="POST">
			Enter new detail: <input type="text" name="details"/><br/>
			public post? <input type="checkbox" name="public[]" value="yes"/><br/>
			<input type="submit" value="Update List"/>
		</form>
		';
		}
		else
		{
			Print '<h2 align="center">There is no data to be edited.</h2>';
		}
	?>
	</body>
</html>

<?php 
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$link = mysqli_connect("127.0.0.1", "root", "", "first_db");
		mysqli_select_db($link, "first_db") or die("Cannot connect to database");
		$details = mysqli_real_escape_string($link, $_POST['details']);
		$public = "no";
		$id = $_SESSION['id'];
		$time = strftime("%X");
		$date = strftime("%B %d, %Y");
		
		foreach($_POST['public'] as $list) {
			if($list != null) {
				$public = "yes";
			}
		}
		
		mysqli_query($link, "UPDATE list SET details='$details', public='$public', date_edited='$date', time_edited='$time' WHERE id='$id'");
		
		header("location: home.php");
	}
?>



