<?php
/**
* 
*/
class Database{
	private $host = "localhost";
	private $db = "dbDevSoc";
	private $user = "root";
	private $pass = "";
	public $dbh;

	public function getConnection(){
		$this->dbh = null;
		try{
			$this->dbh = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db, $this->user, $this->pass);
			// echo "connected";
		}
		catch(PDOException $ex){
			echo "Connection error: ". $ex->getMessage();
		}
		return $this->dbh;
	}
}

?>