<?php

include_once(__DIR__ . '/classes/User.php');


if(!empty($_POST)){ 

	$user = new User();
	$email = $_POST['email'];
    $password = $_POST['password'];
    
	//check if required field are not empty 
	if(!empty($email) && !empty($password)){

	//check  username
		if($user->canLogin($email,$password)){
			
			session_start();
			$_SESSION['user'] = $email;
			header("Location: index.php"); //redirect to index.php
        }

        else{
			$error = "Wrong email or password.";
		}
	} 
	else{
		$error ="Email and password are required.";	
	}
}

        
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/style.css">
    <title>Document</title>
	
</head>
<body>

<section id="middenkader">

	<div id="welkomtekst">
	<h1>Buckle up!</h1>
	</div>
        
        <div id="form_inloggen">
			<form action="" method="post">
				
				<div class="formfield">
					<label for="Username">Email adress</label>
					<br>
					<input type="text" id="email" name="email">
				</div>
				<br>

			    <div class="formfield">
					<label for="Wachtwoord">Password</label>
					<br>
					<input type="password" id="password" name="password">
				</div> 
                <br>

				<?php if (isset($error)) : ?>
				<div class="error" >
					<?php echo $error ?>
				</div>
				<?php endif; ?>
				<div class="formfield_submit">
					<input type="submit" value="inloggen" class="btn-inloggen">	
				</div>
				<br>
				<div >
    <p>Don't have an account? <br><a href="register.php"> register here! (it's free)</a></p>
    </div>
                
			</form>
		 </div>
	</div>


	</section>



    
</body>
</html>