<?php
	session_start();
	if(isset($_POST["login"], $_POST["fname"], $_POST["lname"]))
	{
		if ($_POST["login"] == '' || $_POST["fname"] == '' || $_POST["lname"] == '' || $_POST["password"] == '')
		{
			exit ("You did not fill all the fields");
		}
		else
		{
			if(isset($_SESSION["other_id"]))
			{
				$id = $_SESSION["other_id"];
				unset($_SESSION["other_id"]);
				$login = $_POST["login"];
				$password = $_POST["password"];
				$fname = $_POST["fname"];
				$lname = $_POST["lname"];

				$login = stripslashes($login);
   			$login = htmlspecialchars($login);
				$login = trim($login);

				$password = stripslashes($password);
   				$password = htmlspecialchars($password);
				$password = trim($password);

				$fname = stripslashes($fname);
   				$fname = htmlspecialchars($fname);
				$fname = trim($fname);

				$lname = stripslashes($lname);
   				$lname = htmlspecialchars($lname);
				$lname = trim($lname);
				include ("db.php");

				$query ="UPDATE userz SET login='$login', password='$password', name='$fname', surname='$lname' WHERE id='$id'";
   				$result = mysqli_query($db, $query) or die("Error " . mysqli_error($db));
    				if($result)
        				echo "Data is refreshed";
				header ('Refresh: 3; URL=http://localhost/index.php');
			}
			else
			{
				$id = $_SESSION["id"];
				$login = $_POST["login"];
				$password = $_POST["password"];
				$fname = $_POST["fname"];
				$lname = $_POST["lname"];

				$login = stripslashes($login);
   				$login = htmlspecialchars($login);
				$login = trim($login);

				$password = stripslashes($password);
   				$password = htmlspecialchars($password);
				$password = trim($password);

				$fname = stripslashes($fname);
   				$fname = htmlspecialchars($fname);
				$fname = trim($fname);

				$lname = stripslashes($lname);
   				$lname = htmlspecialchars($lname);
				$lname = trim($lname);
				include ("db.php");

				$query ="UPDATE userz SET login='$login', password='$password', name='$fname', surname='$lname' WHERE id='$id'";
   				$result = mysqli_query($db, $query) or die("Error " . mysqli_error($db));
    				if($result)
					$_SESSION['login'] = $login;
					$_SESSION['name'] = $fname;
					$_SESSION['surname'] = $lname;
					$_SESSION["password"] = $password;
        				echo "Data is refreshed";
				header ('Refresh: 3; URL=http://localhost/profile.php');
			}
		}
	}
?>
