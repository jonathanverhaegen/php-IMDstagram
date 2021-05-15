<!DOCTYPE html>
<html>
<head>
	<title>Like Button</title>
<link rel ="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname="buckle_up";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM user_like";
$result = $conn->query($sql);
if($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
       $ncount=$row["count"];
    }
}else{
	$ncount=0;
}
?>

<?php
$sql = "SELECT * FROM user_like";
$result = $conn->query($sql);
$count=$_POST['send'];
if($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
       $ncount=$row["count"];
    }
    $ncount+=1;
    $sql1="UPDATE user_like SET count=$ncount WHERE id=1";
    $result1=$conn->query($sql1);
    if($result1==TRUE){
    	echo $ncount;
    }else{
    	echo "fail";
    }

}else{
	$sql="INSERT INTO user_like (count) VALUES ($count)";
	if($result=$conn->query($sql)==TRUE){
		echo $count;
	}else{
		echo "error";
	}
}
?>

<div class="container">
	<div class="well">
		<button class="btn btn-primary" id="like">Like Button</button>
		<div id="show"><h3><?php echo $ncount; ?> Like</h3></div>
</div>
</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var count=1;
		$("#like").click(function(){
			$.ajax({
				type:"POST",
				url:"classes/Db.php",
				data:{send:count},
				success:function(data){
					$("#show").html("<h3>"+data+ " Like </h3>");
				}
			});
		});
	});
</script>
</body>
</html>