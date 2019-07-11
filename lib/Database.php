<?php
Class Database{
	public $host   = DB_HOST;
	public $user   = DB_USER;
	public $pass   = DB_PASS;
	public $dbname = DB_NAME;
	public $pdo=null;
	public $error;
	
	public function __construct(){
		$this->connectDB();
	}
	
	public function connectDB(){
		 
		 try {
$this->pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->pass);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			// echo 'ok';
			return $this->pdo;		 	
		 } catch (PDOException $e) {
		 	die("connection failed.......". $e->getMessage());
		 }

   }
	
	// Select or Read data
	
	public function select($query){

		$sth = $this->pdo->prepare($query);
         if ($sth->execute()) {
         	 $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            return  $rows;
         }
		 
	}


	public function executeRow($query,$id)
	{
		$sth = $this->pdo->prepare($query);
		$sth->bindParam(":id",$id );
		$sth->execute();
		if ($sth->rowCount()>0) {
			$row= $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
	}


	public function searchQuery($query,$keyword)
	{
		$sth = $this->pdo->prepare($query);
	      $keyword = "%".$keyword."%";
          $sth->bindParam(':title', $keyword, PDO::PARAM_STR);
          $sth->bindParam(':body', $keyword, PDO::PARAM_STR);
          $sth->execute();
          $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
         return $rows;
	}


	public function numberOfRow($query)
	{
		
		$sth = $this->pdo->prepare($query);
         if ($sth->execute()) {
         	 $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            return  $sth->rowCount();
         }
	}
	
	// Insert data
 
  
    // Update data
 
  
  // Delete data
  
  public  function credential($query,$email)
  {

  	$sth = $this->pdo->prepare($query);
  	$sth->execute([':email'=>$email]);
  	    if ($sth->rowCount()>0) {
  	    	$row = $sth->fetch(PDO::FETCH_ASSOC);
  	    	return $row;
  	    } else {
  	    	return "INVALID_EMAIL";
  	    }
  }

 

 
 
}

