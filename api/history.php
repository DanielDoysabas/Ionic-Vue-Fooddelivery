<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include 'DBConnect.php';
$objDb = new DBConnect;
$conn = $objDb->connect();
   
session_start();
$method = $_SERVER['REQUEST_METHOD'];

if($method == "POST") {
    
    $id = $_REQUEST['id'];
    $a = 0;
    $sql = "SELECT * FROM orders WHERE user_id = '$id' ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $response = ['status' => 1, 'data' => $row ];
    echo json_encode($response);
}
?>