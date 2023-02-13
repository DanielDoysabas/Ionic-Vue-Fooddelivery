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
        $sql = "SELECT * FROM foods";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $foods = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($foods);
        break;
        
    case "POST":
        $food = $_REQUEST['foodname'];
        $price = $_REQUEST['price']; 
        $foodtype = $_REQUEST['foodtype']; 
        if ($food===null || $price===null || $foodtype===null) {
            break;
        }

        $sql = "INSERT INTO foods(id, foodname, price,foodtype) VALUES(null, :foodname, :price,:foodtype)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':foodname', $food);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':foodtype', $foodtype);

        if($stmt->execute()) {
            $response = ['status' => 1, 'message' => 'created successfully.'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to create.'];
        }
        
        echo json_encode($response);
        break;

    case "DELETE":
        $sql = "DELETE FROM foods WHERE id = :id";
        $path = explode('/', $_SERVER['REQUEST_URI']);
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $path[3]);

        if($stmt->execute()) {
            $response = ['status' => 1, 'message' => 'Deleted successfully.'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to delete.'];
        }
        echo json_encode($response);
        break;
}

?>