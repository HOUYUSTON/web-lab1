<?php
	session_start();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!DOCTYPE html>
<html lang="en">
<head>
  <style>
  h1 {
      position: absolute;
      left: 400px;
      top: 0px;
  }
  h2 {
      position: absolute;
      left: 550px;
      top: 310px;
  }
  h3 {
      position: absolute;
      left: 250px;
      top: 400px;
  }
  </style>
</head>


<body>
	<script type="text/javascript">
		function del(id){
			$.ajax({
				type: "POST",
				url: "delete.php",
				data: {id: id},
				success: function(){
					window.location.href = "index.php";
				}
			})
		}
	</script>

<?php
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	include ("db.php");
	$result = mysqli_query($db, "SELECT * FROM userz WHERE id='$id'");
	$myrow = mysqli_fetch_array($result);
	if(isset($_SESSION["role"]))
	{
		if($_SESSION["role"]=="admin")
		{
			$_SESSION["other_id"] = $myrow['id'];
			echo'<form name="save" action="save.php" method="post">';
			echo'Role:<br>';
			echo $myrow["role"].'<br>';
			echo '<br>';
			echo'Login:<br>';
			echo'<input type="text" name="login" id="log" value='.htmlspecialchars($myrow["login"]).'><br>';
			echo '<br>';
			echo'First name:<br>';
			echo'<input type="text" name="fname" id="fname" value='.htmlspecialchars($myrow["name"]).'><br>';
			echo '<br>';
			echo'Last name:<br>';
			echo'<input type="text" name="lname" id=\"sname" value='.htmlspecialchars($myrow["surname"]).'><br>';
			echo '<br>';
			echo'Password:<br>';
			echo'<input type="password" name="password" id="pass" value='.htmlspecialchars($myrow["password"]).'><br>';
			echo'<input type="button" value="Delete this" onclick="del('.htmlspecialchars($myrow["id"]).')">';
			echo'</form>';
			echo'<br>';
		}
		else
		{
			echo'Login:<br>';
			echo $myrow["login"].'<br>';
			echo '<br>';
			echo'Role:<br>';
			echo $myrow["role"].'<br>';
			echo '<br>';
			echo'Name:<br>';
			echo $myrow["name"].'<br>';
			echo '<br>';
			echo'Surname:<br>';
			echo $myrow["surname"].'<br>';
			echo '<br>';
		}
	}
	else
	{
		echo'Login:<br>';
		echo $myrow["login"].'<br>';
		echo '<br>';
		echo'Role:<br>';
		echo $myrow["role"].'<br>';
		echo '<br>';
		echo'Name:<br>';
		echo $myrow["name"].'<br>';
		echo '<br>';
		echo'Surname:<br>';
		echo $myrow["surname"].'<br>';
		echo '<br>';
	}
}
else
{
	echo'<form name="save" action="save.php" method="post">';
	echo'Role:<br>';
	echo $_SESSION["role"].'<br>';
	echo '<br>';
	echo'Login:<br>';
	echo'<input type="text" name="login" id="log" value='.htmlspecialchars($_SESSION["login"]).'><br>';
	echo '<br>';
	echo'First name:<br>';
	echo'<input type="text" name="fname" id="fname" value='.htmlspecialchars($_SESSION["name"]).'><br>';
	echo '<br>';
	echo'Last name:<br>';
	echo'<input type="text" name="lname" id=\"sname" value='.htmlspecialchars($_SESSION["surname"]).'><br>';
	echo '<br>';
	echo'Password:<br>';
	echo'<input type="password" name="password" id="pass" value='.htmlspecialchars($_SESSION["password"]).'><br>';
	echo'<input type="button" value="Delete this" onclick="del('.htmlspecialchars($_SESSION["id"]).')">';
	echo'</form>';
	echo'<br>';
	/*echo'<h1><img src="photo.png" alt="Photo" width="400" height="300"></h1>';
	echo'<h2><a href=""><button> Change photo</button></a> </h2>';*/
}
?>

<form>
<input type="button" value="Main page" onClick='location.href="http://localhost/index.php"'>
</form>

</body>
</html>
