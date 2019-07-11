<?php 
 
class Contact
{
    
  private $pdo=null;

  public function __construct()
  {
   require_once $_SERVER['DOCUMENT_ROOT'].'/PhpOopBlog/lib/Database.php';
  	// require_once '../lib/Database.php';
     $db= new Database();
     $this->pdo =  $db->connectDB();
  }

 
 public function unseenMessage($query)
 {
    $sth =  $this->pdo->prepare($query);
    $sth->execute();
    $row= $sth->rowCount();
    return $row;
        
 }

 public function getRecipientMessage($query,$id)
 {
   
    $sth =  $this->pdo->prepare($query);
    $sth->bindValue(":recipientid", $id, PDO::PARAM_STR);
    $sth->execute();
     if ($sth->rowCount()>0) {
       $row= $sth->fetch(PDO::FETCH_ASSOC);
            return $row;
     }
 }
 
 public function messageSeenByAdmin($query,$recipientid,$currentLoggedInUser) {
    $sth =  $this->pdo->prepare($query);
    $sth->bindValue(":recipientid", $recipientid, PDO::PARAM_STR);
    $sth->bindValue(":readby", $currentLoggedInUser, PDO::PARAM_STR);
    $sth->bindValue(":seen",1, PDO::PARAM_INT);
    $sth->execute();
     if ($sth->rowCount()>0) {
  
            return "ok";
     }
 }
   public  function insert($query,$data)
  {
  
  	$sth =  $this->pdo->prepare($query);
    $sth->bindValue(":firstname",$data['firstname'],PDO::PARAM_STR);
    $sth->bindValue(":lastname",$data['lastname'],PDO::PARAM_STR);
    $sth->bindValue(":email",$data['email'],PDO::PARAM_STR);
  	$sth->bindValue(":message",$data['message'],PDO::PARAM_STR);
  	$sth->execute();
  	  if ($sth->rowCount()>0) {
  	  	return "MESSAGESENT";
  	  } else {
  	  	return "FAILED";
  	  }
  }

  public function select($query)
  {
    $sth =  $this->pdo->prepare($query);
      $sth->execute();
        if ($sth->rowCount()>0) {
          $row= $sth->fetchAll(PDO::FETCH_ASSOC);
          return $row;
        } 
  }




  public function edit($query,$category_id)
  {
      $sth =  $this->pdo->prepare($query);
    $sth->bindValue(":category_id",$category_id,PDO::PARAM_INT);
    $sth->execute();
      if ($sth->rowCount()>0) {
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        return $row;
      }  
  }

  public function update($query,$name,$edit_id)
  {
    // print_r($edit_id);die;
        $sth =  $this->pdo->prepare($query);
    $sth->bindValue(":name",$name,PDO::PARAM_STR);
    $sth->bindValue(":edit_id",$edit_id,PDO::PARAM_INT);
    $sth->execute();
      if ($sth->rowCount()>0) {
         return "UPDATED";
      }  

  }

  public function delete($query,$delete_id)
  {    

    $sth =  $this->pdo->prepare($query); 
    $sth->bindValue(":delete_id",$delete_id,PDO::PARAM_INT);
    $sth->execute();
      if ($sth->rowCount()>0) {
         return "DELETED";
      }  
    
  }


}