<?php include_once './inc/header.php'; ?>
<?php include_once './inc/sidebar.php';  ?>
<?php require_once '../lib/Contact.php'; ?>

 

<?php 

$format=  new Format(); 
$contactDB = new Contact();


// get recipiennt id

 if (isset($_GET['msg_id'])  && $_GET['action']=="read") {
     $recipientid = $_GET['msg_id'];
     // update status
    $currentLoggedInUser= Session::get('username');

    $query="UPDATE `contacts` SET `readby`=:readby,`seen`=:seen WHERE `id`=:recipientid";
    $result= $contactDB->messageSeenByAdmin($query,$recipientid,$currentLoggedInUser);
    if ($result=='ok') {
      $message="message seen";
    }





   
    $message="";
    $query =  "SELECT * FROM `contacts`  WHERE `id`=:recipientid";
    $result= $contactDB->getRecipientMessage($query,$recipientid);

    





 }else {
   header("Location:index.php");
 }
 ?>


        <div class="grid_10">
		
            <div class="box round first grid">
            
                <h2> Read Messsage   </h2>
                <div class="block">               
                  <h3><?= $result['firstname'] ?>  <?= $result['lastname'] ?>  </h3> <br> <hr>
                  <p> <strong><?= $result['firstname'] ?>'s message : </strong> <br>
                   <?= $result['message'] ?>   </p>      
                </div>
<br>
<br>
<br>
                <a style="padding: 5px;text-transform: uppercase;m margin-top: 12px; width: 100px;height: 25px; background-color: blue; color: white; border-radius: 8px;" href="inbox.php" >back</a>
                          </div>
        </div>
   
   <?php include_once './inc/footer.php'; ?>
