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
    
    $arr = $_REQUEST['listprice'];
    $price = 0;
    foreach ($arr as $key => $value) {
        $price += $value["price"];
    }
    $response = ['status' => 1, 'data'=>$price];
    echo json_encode($response);
}
?>