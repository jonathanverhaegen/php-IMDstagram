<?php

include_once(__DIR__."/includes/autoloader.inc.php");

if (!empty($_POST)) {
		
	try {
	  $user = new User();
	  $user->setUsername($_POST['username']);
	  $user->setEmail($_POST['email']);
	  $user->setPassword($_POST['wachtwoord']);
	  $user->setConfirmPassword($_POST['wachtwoordHerhaling']);

	  $user->registerUser();
	  
	  session_start();
	  $_SESSION['user'] = $_POST['email'];
	  header("Location: index.php");
	} catch (\Throwable $th) {
	  $error = $th->getMessage();
	}
  }

?>



<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/style.css">
    <title>Register</title>
</head>
<body>

<div id="aanmelden">

<div id="welkomtekst">
	<h1>Buckle up!</h1>
	<p>The following fields are required in order to create your account.</p>
	<p>Do you already have an account? <br><a href="login.php"> Go to this page and login in!</a></p>
	</div>
      
        
        <div id="form_aanmelden">
			<form action="" method="post">
				
				<div class="formfield">
					<label for="username">Choose a username:</label>
					<br>
					<input type="text" id="username" name="username">
				</div>
				<br>

				<div class="formfield">
					<label for="email">Email adress:</label>
					<br>
					<input type="text" id="email" name="email">
				</div>
                <br>

			    <div class="formfield">
					<label for="wachtwoord">Choose a password:</label>
					<br>
					<input type="password" id="wachtwoord" name="wachtwoord">
				</div> 
                <br>
                
				<div class="formfield">
					<label for="wachtwoord_herhaling">Repeat password:</label>
					<br>
					<input type="password" id="wachtwoordHerhaling" name="wachtwoordHerhaling">
				</div>
                <br>
				<?php if (isset($error)) : ?>
    			<div class="error" >
					<?php echo $error ?>
				</div>
				<?php endif; ?>
				<div class="formfield_submit">
					<input type="submit" value="register" class="btn-inloggen">	
				</div>

				
    </div>
                
			</form>
		 </div>

	</div>
    
</body>
</html>