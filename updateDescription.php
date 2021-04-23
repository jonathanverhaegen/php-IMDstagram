<?php

session_start();
include_once( __DIR__ . '/classes/User.php' );

if (isset($_SESSION["user"])) {
    $email = $_SESSION["user"];
    $description = new User;
    $showDescription = $description->viewDescription($email);
    if (!empty($_POST)) {
        try {
            $description->setDescription($_POST["description"]);
            $description->editDescription($email);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }
    }
} else {
    header("Location: logout.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <title>Change your description</title>
</head>
<body class="desc">
<?php include("app/frontend/includes/navbar.php") ?>
    <form action="" method="post">
        <h2><label for="dscrptn" >Your description</label></h2>
        <textarea class="form-control" name="description" id="description" cols="30" rows="10" > <?php echo htmlspecialchars($showDescription) ?> </textarea>
        <button type="submit" name="updateDes" class="btn btn-primary btnu">Update</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>