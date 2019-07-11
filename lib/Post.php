<?php  

class Post  
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

  public  function insert($query,$data)
  {
   	$sth =  $this->pdo->prepare($query);  
  	$sth->bindValue(":title",$data['title'],PDO::PARAM_STR);
  	$sth->bindValue(":body",$data['body'],PDO::PARAM_STR);
  	$sth->bindValue(":cat",$data['cat'],PDO::PARAM_STR); 
  	$sth->bindValue(":images",$data['images'],PDO::PARAM_STR);
  	$sth->bindValue(":author",$data['author'],PDO::PARAM_STR); 
  	$sth->bindValue(":tag",$data['tag'],PDO::PARAM_STR);
  	$sth->execute();
  	  if ($sth->rowCount()>0) {
  	  	return "INSERTED";
  	 
  	  }
  }


  public function edit($query,$post_id)
  {
    	$sth =  $this->pdo->prepare($query);
  	$sth->bindValue(":edit_id",$post_id,PDO::PARAM_INT);
  	$sth->execute();
  	  if ($sth->rowCount()>0) {
  	  	$row = $sth->fetch(PDO::FETCH_ASSOC);
  	  	return $row;
  	  }  
  }

  public function updateWithOutImage($query, $data)
  {
    
    $sth =  $this->pdo->prepare($query);  
    
    $sth->bindValue(":title",$data['title'],PDO::PARAM_STR);
    $sth->bindValue(":cat",$data['cat'],PDO::PARAM_STR);
    $sth->bindValue(":body",$data['body'],PDO::PARAM_STR); 
    $sth->bindValue(":author",$data['author'],PDO::PARAM_STR);
    $sth->bindValue(":tag",$data['tag'],PDO::PARAM_STR);
    $sth->bindValue(":postid",$data['id'],PDO::PARAM_INT);
    $sth->execute();
      if ($sth->rowCount()>0) {
        return "UPDATED";
     
      }
  }

  public function updateWithNewImage($query,$data)
  {
    // print_r($data);die;   

  	$sth =  $this->pdo->prepare($query);  
    
    $sth->bindValue(":title",$data['title'],PDO::PARAM_STR);
    $sth->bindValue(":cat",$data['cat'],PDO::PARAM_STR);
    $sth->bindValue(":body",$data['body'],PDO::PARAM_STR);
    $sth->bindValue(":images",$data['images'],PDO::PARAM_STR); 
    $sth->bindValue(":author",$data['author'],PDO::PARAM_STR);
    $sth->bindValue(":tag",$data['tag'],PDO::PARAM_STR);
    $sth->bindValue(":postid",$data['id'],PDO::PARAM_INT);
    $sth->execute();
      if ($sth->rowCount()>0) {
        return "UPDATED";
     
      }
  }

  public function getImgToDelete($query,$id)
  {
      $sth =  $this->pdo->prepare($query);
      $sth->bindValue(":deleteImg_id",$id,PDO::PARAM_INT); 
        $sth->execute();
          if ($sth->rowCount()>0) {
             $row = $sth->fetch(PDO::FETCH_ASSOC);
             return $row;
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