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

if($method == "POST") {
    $id = $_REQUEST['id']; 
    $sql = "DELETE FROM foods WHERE id = :id";
    $path = explode('/', $_SERVER['REQUEST_URI']);
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    if($stmt->execute()) {
        $response = ['status' => 1, 'message' => 'Food deleted successfully.'];
    } else {
        $response = ['status' => 0, 'message' => 'Failed to delete record.'];
    }

    echo json_encode($response);
}
?>