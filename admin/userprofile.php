<?php include_once './inc/header.php'; ?>
 <?php include_once './inc/sidebar.php';  ?>

 <?php require_once '../config/config.php'; ?> 
<?php require_once '../lib/User.php'; ?>
<?php require_once '../lib/Session.php'; ?>


<?php  
$profileDB = new User();
 ?>


<!-- userID -->

        <div class="grid_10">
            <div class="box round first grid">
                <h2>My Profile</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
          <thead>
            <tr>
              <!-- <th>Serial No.</th> -->
              <th>My Name</th>
              <th>My Email</th>
              <th>My Role</th>
              <!-- <th>My Detail</th> -->
              
            </tr>
          </thead>
          <tbody>
       
           <tr class="even gradeC">

            <?php 
             $query="SELECT * FROM `admins` WHERE `id`=:uid";
             $id= Session::get('userID');
             $result= $profileDB->myProfile($query,$id);
             ?>
             <td><?= $result['name'] ?></td>
             <td><?= $result['email'] ?></td>
             <td><?= $result['roles'] ?></td>
          
           </tr>
          
                  
             

        

          </tbody>
        </table>
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>

    
   
   <?php include_once './inc/footer.php'; ?>
