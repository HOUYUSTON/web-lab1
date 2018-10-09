<?php
	session_start();
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		include ("db.php");		
		$result = mysqli_query($db, "DELETE FROM userz WHERE id='$id'");
		if($id==$_SESSION['id'])
		{
			header("Location: log_out.php");
		}
		else
		{
			header("Location: index.php");
		}
	}	
?>