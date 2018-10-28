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
  echo get_table();
?>
