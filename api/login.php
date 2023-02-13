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
    $type = $_REQUEST['type']; 

    $sql = "SELECT * FROM users WHERE username = '$myusername' && user_type='$type'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(password_verify($mypassword,$row[0]["password"])){
        $response = ['status' => 1, 'message' => 'Login', 'id' => $row[0]["id"] ];
    }else{
        $response = ['status' => 0, 'message' => 'Incorrect Username/Password'];
    }
    echo json_encode($response);
}
?>