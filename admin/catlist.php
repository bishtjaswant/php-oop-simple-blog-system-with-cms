<?php require_once '../config/config.php'; ?>
<?php require_once '../lib/Database.php' ?>
<?php require_once '../lib/Category.php' ?>


<?php 
$db= new Database();
$categoryDB = new Category();
 ?>

<?php include_once './inc/header.php'; ?>

<?php include_once './inc/sidebar.php'; ?>
         
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<!-- <th>Serial No.</th> -->
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                           $query= "SELECT * FROM `categories` ORDER BY `id` DESC ";
                           $categories = $db->select($query);

						 ?>
					 
					 
					 
						<?php foreach ($categories as $category): ?>
                  
							<tr class="even gradeC"> 
							<td><?= strtoupper($category['name']) ?> </td>
							<td>
								<a href="addcat.php?action=edit&edit_id=<?=$category['id'] ?>">Edit </a> ||

 
                              <a onclick="  
                                  if (confirm('delete rercord.....')) {
                                  	return true;
                                  } else {
                                  	return false;
                                  }
                              " href="catlist.php?action=delete&delete_id=<?=$category['id'] ?>">Delete</a> 

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
    	$query = "DELETE FROM `categories` WHERE `id`=:delete_id ";
        $result = $categoryDB->delete($query,$delete_id);
        if ($result==="DELETED") {
        	  echo "<script>window.alert('category  deleted ');</script>";
              echo "<script>window.location.assign('http://localhost/PhpOopBlog/admin/catlist.php');</script>";
        }
    }  
 ?>