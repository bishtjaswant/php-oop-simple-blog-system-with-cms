<?php 

class User 
{

  private $pdo=null;

  public function __construct()
  {
  	require_once '../lib/Database.php';
     $db= new Database();
     $this->pdo =  $db->connectDB();
  }


  public function index($query)
  {    
  
        $sth =  $this->pdo->prepare($query); 
      $sth->execute();
        if ($sth->rowCount()>0) {
          $row= $sth->fetchAll(PDO::FETCH_ASSOC);
          return $row;
        } 
  }
    public function  myProfile($query,$id)
  {    
  
        $sth =  $this->pdo->prepare($query); 
        $sth->bindValue('uid',$id,PDO::PARAM_STR);
      $sth->execute();
        if ($sth->rowCount()>0) {
          $row= $sth->fetch(PDO::FETCH_ASSOC);
          return $row;
        } 
  }

  public  function insert($query,$data)
  {
   // (:username,:useremail, :userpassword,:userrole )
  	$sth =  $this->pdo->prepare($query);
    $sth->bindValue(":username",$data['username'],PDO::PARAM_STR);
    $sth->bindValue(":useremail",$data['useremail'],PDO::PARAM_STR);
    $sth->bindValue(":userpassword",$data['userpassword'],PDO::PARAM_STR);  
    $sth->bindValue(":userrole",$data['userrole'],PDO::PARAM_STR); 
  	$sth->execute();
  	  if ($sth->rowCount()>0) {
  	  	return "INSERTED";
  	  } else {
  	  	return "FAILED";
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



 ?>