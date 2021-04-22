<?php

session_start();
include_once( __DIR__ . '/classes/User.php' );

if (isset($_SESSION["user"])) {
    $email = $_SESSION["user"];

    if (!empty($_POST)) {
        try {
            $newEmail = new User;
            $newEmail-> setOldEmail($_POST["oldE"]);
            $newEmail-> setNewEmail($_POST["newE1"]);
            $newEmail-> setNewEmailCheck($_POST["newE2"]);
            $newEmail->editEmail($email);
            $succes = "email changed";
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
    <title>Change email here</title>
</head>
<body class="changeEmail">
<?php include("app/frontend/includes/navbar.php") ?>
    <h1>Change email here</h1>
    <form class="form-group" action="" method="post">
        <label for="old-email" >Enter your old email</label>
        <input class="form-control" type="email" name="oldE" placeholder="Old email" >
        <label for="new-email1" >Enter your new email</label>
        <input class="form-control" type="email" name="newE1" placeholder="New email">
        <label for="new-email2" >Repeat your new email</label>
        <input class="form-control" type="email" name="newE2" placeholder="Repeat">
        <button type="submit" name="changeE" class="btn btnu btn-primary">Submit</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>