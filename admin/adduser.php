 <?php include_once './inc/header.php'; ?>
 <?php include_once './inc/sidebar.php' ?>

<?php require_once '../helpers/format.php' ?>
 <?php require_once '../lib/User.php' ?>

<?php 
 $userDB = new User(); 
$format= new Format();
?>

        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Add user for application</h2>

<?php 

if (isset($_POST['adduser'])) {
     
    $username = $format->validation($_POST['username']);
    $useremail = $format->validation($_POST['useremail']);
    $userpassword = $format->validation($_POST['userpassword']);
    $userrole = $format->validation($_POST['userrole']);
    $errormessage="";
    $successmessage="";

// filed val chek
        if (empty($username)|| empty($useremail)|| empty($userpassword)|| empty($userrole)   ) {
                $errormessage= '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> all field is required </p>';    
        }  
        elseif (!filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS)) {
              $errormessage= '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> Invalid user name </p>';    
        }
        elseif (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
              $errormessage= '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> Invalid email address </p>';    
        }
        elseif ($userpassword >5) {
              $errormessage= '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> weak password. password should  be 5 characters long </p>';    
        }
        else{
            $query= "INSERT INTO `admins` (`name`, `email`, `password`, `roles`) VALUES (:username,:useremail, :userpassword,:userrole )";

              $data= [
                    'username'=>$username,
                    'useremail'=>$useremail,
                    'userpassword'=>password_hash($userpassword, PASSWORD_BCRYPT), 
                    'userrole'=>$userrole
              ];
             $result= $userDB->insert($query, $data);

            if ($result=="INSERTED") {
                 $successmessage='<p style="color:green;text-transform: uppercase; text-align: center; font-size: 1.1rem;font-weight: 200;"> user created </p>';
               
            } else {
                 $errormessage='<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> query failed </p>';
            }
         
        }

}



 ?>
                <div class="block">               
                 <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >
                   <?php if (isset($errormessage)): ?> <?= $errormessage ?> <?php endif ?>
                   <?php if (isset($successmessage)): ?> <?= $successmessage ?> <?php endif ?>
                    <table class="form">                      
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter username" class="medium" value="<?=@$username ?>" />
                            </td>
                            </tr>

                          <tr>
                            <td>
                                <label>User email</label>
                            </td>
                            <td>
                                <input type="email" name="useremail" placeholder="Enter user email address"  value="<?=@$useremail ?>" class="medium" />
                            </td>
                        </tr>
                     


                          <tr>
                            <td>
                                <label>User password</label>
                            </td>
                            <td>
                                <input type="password" name="userpassword" placeholder="Enter user password" class="medium" />
                            </td>
                        </tr>



                          <tr>
                            <td>
                                <label>User role</label>
                            </td>
                            <td>
                               <select name="userrole" >
                                   <option value="">Select user role</option>
                                   <option value="admin">admin</option> 
                                   <option value="author">author</option> 
                                   <option value="editor">editor</option> 
                               </select>
                            </td>
                        </tr>
                     
                                           
                     

                   
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="adduser" Value="Create User" />
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
