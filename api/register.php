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
    
    $myusername = $_REQUEST['username'];
    $mypassword = $_REQUEST['password']; 
    $userid = 1;
    $hash = password_hash($mypassword, PASSWORD_BCRYPT, array('cost'=>11));

    $sql = "INSERT INTO users(id, username, password, user_type) VALUES(null, :username, :password, :user_type)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $myusername);
    $stmt->bindParam(':password', $hash);
    $stmt->bindParam(':user_type', $userid);

    if($stmt->execute()) {
        $response = ['status' => 1, 'message' => 'Record created successfully.'];
    } else {
        $response = ['status' => 0, 'message' => 'Failed to create record.'];
    }
    echo json_encode($response);
}
?>