<?php require_once '../config/config.php'; ?>
<?php require_once '../lib/Database.php' ?>
<?php require_once '../lib/User.php' ?>


<?php 
$db= new Database();
$userDB = new User();
 ?>

<?php include_once './inc/header.php'; ?>

<?php include_once './inc/sidebar.php'; ?>
         
        <div class="grid_10">
            <div class="box round first grid">
                <h2>All Registered User List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
              <th>User Name</th>
              <th>User Email</th>
							<th>User Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                           $query= "SELECT * FROM `admins` ORDER BY `id` DESC ";
                           $users = $userDB->index($query);

						 ?>
					 
					 
					 
						<?php foreach ($users as $user): ?>
                  
							<tr class="even gradeC"> 
                <td> <?= $user['id'] ?>  </td>
              <td><?= strtoupper($user['name']) ?> </td>
              <td><?= strtoupper($user['email']) ?> </td>
							<td><?= strtoupper($user['roles']) ?> </td>
							<td>
						 
                              <a onclick="  
                                  if (confirm('delete rercord.....')) {
                                  	return true;
                                  } else {
                                  	return false;
                                  }
                              " href="userlist.php?action=delete&delete_id=<?=$user['id'] ?>">Delete</a> 

						</tr>

						<?php  endforeach ?>

					</tbody>
				</table>
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
   
   <?php include_once './inc/footer.php'; ?>
  

<?php 
// deleting cats
    if (isset($_GET['delete_id']) && $_GET['action']=="delete") {
    	$delete_id= $_GET['delete_id'];
    	$query = "DELETE FROM `admins` WHERE `id`=:delete_id ";
        $result = $userDB->delete($query,$delete_id);
        if ($result==="DELETED") {
        	  echo "<script>window.alert('user  deleted ');</script>";
              echo "<script>window.location.assign('http://localhost/PhpOopBlog/admin/userlist.php');</script>";
        }
    }  
 ?>