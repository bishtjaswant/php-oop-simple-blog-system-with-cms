<?php include_once './inc/header.php'; ?>
 <?php include_once './inc/sidebar.php'; ?>

 <?php include_once '../lib/Slogan.php' ?>
 <?php $sloganDB= new Slogan();
 $format= new  Format() ?>

 <style>
     .leftside{float: left;width: 70%;}
     .rightside{float: left;width: 30%;}
     .rightside img{width: 125px;height: 225px;}
 </style>



<?php 

if (isset($_POST['updateslogan'])) {

    $edit_slogan_id = $_POST['edit_slogan_id'];
    $title = $format->validation($_POST['title']);
    $slogan = $format->validation($_POST['slogan']);

                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['logo']['name'];
                $file_size = $_FILES['logo']['size'];
                $file_temp = $_FILES['logo']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "logo/". $unique_image;

          if (empty($title)|| empty($slogan) ) {
                echo '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> all field is requied </p>';    
        }   

if (!empty($file_name)) {

        // file size check
        if ($file_size>5000000) {
              echo '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> logo size not greater then 5 mb </p>';  
        }
        // file ext
        elseif (!in_array($file_ext,$permited)) {
              echo '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> only jpg,png, jpeg file are  allowed to upload</p>';  
        }
        else{

           $query= "UPDATE `slogan` SET `title`=:title,`slogan`=:slogan,`logo`=:logo WHERE `id`=:sloganid "; 
         
              $data= [
                    'title'=>$title,
                    'slogan'=>$slogan,
                    'logo'=>$unique_image,
                    'id'=>$edit_slogan_id
              ];


               // this query for deleting previious log
                $del_query= "SELECT `logo` FROM `slogan`  WHERE `id`=:deleteImg_id";
                $result= $sloganDB->getImgToDelete($del_query,$edit_slogan_id);

                // print_r($result);
              if (file_exists("logo/".$result['logo']) ) {

                    // deleting old img
                    unlink("logo/".$result['logo']);

                    } else {
                  echo "<script>window.alert('logo does not exists');</script>";
                    
                 }


             $result= $sloganDB->updateWithNewImage($query, $data);

            if ($result=="UPDATED") {
                            // uplad new one
                          move_uploaded_file($file_temp, $uploaded_image);
                          echo "<script>window.alert('slogan updated');</script>";
                              echo "<script>window.location.assign('http://localhost/PhpOopBlog/admin/titleslogan.php');</script>";       
     
               
            } else {
                 echo "<script>window.alert('query failed');</script>";   
            }
        

        }


    }else {
        // if user does not uploan logos

           $query= "UPDATE `slogan` SET `title`=:title,`slogan`=:slogan WHERE `id`=:sloganid "; 
             
              $data= [
                    'title'=>$title,
                    'slogan'=>$slogan,
                    'id'=>$edit_slogan_id
              ];
 
             $result= $sloganDB->updateWithOutImage($query, $data);

            if ($result=="UPDATED") { 
                 echo "<script>window.alert('slogan updated');</script>";
                           echo "<script>window.location.assign('http://localhost/PhpOopBlog/admin/titleslogan.php');</script>";       
         
            } else {
                 echo "<script>window.alert('query failed');</script>";   
            }
                
    }

} 


 ?>
 





        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <div class="block sloginblock">          

                <?php 
                    $query= "SELECT * FROM `slogan`";
                    $result= $sloganDB->index($query);


                 ?> 

               <?php foreach ($result as $salogan): ?>
                          <div class="leftside">
                     <form method="post" enctype="multipart/form-data" action="titleslogan.php">
                    <table class="form">                    
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Website Title..."  name="title" class="medium" value="<?=$salogan['title'] ?>" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Website Slogan..." name="slogan" class="medium" value="<?=$salogan['slogan'] ?>" />
                            </td>
                        </tr>

                        <input value="<?=$salogan['id'] ?>" type="hidden"  name="edit_slogan_id">

                             <tr>
                            <td>
                                <label>Upload Website logo</label>
                            </td>
                            <td>
                                <input type="file"  name="logo" class="medium" />
                            </td>
                        </tr>
                         
                        
                         <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="updateslogan" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>

                 </div>
                 <div class="rightside">
                     <img src="./logo/<?=$salogan['logo'] ?>" alt="<?=$salogan['title'] ?>">
                 </div>
                     <?php endforeach ?>    
                
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">
       <p>
         &copy; Copyright <a href="http://trainingwithliveproject.com">Training with live project</a>. All Rights Reserved.
        </p>
    </div>
</body>
</html>
