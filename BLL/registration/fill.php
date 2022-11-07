<?php
//include all necessary resource files
include '../../config/database.php';
include '../../classes/registration.php';

//create a new object for accessing connection to the database
$database = new Database();
$db = $database->getConnection();

//create new object for accessing business layer logics
$reg = new Registration($db);

if (isset($_POST['id'])) {
	$reg->regID = $_POST['id'];
	$stmt = $reg->view();

	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	echo json_encode($row);

}

?>