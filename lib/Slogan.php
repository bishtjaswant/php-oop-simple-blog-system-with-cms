<?php 



/**
 * summary
 */
class Slogan{

	    private $pdo=null;
  

  public function __construct()
  {
  
   require_once $_SERVER['DOCUMENT_ROOT']."/PhpOopBlog/config/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'].'/PhpOopBlog/lib/Database.php';
  
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


/*
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
  }*/


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
    $sth->bindValue(":slogan",$data['slogan'],PDO::PARAM_STR); 
    $sth->bindValue(":sloganid",$data['id'],PDO::PARAM_INT);
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
    $sth->bindValue(":slogan",$data['slogan'],PDO::PARAM_STR); 
    $sth->bindValue(":logo",$data['logo'],PDO::PARAM_STR); 
    $sth->bindValue(":sloganid",$data['id'],PDO::PARAM_INT);
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

 ?>