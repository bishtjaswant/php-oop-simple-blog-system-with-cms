<?php 

class SocialMedia 
{

  private $pdo=null;

  public function __construct()
  {
   require_once $_SERVER['DOCUMENT_ROOT'].'/PhpOopBlog/lib/Database.php';
  	// require_once '../lib/Database.php';
     $db= new Database();
     $this->pdo =  $db->connectDB();
  }


  public function index($query)
  {    
  
        $sth =  $this->pdo->prepare($query); 
      $sth->execute();
        if ($sth->rowCount()>0) {
          $row= $sth->fetch(PDO::FETCH_ASSOC);
          return $row;
        } 
  }

/*  public  function insert($query,$data)
  {
  	// print_r($data);die;
  	$sth =  $this->pdo->prepare($query);
    $sth->bindValue(":fb",$data['fb'],PDO::PARAM_STR);
    $sth->bindValue(":tw",$data['tw'],PDO::PARAM_STR);
    $sth->bindValue(":gl",$data['gl'],PDO::PARAM_STR);
  	$sth->bindValue(":insta",$data['insta'],PDO::PARAM_STR);
  	$sth->execute();
  	  if ($sth->rowCount()>0) {
  	  	return "LINKADDED";
  	  } else {
  	  	return "FAILED";
  	  }
  }*/


/*  public function edit($query,$category_id)
  {
    	$sth =  $this->pdo->prepare($query);
  	$sth->bindValue(":category_id",$category_id,PDO::PARAM_INT);
  	$sth->execute();
  	  if ($sth->rowCount()>0) {
  	  	$row = $sth->fetch(PDO::FETCH_ASSOC);
  	  	return $row;
  	  }  
  }*/

  public function update($query,$data)
  {

  	$sth =  $this->pdo->prepare($query);
    $sth->bindValue(":fb",$data['fb'],PDO::PARAM_STR);
    $sth->bindValue(":tw",$data['tw'],PDO::PARAM_STR);
    $sth->bindValue(":gl",$data['gl'],PDO::PARAM_STR);
    $sth->bindValue(":insta",$data['insta'],PDO::PARAM_STR);
    $sth->bindValue(":githup",$data['githup'],PDO::PARAM_STR);
    $sth->bindValue(":socialid",$data['socialid'],PDO::PARAM_STR);
  	$sth->execute();
  	  if ($sth->rowCount()>0) {
  	  	 return "LINKUPDATED";
  	  }  

  }
/*
  public function delete($query,$delete_id)
  { 	 

  	$sth =  $this->pdo->prepare($query); 
  	$sth->bindValue(":delete_id",$delete_id,PDO::PARAM_INT);
  	$sth->execute();
  	  if ($sth->rowCount()>0) {
  	  	 return "DELETED";
  	  }  
  	
  }*/


}



 ?>