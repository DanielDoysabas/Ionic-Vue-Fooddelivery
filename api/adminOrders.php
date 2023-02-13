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
    case "GET":
        $sql = "SELECT * FROM orders";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $foods = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($foods);
        break;
        
    case "POST":
        $id = $_REQUEST['id'];
        $status = "1";
        $sql = "UPDATE orders SET status=:status WHERE id=:id LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $status);

        if($stmt->execute()) {
            $response = ['status' => 1, 'message' => 'update successfully.'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to update.'];
        }
        echo json_encode($response);
        break;
}

?>