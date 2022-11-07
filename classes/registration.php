<?php
/**
 * 
 */
class Registration{
	private $conn;
	public $regID;
	public $firstname;
	public $lastname;
	public $school;
	public $grade;
	public $phone;
	public $email;
	public $regDate;
	public $limit;
	public $offset;
	public $keyword;
	
	function __construct($dbh){
		$this->conn = $dbh;
	}

	function add(){
		$query = "INSERT INTO registration SET firstname=?, lastname=?, school=?, grade=?, phone=?, email=?, regDate=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1,$this->firstname);
		$stmt->bindparam(2,$this->lastname);
		$stmt->bindparam(3,$this->school);
		$stmt->bindparam(4,$this->grade);
		$stmt->bindparam(5,$this->phone);
		$stmt->bindparam(6,$this->email);
		$stmt->bindparam(7,$this->regDate);
		$stmt->execute();
		return $stmt;
	}

	function nameCheck(){
		$query = "SELECT * FROM registration WHERE firstname=? and lastname=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1,$this->firstname);
		$stmt->bindparam(2,$this->lastname);
		$stmt->execute();
		return $stmt;
	}

	function update(){
		$query = "UPDATE registration SET firstname=?, lastname=?, school=?, grade=?, phone=?, email=?, regDate=? WHERE regID=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1,$this->firstname);
		$stmt->bindparam(2,$this->lastname);
		$stmt->bindparam(3,$this->school);
		$stmt->bindparam(4,$this->grade);
		$stmt->bindparam(5,$this->phone);
		$stmt->bindparam(6,$this->email);
		$stmt->bindparam(7,$this->regDate);
		$stmt->bindparam(8,$this->regID);
		$stmt->execute();
		return $stmt;
	}
	
	function view(){
		$query = "SELECT * FROM registration WHERE regID=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1,$this->regID);
		$stmt->execute();
		return $stmt;
	}

	function viewAll(){
		$query = "SELECT * FROM registration ORDER BY regID ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function pagination(){
		$query = "SELECT * FROM registration ORDER BY regID ASC LIMIT $this->offset, $this->limit";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function delete(){
		$query = "DELETE from registration WHERE regID=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1,$this->regID);
		$stmt->execute();
		return $stmt;
	}
	
	function searchAll(){
		$query = "SELECT * FROM registration WHERE firstname like '%".$this->keyword."%' or lastname like '%".$this->keyword."%' or phone like '%".$this->keyword."%' or email like '%".$this->keyword."%'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	function search(){
		$query = "SELECT * FROM registration WHERE (firstname like '%".$this->keyword."%' or lastname like '%".$this->keyword."%' or phone like '%".$this->keyword."%' or email like '%".$this->keyword."%') LIMIT $this->offset, $this->limit";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

}
?>