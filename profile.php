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

		window.onload = function(){
			document.getElementById('save').onsubmit=function() {
				var inputs = document.getElementById("save").elements;
				var id = <?php
				if(isset($_SESSION["other_id"])==true) {
					echo $_SESSION["other_id"];
				}
				else {
					echo $_SESSION["id"];
				}?>;
				alert(id);
				$.ajax({
					type: "POST",
					url: "save.php",
					data: {id: id, login:inputs[0].value, fname:inputs[1].value, lname:inputs[2].value, password:inputs[3].value},
					success: function(){
						<?php unset($_SESSION["other_id"]); ?>
						alert("Saved");
					}
				})
				return false;
			}
		}
	</script>

<?php
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	echo $id;
	include ("db.php");
	$result = mysqli_query($db, "SELECT * FROM userz WHERE id='$id'");
	$myrow = mysqli_fetch_array($result);
	if(isset($_SESSION["role"]))
	{
		if($_SESSION["role"]=="admin")
		{
			$_SESSION["other_id"] = $myrow['id'];
			?>
			<form id="save">
			Role:<br>
			<?php echo $myrow["role"] ?><br>
			<br>
			Login:<br>
			<input type="text" name="login" id="log" value="<?php echo htmlspecialchars($myrow["login"]) ?>"><br>
			<br>
			First name:<br>
			<input type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($myrow["name"]) ?>"><br>
			<br>
			Last name:<br>
			<input type="text" name="lname" id="sname" value="<?php echo htmlspecialchars($myrow["surname"]) ?>"><br>
			<br>
			Password:<br>
			<input type="password" name="password" id="pass" value="<?php echo htmlspecialchars($myrow["password"]) ?>"><br>
			<input type="submit" value="Save"><br>
			<input type="button" value="Delete this" onclick="del(<?php echo htmlspecialchars($id) ?>)">
			</form>
			<br>
		<?php
		}
		else
		{
			?>
			Login:<br>
			<?php echo $myrow["login"] ?><br>
			<br>
			Role:<br>
			<?php echo $myrow["role"] ?><br>
			<br>
			Name:<br>
			<?php echo $myrow["name"] ?><br>
			<br>
			Surname:<br>
			<?php echo $myrow["surname"] ?><br>
			<br>
			<?php
		}
	}
	else
	{
		?>
		Login:<br>
		<?php echo $myrow["login"] ?><br>
		<br>
		Role:<br>
		<?php echo $myrow["role"] ?><br>
		<br>
		Name:<br>
		<?php echo $myrow["name"] ?><br>
		<br>
		Surname:<br>
		<?php echo $myrow["surname"] ?><br>
		<br>
		<?php
	}
}
else
{
	echo $_SESSION["id"]?>
	<form id="save">
	Role:<br>
	<?php echo $_SESSION["role"] ?><br>
	<br>
	Login:<br>
	<input type="text" name="login" id="log" value="<?php echo htmlspecialchars($_SESSION["login"]) ?>"><br>
	<br>
	First name:<br>
	<input type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($_SESSION["name"]) ?>"><br>
	<br>
	Last name:<br>
	<input type="text" name="lname" id="sname" value="<?php echo htmlspecialchars($_SESSION["surname"]) ?>"><br>
	<br>
	Password:<br>
	<input type="password" name="password" id="pass" value="<?php echo htmlspecialchars($_SESSION["password"]) ?>"><br>
	<input type="submit" value="Save"><br>
	<input type="button" value="Delete this" onclick="del(<?php echo htmlspecialchars($_SESSION["id"]) ?>)">
	</form>
	<br>
	<?php
}
?>

<form>
<input type="button" value="Main page" onClick='location.href="http://localhost/index.php"'>
</form>

</body>
</html>
