<?php
	session_start();
	if(isset($_POST['id']))
	{
		echo"id";
		$id = $_POST['id'];
		include ("db.php");
		mysqli_query($db, "DELETE FROM userz WHERE id='$id'");
		if($id==$_SESSION['id'])
		{
			session_unset();
		}
	}
?>
