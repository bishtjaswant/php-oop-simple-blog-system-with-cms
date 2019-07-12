<?php 

class Password 
{

  private $pdo=null;

  public function __construct()
  {
  	require_once '../lib/Database.php';
     $db= new Database();
     $this->pdo =  $db->connectDB();
  }


  public function getPassword($query,$userID)
  {    
  
        $sth =  $this->pdo->prepare($query); 
        $sth->bindValue(":userid",$userID,PDO::PARAM_INT);

      $sth->execute();
        if ($sth->rowCount()>0) {
          $row= $sth->fetch(PDO::FETCH_ASSOC);
          return $row;
        } 
  }

 
 

  public function update($query,$data)
  {
  	// print_r($edit_id);die;
  	  	$sth =  $this->pdo->prepare($query);
  	$sth->bindValue(":newpassword",$data['newpassword'],PDO::PARAM_STR);
  	$sth->bindValue(":userid",$data['userid'],PDO::PARAM_INT);
  	$sth->execute();
  	  if ($sth->rowCount()>0) {
  	  	 return "UPDATED";
  	  }  

  }

 


}



 ?>