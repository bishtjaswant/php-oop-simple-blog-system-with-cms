<?php include_once './inc/header.php'; ?>
 <?php include_once './inc/sidebar.php' ?>

<?php require_once '../config/config.php'; ?>
<?php require_once '../lib/Password.php' ?>
<?php require_once '../helpers/format.php' ?>



<?php 
$passwordDB = new Password();
$format = new Format(); ?>


 <?php 

 if (isset($_POST['updatepassword'])) {
               $oldpassword= $format->validation($_POST['oldpassword']);
               $newpassword= $format->validation($_POST['newpassword']);
               $confirmnewpassword= $format->validation($_POST['confirmnewpassword']);
               $errormessage="";
               $successmessage="";

               if (empty($oldpassword)||empty($newpassword)||empty($confirmnewpassword)) {
                        $errormessage= '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> all field is required </p>';   
               } else {
                   // check user's oold password

                   $userID = Session::get("userID");
                   $query="SELECT `password` FROM `admins` WHERE `id`=:userid";
                   $result= $passwordDB->getPassword($query,$userID);

                   // compare password with saved password
                     if (! password_verify($oldpassword, $result['password'])) {
                           $errormessage= '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> incorect old password </p>';  
                     }
                        // length of password
                     elseif ($newpassword <=5) {
                               $errormessage= '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> weak password.. must be greater then 5 characters long </p>';  
                     }
                       // compare new password with confirm new password
                     elseif ($newpassword!=$confirmnewpassword) {
                          $errormessage= '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> password does not matched </p>';  
                     } else{
                        // finally save new password

 $query="UPDATE `admins` SET `password`=:newpassword WHERE `id`=:userid";

                                 $data=[
                                        'newpassword'=>password_hash($newpassword,PASSWORD_BCRYPT) ,
                                        'userid'=>$userID,
                                 ]; 
                                 $result = $passwordDB->update($query,$data);
                                       
                                       if ($result=="UPDATED") {
                                             $errormessage= '<p style="color:green;text-align: center; font-size: 1.1rem;font-weight: 200;"> password changed successfully. please do re-login to activate it </p>';  
                                       } else {
                                           $errormessage= '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> could not change password. try again later </p>';    
                                       }


                     }
               }
 }  
  ?>
 


        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Change Password</h2>
                <div class="block">

                <?php if (isset($errormessage)): ?>  <?= $errormessage ?>  <?php endif ?>               
                 <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>"  >
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Old Password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Enter Old Password..."  name="oldpassword" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>New Password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Enter New Password..." name="newpassword" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Confirm New Password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Enter New Password..." name="confirmnewpassword" class="medium" />
                            </td>
                        </tr>
						 
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="updatepassword" Value="Save Changes" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
 
 <?php include_once './inc/footer.php'; ?>
