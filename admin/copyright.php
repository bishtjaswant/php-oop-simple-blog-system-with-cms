 <?php include_once './inc/header.php'; ?>
 <?php include_once './inc/sidebar.php' ?>

 <?php include_once '../lib/Copyright.php' ?>
 <?php $copyrightDB= new Copyright();
 $format= new  Format() ?>


        <div class="grid_10">
		
            <div class="box round first grid">


<?php 
// update copyright

   if (isset( $_POST['updatecopyright'])  ) {

        $copyrightid = $format->validation($_POST['copyrightid']);        
        $copyright = strtoupper( $format->validation($_POST['copyright']) );  

        if (  empty($copyright)   ) {
                echo '<p style="color:red;font-size: 1.1rem;font-weight: 200;"> enter copyright title  </p>';   
         }else { 

            $query="UPDATE `copyright` SET `name`=:copyright WHERE `id`=:copyrightid";

             $data=[
                    'copyright'=>$copyright, 
                    'copyrightid'=>$copyrightid,
             ]; 
             $result = $copyrightDB->update($query,$data);

                 if ($result=="COPYRIGHTED") {
                     echo '<p style="color:green;font-size: 1.1rem;font-weight: 200;"> COPYRIGHT PUBLISHED....</p>';   
                 }
                  else  if($result=="FAILED") {
                     echo '<p style="color:red;font-size: 1.1rem;font-weight: 200;">FAILED </p>';   
                 }                 
        }
}  

 ?>

 

                <?php 
                    $query= "SELECT * FROM `copyright`";
                    $result= $copyrightDB->index($query);
                 ?> 


                <h2>Update Copyright Text</h2>
                <div class="block copyblock"> 
                 <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" >
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Copyright Text..." name="copyright" value="<?= $result['name'] ?>" class="large" />
                            </td>
                        </tr>
						<input type="hidden" style="display: none;" name="copyrightid" value="<?=  $result['id'] ?>">
						 <tr> 
                            <td>
                                <input type="submit" name="updatecopyright" Value="Update" />
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
