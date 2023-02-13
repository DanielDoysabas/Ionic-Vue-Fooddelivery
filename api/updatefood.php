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
        $price = $_REQUEST['price'];
        $foodname = $_REQUEST['foodname'];
        $sql = "UPDATE foods SET price=:price, foodname=:foodname WHERE id=:id LIMIT 1";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':foodname', $foodname);
        $stmt->bindParam(':id', $id);

        if($stmt->execute()) {
            $response = ['status' => 1, 'message' => 'update successfully.'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to update.'];
        }
        echo json_encode($response);
        break;
}

?>