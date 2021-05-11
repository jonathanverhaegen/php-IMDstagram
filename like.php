<?php
	include ('Db.php');
	session_start();
 
	if (isset($_POST['like'])){		
 
		$id = $_POST['id'];
		$query=mysqli_query($conn,"select * from `likes` where post_id='$id' and user_id='".$_SESSION['user_id']."'") or die(mysqli_error());
 
		if(mysqli_num_rows($query)>0){
			mysqli_query($conn,"delete from `likes` where user_id='".$_SESSION['user_id']."' and post_id='$id'");
		}
		else{
			mysqli_query($conn,"insert into `likes` (user_id,post_id) values ('".$_SESSION['user_id']."', '$id')");
		}
	}		
?>