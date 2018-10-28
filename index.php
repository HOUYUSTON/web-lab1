<?php
	session_start();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="windows-1251">
	</head>
	<body>
		<script type="text/javascript">
		window.onload = function(){
			document.getElementById('login').onsubmit=function() {
				var inputs = document.getElementById("login").elements;
				$.ajax({
					type: "POST",
					url: "login.php",
					data: {login:inputs[0].value, pass:inputs[1].value},
					success: function(){
						alert("Logged in");
						window.location.href = "profile.php";
					}
				})
				return false;
			}
		}
		</script>
		
		<script>
		function get_table(){
			$.ajax({
				url: "table.php",
				success: function(data){
					alert(data);
					$(data).text(htmlString);
				}
			})
		}
		</script>
		<?php
			if(isset($_SESSION["role"]))
			{
				echo "you are ".$_SESSION["role"];
			}
			else
			{
				?>
				<form id="login">
				Login: <br> <input type="text" name="login"> <br>
				Pasword: <br> <input type="password" name="pass"> <br>
				<input type="submit" value="Enter"> <br>
				<?php
			}
			?>
			<form action="http://localhost/profile.php">
			<?php
			if(isset($_SESSION["login"]))
    				echo"<input type=\"submit\" value=\"Profile\">";
		  ?>
			</form>
			<br><br><br>
			<center><script>get_table()</script></center>
			<?php
			if(isset($_SESSION["login"]))
			{
				?>
				<form action="http://localhost/log_out.php">
				<input type="submit" value="Log out">
				</form>
				<?php
			}
		?>

	</body>
</html>
