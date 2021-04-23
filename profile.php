<?php

session_start();
include_once( __DIR__ . '/classes/User.php' );

if (isset($_SESSION["user"])) {
    
    $email = $_SESSION["user"];

    $user = new User();
    

    try {
        $showEmail = $user->viewEmail($email);
        $showDescription = $user->viewDescription($email);
        $viewAvatar = $user->showAvatar($email);
        
        if (isset($_POST['submitAvatar'])) {
            try {
                $file = $_FILES["avatar"];
                $fileName = $_FILES["avatar"]["name"];
                //$fileError = $_FILES["avatar"]["error"];
                $fileSize = $_FILES["avatar"]["size"];
                $fileTmpName = $_FILES["avatar"]["tmp_name"];
                
                $user->changeAvatar($email, $fileName, $fileSize, $fileTmpName,$file);  
            }
            catch (\Throwable $th) {
                $error = $th->getMessage();
            }
        }
    } catch (\Throwable $t) {
        $error = $t->getMessage();
    }
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css"/>
    <title>Profile</title>
</head>
<body class="profile">
<?php include("header.php") ?>
    <div class="content">
        <div class="profilePicture">
            <h1>Your profile</h1>
            <h2>Profile picture</h2>
            <h2></h2>
            <img src="<?php echo htmlspecialchars($viewAvatar) ?>" alt="#">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="avatar" class="btn">
                <button type="submit" name="submitAvatar" class="btn btn-primary">Upload profile picture</button>
            </form>
            <h2>Bio</h2>
            <p> <?php echo htmlspecialchars($showDescription) ?> </p>
            <a href="updateDescription.php">Change description</a>
            <h2>Email adress</h2>
            <a href="updateemail.php">Change email</a>
            <h2>Password</h2>
            <a href="UpdatePassword">Change password</a>
        </div>


            <div>
                <input type="submit" value="Update characteristics" class="btn btnu btn-primary" name="tags">	
            </div>
            </form>
        </div>
    </div>
    <!-- end characteristics -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>