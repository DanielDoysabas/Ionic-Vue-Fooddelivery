<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include 'DBConnect.php';
$objDb = new DBConnect;
$conn = $objDb->connect();
   
$method = $_SERVER['REQUEST_METHOD'];
switch($method) {
    case "POST":
        $id = $_REQUEST['id']; 
        $sql = "SELECT * FROM users WHERE id='$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $foods = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($foods);
    break;
}

?>