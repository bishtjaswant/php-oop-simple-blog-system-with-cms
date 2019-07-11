<?php require_once '../lib/Session.php'; 
Session::checkLogin();
?>
<?php require_once '../config/config.php'; ?>
<?php require_once '../helpers/format.php'; ?>
<?php require_once '../lib/Database.php' ?>



<?php 
$db = new Database;
$format = new Format;

 ?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

		<?php 
// reveiving all iinput field

		if ($_SERVER['REQUEST_METHOD']=="POST") {
			$email= $format->validation($_POST['email']);
			$password= $format->validation($_POST['password']);

			if (!empty($email) &&  !empty($password)) {
			      // check the email credenrtial
				$emailCredentialQuery= "SELECT  * FROM `admins` WHERE `email`=:email";

				$row = $db->credential($emailCredentialQuery,$email);

                if ($row=="INVALID_EMAIL") {
                echo '<p style="color:red;font-size: 1.1rem;font-weight: 200;">Please enter Correct email to login</p>';	
                } else {
                      // now check password
                	   if (password_verify($password, $row['password'] )) {
                	         // set session
                	   	    Session::set("login",true);
                	   	    Session::set("username",$row['name']);
                	   	    Session::set("userID",$row['id']);
                	   	    header("Location: index.php");
                       	   } else {
                	   	   echo '<p style="color:red;font-size: 1.1rem;font-weight: 200;">You have entered incorrect password</p>';	
                	   }
                	 
                }



			} else {
				echo '<p style="color:red;font-size: 1.1rem;font-weight: 200;">Please enter email or password</p>';
			}
		}



		 ?>
		<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="email" value="<?=@$email ?>" placeholder="Email" name="email"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#"><?= SITE_TITLE; ?></a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>