<?php
	session_start();
	if(isset($_POST["login"]))
	{
		if ($_POST["login"] == '')
		{
			exit ("You did not enter login, come back and fill the field login!");
		}
		if ($_POST["pass"] == '')
		{
			exit ("You did not enter password, come back and fill the field password!");
		}
		$login = $_POST["login"];
		$pass = $_POST["pass"];
		// ������������ ��������� ������
		$login = stripslashes($login);
   	$login = htmlspecialchars($login);
		$login = trim($login);
		$pass = stripslashes($pass);
    $pass = htmlspecialchars($pass);
		$pass = trim($pass);
		include ("db.php");

		$result = mysqli_query($db, "SELECT * FROM userz WHERE login='$login'");
		$myrow = mysqli_fetch_array($result);
		if(empty($myrow['password']))
		{
			exit ("invalid login or password");
		}
		else
		{
			if($myrow['password'] == $pass)
			{
				$_SESSION['id'] = $myrow['id'];
				$_SESSION['login'] = $myrow['login'];
				$_SESSION['name'] = $myrow['name'];
				$_SESSION['surname'] = $myrow['surname'];
				$_SESSION['role'] = $myrow['role'];
				$_SESSION['password'] = $myrow['password'];
   			exit();    // ��������� ������ �������, ����� ����� � �������
			}
			else
			{
				exit ("invalid password");
			}
		}
	}
?>
