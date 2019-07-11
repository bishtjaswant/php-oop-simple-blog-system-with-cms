<?php include_once './inc/header.php'; ?>
 <?php include_once './inc/sidebar.php' ?>

 <?php include_once '../lib/SocialMedia.php' ?>
 <?php $socialmediaDB= new SocialMedia();
 $format= new  Format() ?>


       <div class="grid_10">
        


            <div class="box round first grid">
                <h2>Update Social Media</h2>

                <?php 

// update social media link

   if (isset( $_POST['addsocial'])  ) {

        $social_media_id = $format->validation($_POST['social_media_id']);        
        $fb= $format->validation($_POST['fb']); 
        $gl= $format->validation($_POST['gl']); 
        $tw= $format->validation($_POST['tw']); 
        $insta= $format->validation($_POST['insta']); 
        $githup= $format->validation($_POST['githup']); 

        if (  empty($fb) ||  empty($gl) ||  empty($tw) || empty($githup) ||  empty($insta)   ) {
                echo '<p style="color:red;font-size: 1.1rem;font-weight: 200;"> these social media link must not be empty </p>';   
         }else { 

            $query="UPDATE `social_media` SET `fb`=:fb,`insta`=:insta,`tw`=:tw,`gl`=:gl,`githup`=:githup WHERE `id`=:socialid";

             $data=[
                    'fb'=>$fb,
                    'gl'=>$gl,
                    'tw'=>$tw,
                    'insta'=>$insta,
                    'githup'=>$githup,
                    'socialid'=>$social_media_id,
             ]; 
             $result = $socialmediaDB->update($query,$data);

                 if ($result=="LINKUPDATED") {
                     echo '<p style="color:green;font-size: 1.1rem;font-weight: 200;">Social media link updated....</p>';   
                 }
                  else  if($result=="FAILED") {
                     echo '<p style="color:red;font-size: 1.1rem;font-weight: 200;">FAILED </p>';   
                 }                 
        }
}  

 ?>

 

                <?php 
                    $query= "SELECT * FROM `social_media`";
                    $result= $socialmediaDB->index($query);
                 ?> 

                <div class="block">               
                 <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" placeholder="Facebook link.." class="medium" value="<?=$result['fb']; ?>" />
                            </td>
                        </tr>

                        <input type="hidden" name="social_media_id" value="<?=$result['id'] ?>">
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" placeholder="Twitter link.." class="medium" value="<?=$result['tw']; ?>" />
                            </td>
                        </tr>
				 
						 <tr>
                            <td>
                                <label>Google's gmail</label>
                            </td>
                            <td>
                                <input type="text" name="gl" placeholder="Google email link.." class="medium" value="<?=$result['gl']; ?>" />
                            </td>
                        </tr>
						
                         <tr>
                            <td>
                                <label>Instagram</label>
                            </td>
                            <td>
                                <input type="text" name="insta" placeholder="Google email link.." class="medium" value="<?=$result['insta']; ?>" />
                            </td>
                        </tr>


                         <tr>
                            <td>
                                <label>Github</label>
                            </td>
                            <td>
                                <input type="text" name="githup" placeholder="Github link....." class="medium" value="<?=$result['githup']; ?>" />
                            </td>
                        </tr>
                        
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="addsocial" Value="Update" />
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
