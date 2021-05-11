
<?php



    include_once("includes/autoloader.inc.php");


    session_start();

    $user = User::getUser(1);
    
    $_SESSION["user"] = $user["email"];

    $_SESSION["user-type"] = $user["type"];

    $posts = Post::getAllPosts();



    


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cssgram/0.1.10/cssgram.min.css">
    <title>Buckle up</title>
</head>
<body>

<?php include_once(__DIR__."/header.php") ?>


<?php if($_SESSION["user-type"] === "admin"): ?>
    <div class="container__reports">
        <a class="btn__reports" href="reports.php">Bekijk de reported posts</a>
    </div>
    
<?php endif; ?>

<h1 class="title">Buckle up posts</h1>




    <?php foreach($posts as $p): ?>
        <?php 

        
           $tags = Tag::getTagsByPostId($p[0]);

           $reports = Report::getReportsById($p[0]);

           $numberOfReports = count($reports);
          

           if($numberOfReports < 3):

            
            ?>

    <div class="post">
        <div class="post__report">
            <a class="report" href="" data-postid="<?php echo $p[0];?>">Report</a>
        </div>
        <div class="post_user">
            <img class="post_avatar" src="images/<?php echo htmlspecialchars($p["avatar"]) ?>" alt="avatar">
            <a class="post_username" href="userpage.php?user=<?php echo $p["user_id"] ?>"><h2><?php echo htmlspecialchars($p["username"]) ?></h2></a>
        </div>
        
        <a class="btn-location" href="location.php?location=<?php echo $p["location"] ?>"><p class="post__location"><?php echo htmlspecialchars($p["location"]) ?></p></a>
        <figure class="<?php echo htmlspecialchars( $p["filter"]) ?>">
            <img class="post__image" src="images/<?php echo htmlspecialchars($p["image"]) ?>" alt="post">
        </figure>
        <p class="post_description"><?php echo htmlspecialchars($p["description"]) ?></p>
        <div class="post_tags">
            <?php foreach($tags as $t): ?>
            <?php $tWithouth = explode("#", $t["text"]); ?>
                <a href="tagpage.php?tag=<?php echo htmlspecialchars(end($tWithouth)); ?>"><?php echo htmlspecialchars($t["text"]); ?></a>
            <?php endforeach; ?>
        </div>

        <?php
							$query1=mysqli_query($conn,"select * from `likes` where post_id='".$row['post_id']."' and user_id='".$_SESSION['user_id']."'");
							if (mysqli_num_rows($query1)>0){
								?>
								<button value="<?php echo $row['post_id']; ?>" class="unlike">Unlike</button>
								<?php
							}
							else{
								?>
								<button value="<?php echo $row['post_id']; ?>" class="like">Like</button>
								<?php
							}
						?>
					<span id="show_like<?php echo $row['post_id']; ?>">
						<?php
							$query3=mysqli_query($conn,"select * from `likes` where post_id='".$row['post_id']."'");
							echo mysqli_num_rows($query3);
						?>
					</span>
				</div>
				</div><br>
			<?php
		}
	?>
</div>
 
<script src = "jquery-3.1.1.js"></script>	
<script type = "text/javascript">
	$(document).ready(function(){
 
		$(document).on('click', '.like', function(){
			var id=$(this).val();
			var $this = $(this);
			$this.toggleClass('like');
			if($this.hasClass('like')){
				$this.text('Like'); 
			} else {
				$this.text('Unlike');
				$this.addClass("unlike"); 
			}
				$.ajax({
					type: "POST",
					url: "like.php",
					data: {
						id: id,
						like: 1,
					},
					success: function(){
						showLike(id);
					}
				});
		});
 
		$(document).on('click', '.unlike', function(){
			var id=$(this).val();
			var $this = $(this);
			$this.toggleClass('unlike');
			if($this.hasClass('unlike')){
				$this.text('Unlike'); 
			} else {
				$this.text('Like');
				$this.addClass("like"); 
			}
				$.ajax({
					type: "POST",
					url: "like.php",
					data: {
						id: id,
						like: 1,
					},
					success: function(){
						showLike(id);
					}
				});
		});
 
	});
 
	function showLike(id){
		$.ajax({
			url: 'show_like.php',
			type: 'POST',
			async: false,
			data:{
				id: id,
				showlike: 1
			},
			success: function(response){
				$('#show_like'+id).html(response);
 
			}
		});
	}
 
</script>

    <?php
	session_start();
	include('Db.php');
 
	if (isset($_POST['showlike'])){
		$id = $_POST['id'];
		$query2=mysqli_query($conn,"select * from `likes` where post_id='$id'");
		echo mysqli_num_rows($query2);	
	}
?>


        
    </div>

        <?php endif; ?>
    <?php endforeach; ?>


    <a class="btn-more" href="">load more</a>
    
    








<?php include_once(__DIR__."/footer.php") ?>

<script src="js/app.js"></script>




    
</body>
</html>

