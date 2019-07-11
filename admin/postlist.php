<?php include_once './inc/header.php'; ?>
 <?php include_once './inc/sidebar.php' ?> 
<?php require_once '../helpers/format.php' ?>
<?php require_once '../lib/Post.php' ?>

<?php $postDB = new Post(); 
$format= new Format();
?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Post Title</th>
							<th>Description</th>
							<th>Author</th>
							<th>Image</th>
							<th>Posted at</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody> 

                             

                             <?php 
								$query="SELECT * FROM `posts` ORDER BY `id` DESC ";
								$result = $postDB->index($query);
                                ?>  
                                   
                                   <?php if (isset($result)): ?>
                                   	  <?php foreach ($result as $post): ?>
				                         	<tr class="odd gradeX">
											<td><?= $post['title'] ?></td>
											<td><?= $format->shortParagraph($post['title'] ) ?></td>
											<td><?= $post['author'] ?></td>
											<td class="center"> 
				                                   <img src="./upload/<?=$post['images'] ?>" width="40" height="40" alt="<?= $post['title'] ?>">
											</td>
											<td> <?= $format->formateDate($post['postedat']) ?> </td>
											<td>

												<a href="editpost.php?action=edit_post&edit_id=<?= $post['id'] ?>">Edit</a> || 

												<a onclick="
												if (confirm('want to delete this post ?')) {
													return true;
												} else {
													return false;
												}
                                      		 " href="<?= $_SERVER['PHP_SELF'] ?>?action=deletePost&delete_id=<?=$post['id'] ?>">Delete</a></td>
										
										</tr>
                                          <?php endforeach ?>
                                   <?php else: ?>
               <p style="color:red;text-align: center;text-transform: uppercase; font-size: 1.1rem;font-weight: 200;"> no post in db </p>
                                   <?php endif ?>
						
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
    if (isset($_GET['delete_id']) && $_GET['action']=="deletePost") {
    	  
   	  $delete_id= $_GET['delete_id'];
      $deleteQuery="SELECT `images` from `posts` where `id`=:deleteImg_id " ;
      $result=  $postDB->getImgToDelete($deleteQuery,$delete_id);
                // delete user's photiimages
              print_r($result['images']);
             if (file_exists("upload/".$result['images']) ) {
             	unlink("upload/".$result['images']);
             	$query = "DELETE FROM `posts` WHERE `id`=:delete_id ";
			        $result = $postDB->delete($query,$delete_id);
			        if ($result==="DELETED") {
			            echo "<script>window.alert('post  deleted ');</script>";
			              echo "<script>window.location.assign('http://localhost/PhpOopBlog/admin/postlist.php');</script>";       

			        }
             }else {
			            echo "<script>window.alert('file does not exist ');</script>";
             	
             }

    	
    }  
 ?>
