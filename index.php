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
						window.location.href = "profile.php";
					}
				})
				return false;
			}
		}

		window.onload = function(){
			document.getElementById('search').onsubmit=function() {
				var inputs = document.getElementById("search").elements;
				$.ajax({
					type: "POST",
					url: "table.php",
					data: {login:inputs[0].value},
					success: function(data){
						alert("Logged in");
						$("#table").html(data);
					}
				})
				return false;
			}
		}

		function get_table(){
			$.ajax({
				url: "table.php",
				dataType: "html",
				success: function(data){
					$("#table").html(data);
				}
			})
		}

		function get_sorted(type){
			$.ajax({
				type: "POST",
				url: "table.php",
				data: {type:type},
				success: function(data){
						$("#table").html(data);
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
				</form>
				<?php
			}
			?>
			<form action="http://localhost/profile.php">
			<?php
			if(isset($_SESSION["login"]))
    				echo"<input type=\"submit\" value=\"Profile\">";
		  ?>
			</form>
			<br><br><center><form id="search"><input type="text" name="login" id="log_search"><input type="submit" value="Search"><br></form></center><br>
			<center><input type="button" value="Descending" onclick="get_sorted('desc')"><input type="button" value="Ascending" onclick="get_sorted('asc')"></center>
			<script> get_table() </script>
			<center><div id="table"></div></center>
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
