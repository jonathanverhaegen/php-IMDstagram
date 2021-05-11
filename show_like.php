<?php
	session_start();
	include('Db.php');
 
	if (isset($_POST['showlike'])){
		$id = $_POST['id'];
		$query2=mysqli_query($conn,"select * from `likes` where post_id='$id'");
		echo mysqli_num_rows($query2);	
	}
?>