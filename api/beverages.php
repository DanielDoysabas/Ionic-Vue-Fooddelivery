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

if($method == "GET") {
    $sql = "SELECT * FROM foods WHERE foodtype='2'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($row);
}
?>