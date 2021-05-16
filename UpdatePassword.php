<?php

session_start();
include_once( __DIR__ . '/classes/User.php' );

if (isset($_SESSION["id"])) {
  
    $user = User::getUser($_SESSION["id"]);
    
    $email = $user["email"];

    if (!empty($_POST)) {
        try {
            $changePassword = new User;
            $changePassword->setNewPassword($_POST["newp1"]);
            $changePassword->setPasswordCheck($_POST["newp2"]);
            $changePassword->setOldPassword($_POST["oldpas"]);
            $changePassword->changePassword($email);

            header("Location: profile.php");
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
    <link rel="stylesheet" href="style/changepassword.css" />
    <link rel="stylesheet" href="style/background.css" />
    <title>Change your password</title>
</head>
<body class="changePass">
<?php include("header.php") ?>
<h1 id="titel">Change password</h1>
    <form class="form-group" action="" method="post">
        <label for="oldp">Old password</label>
        <input class="form-control" type="password" name="oldpas" placeholder="Old password">

        <label for="pas1">New password</label>
        <input class="form-control" type="password" name="newp1" placeholder="New password">

        <label for="pas2">Repeat new password</label>
        <input class="form-control" type="password" name="newp2" placeholder="Repeat new password">

        <button class="btn btnu btn-primary" type="submit" name="changeE"> Change </button>
    </form>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>