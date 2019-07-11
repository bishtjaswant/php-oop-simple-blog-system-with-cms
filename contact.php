<?php include_once 'inc/header.php';?> 
<?php include_once './lib/Contact.php'; ?>
<?php 
$format= new Format; 
$contactDB = new Contact;
?>






<?php 
// process the contact
if (isset($_POST['sendcontact'])) {
	$firstname= ucfirst($format->validation($_POST['firstname']));
	$lastname= ucfirst($format->validation($_POST['lastname']));
	$email= $format->validation($_POST['email']);
	$message = $format->validation($_POST['message']); ;
    $success = "";
	$errors = "";

	if (empty($firstname)    ) {
		$errors="please enter your firstname";
	}
	elseif (empty($lastname) ) {
		$errors="please enter your lastname";
		
	}
	elseif ( ! filter_var($firstname, FILTER_SANITIZE_SPECIAL_CHARS)  ) {
	 $errors="Invalid firstname";		
	}
	elseif (! filter_var($lastname, FILTER_SANITIZE_SPECIAL_CHARS) ) {
			 $errors="Invalid lastname";	
	}
	elseif ( empty($email) ) {
		$errors="please enter your email";
		
	}
	elseif ( ! filter_var($email, FILTER_VALIDATE_EMAIL) ) {
		$errors="Your email not seem a valid email address";
		
	}
	elseif ( empty($message) ) {
		$errors="please enter your message";
		
	}

	else {

		$query= "INSERT INTO `contacts`(`firstname`, `lastname`, `email`, `message`) VALUES (:firstname,:lastname,:email, :message )";

      

             $data=[
                    'firstname'=>$firstname,
                    'lastname'=>$lastname,
                    'email'=>$email,
                    'message'=>$message, 
             ]; 
             $result = $contactDB->insert($query,$data);

                 if ($result=="MESSAGESENT") {
                     $success= "Message sent. We will contact to you soon as posibile"  ;
                         
                          // header("Location: contact.php");     

                 }
                  else  if($result=="FAILED") {
                    $errors="message not send due to some reason try again later";   
                 }     
	}
}


 ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>

             <?php if (isset($errors) or isset($success)): ?>
             	<p style="text-align: center; color: red;"><?= $errors ;?></p>
             	<p style="text-align: center; color: green;"><?= $success ;?></p>
             <?php endif ?>
			<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text"  name="firstname" placeholder="Enter first name" />
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name" />
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="email" name="email"  placeholder="Enter Email Address" />
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea placeholder="write a message" name="message"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>

					<td>
					<input type="submit"  name="sendcontact" value="Send message"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

		</div>
		 <!-- right sidebar-->
		<?php include_once './inc/rightsidebar.php'; ?>


	</div>


<!-- footer -->
	<?php include_once './inc/footer.php'; ?>