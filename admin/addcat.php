
<?php include_once './inc/header.php'; ?>
 <?php include_once './inc/sidebar.php' ?>

 
<?php require_once '../config/config.php'; ?>
<?php require_once '../lib/Category.php' ?>
<?php require_once '../helpers/format.php' ?>
<?php 
$categoryDB = new Category();
$format = new Format(); ?>




        <div class="grid_10">
	

            <div class="box round first grid">

                <?php 
                     if (isset($_GET['edit_id']) && $_GET['action']=="edit") {
                           echo "  <h2>Update Category</h2>    "     ;     
                     } else {
                      echo "<h2>Add New Category</h2>";   
                     }

                 ?>
           
               <div class="block copyblock">
                
<?php 
// add new cxat form data
    if (isset( $_POST['addcategory'])  ) {
 
        if (empty(  $_POST['name']  )) {
                echo '<p style="color:red;font-size: 1.1rem;font-weight: 200;"> category field is requireed </p>';   
         }else {
             $catname= $format->validation($_POST['name']);
             $query= "INSERT INTO `categories`(`name`) VALUES (:name)";
             $result = $categoryDB->insert($query,$catname);

                 if ($result=="INSERTED") {
                     echo '<p style="color:green;font-size: 1.1rem;font-weight: 200;">Category added</p>';   
                 }
                  else  if($result=="FAILED") {
                     echo '<p style="color:red;font-size: 1.1rem;font-weight: 200;">FAILED </p>';   
                 }                 
        }
}  

  ?>




  <form method="post" action="<?=$_SERVER['PHP_SELF'] ?>">

<?php // edit request for categiry
if (  isset($_GET['edit_id']) && $_GET['action']=="edit") {
    $category_id = $_GET['edit_id'];
     $query= "SELECT `id`,`name` FROM `categories` WHERE `categories`.`id`=:category_id ";
    $result = $categoryDB->edit($query,$category_id);
     
} ?>
               
                    <table class="form">					
                        <tr>
                           <?php 
                             if (isset($_GET['edit_id']) &&  $_GET['action']=="edit") {
                                 echo ' <td>
                                <input  name="name" type="text" placeholder="Enter Category Name..." class="medium" value="'. $result['name'].'" />
                            </td>';

                            echo ' 
                                <input style="display:none"  name="catid" type="text" 
                                 value="'. $result['id'].'" />
                    
                            ';
                             } else {
                                 echo ' <td>
                                <input  name="name" type="text" placeholder="Enter Category Name..." class="medium" />
                            </td>';
                             }
                            ?>
                        </tr>
						<tr> 

                            <?php 
                                   if (isset($_GET['edit_id']) &&  $_GET['action']=="edit") {
                                       echo '   <td>
                                <input type="submit" name="savechanges" Value="Save changes" />
                            </td>';
                                   } else {
                                       echo '   <td>
                                <input type="submit" name="addcategory" Value="Save" />
                            </td>';
                                   }
                             ?>
                         
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

<?php 

// now updATE thhe cats

if (isset($_POST['savechanges'])){
    // $edit_id= $_GET['edit_id'];
    $catname= $_POST['name'];
    $edit_id= $_POST['catid'];
      $query= "UPDATE `categories` SET `name`=:name WHERE `id` =:edit_id ";
    $result = $categoryDB->update($query,$catname, $edit_id);

    if ($result=="UPDATED") {
        echo "<script>window.alert('category successfully updated');</script>";
        echo "<script>window.location.assign('http://localhost/PhpOopBlog/admin/catlist.php');</script>";

    }else {
        echo "<script>window.alert('query failed');</script>";
        
    }

}



 ?>