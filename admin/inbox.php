<?php include_once './inc/header.php'; ?>
<?php require_once '../lib/Database.php' ?>
<?php require_once '../lib/Contact.php'; ?>
 <?php include_once './inc/sidebar.php' ?>


<?php 
$format=  new Format();
$db= new Database();
$contactDB = new Contact();


 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Recipient name</th>
							<th>Message</th>
		 					<th>Action</th>
						</tr>
					</thead>
					<tbody>
					

                   	<?php 
                           $query= "SELECT * FROM `contacts` ORDER BY `id` DESC ";
                           $contacts = $contactDB->select($query);
					 ?>
					 
						<?php foreach ($contacts as $contact): ?>
							<tr class="even gradeC">
								<td> <?= $contact['id'] ?> </td>
							<td><?= $contact['firstname'] .' '. $contact['lastname']; ?></td>
							<td><span  id="readmore" style="text-decoration: none;" ><?= $format->shortParagraph($contact['message'] ,40) ?></span> </td>
							<td>
								<!-- <a href="">Edit</a> || -->

							    <a onclick="  
                                  if (confirm('delete rercord.....')) {
                                  	return true;
                                  } else {
                                  	return false;
                                  }
                              " href="inbox.php?action=delete&delete_id=<?=$contact['id'] ?>" >Delete</a>
                              ||

  <a href="readmsg.php?action=read&msg_id=<?=$contact['id'] ?>">
        <?php if ($contact['seen']==1): ?>
               <span style="color:green;"> Read</span> 
        <?php else: ?>
                 <span style="color:red;"> Read</span> 
        <?php endif ?>
     </a>
                        
                 
							</td>
						</tr>
						<?php endforeach ?>
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
    	$query = "DELETE FROM `contacts` WHERE `id`=:delete_id ";
        $result = $contactDB->delete($query,$delete_id);
        if ($result==="DELETED") {
        	  echo "<script>window.alert('message  deleted ');</script>";
              echo "<script>window.location.assign('http://localhost/PhpOopBlog/admin/inbox.php');</script>";
        }
    }  
 ?>
