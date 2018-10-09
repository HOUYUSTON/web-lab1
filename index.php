<?php
	session_start();
	function get_users(){
		include ("db.php");
		$result=mysqli_query($db,"SELECT * FROM userz");
  		$users=array();
  		while($object=mysqli_fetch_object($result))
		{
    			$users[]=$object;
		}
  		mysqli_close($db);
  		return $users;
	}
	function get_table(){
 		$table_str='<table>';
  		$users=get_users();
  		foreach ($users as $users) {
      			$table_str.='<tr>';
      			$table_str.='<td>'.$users->id.'</td><td>'.$users->login.'</td><td>'.$users->role.'</td><td><a href="profile.php?id='.$users->id.'">view_profile</a></td>';
      			$table_str.='</tr>';
  		}
  		$table_str.='</table>';
  		return   $table_str;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="windows-1251">
	</head>
	<body>
		<?php	
			if(isset($_SESSION["role"]))
			{
				echo "you are ".$_SESSION["role"];
			}
			else
			{
				echo"<form name=\"login\" action=\"login.php\" method=\"post\">";	
				echo"Login: <br> <input type=\"text\" name=\"login\"> <br>";
				echo"Pasword: <br> <input type=\"password\" name=\"pass\"> <br>";	
				echo"<input type=\"submit\" value=\"Enter\"> <br>";
			}
			echo"<form action=\"http://localhost/profile.php\">";
			if(isset($_SESSION["login"]))
    				echo"<input type=\"submit\" value=\"Profile\">";
			echo"</form>";
			echo "<br><br><br>";
			echo "<center>",get_table(),"</center>";
			if(isset($_SESSION["login"]))
			{
				echo"<form action=\"http://localhost/log_out.php\">";
				echo"<input type=\"submit\" value=\"Log out\">";
				echo"</form>";
			}
		?>
		
	</body>
</html>