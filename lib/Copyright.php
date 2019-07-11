<?php 

class Copyright {

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
 


 

  public function update($query,$data)
  {

  	$sth =  $this->pdo->prepare($query);
    $sth->bindValue(":copyright",$data['copyright'],PDO::PARAM_STR); 
    $sth->bindValue(":copyrightid",$data['copyrightid'],PDO::PARAM_STR);
  	$sth->execute();
  	  if ($sth->rowCount()>0) {
  	  	 return "COPYRIGHTED";
  	  }  

  }



}



 ?>

 