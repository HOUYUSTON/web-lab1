<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="windows-1251">
	</head>
	<body>
		<?php
			include ("db.php");
			$result=mysqli_query($db,"SELECT * FROM lab3");
			$props=array();
			while($object=mysqli_fetch_object($result))
			{
				$props[]=$object;
			}
			foreach ($props as $props) {
				if($props->type=='pic'){
					echo"<img src=\"props/$props->name\">";
					echo"<br>";
				}
				elseif ($props->type=='vid') {
					echo"<video src=\"props/$props->name\" controls></video>";
					echo"<br>";
				}
				elseif ($props->type=='src') {
					echo"<iframe src=\"$props->name\" allowfullscreen=\"\" frameborder=\"0\"></iframe>";
					echo"<br>";
				}
				elseif ($props->type=='mus') {
					echo"<audio src=\"props/$props->name\" controls>";
					echo"<br>";
				}
			}
		?>
	</body>
</html>
