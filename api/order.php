<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

require_once('vendor/autoload.php');
$client = new \GuzzleHttp\Client();

include 'DBConnect.php';
$objDb = new DBConnect;
$conn = $objDb->connect();
   
session_start();
$method = $_SERVER['REQUEST_METHOD'];

if($method == "POST") {
    $order = $_REQUEST['order'];
    $pm = $_REQUEST['paymentmode'];
    $address = "";
    if(isset($_REQUEST["address"])){
        $address = $_REQUEST['address'];
    }
    $a = 0;
    $arr = array();
    $total_price = 0;
    $id = $_REQUEST['userid'];
    $trans_number = (rand(1000000000,9999999999));
    foreach ($order as $key => $value) {
        $sql = "SELECT * FROM foods WHERE id=".$value["ids"];
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total_price += floatval($row[0]["price"]);
        array_push($arr, $row[0]);
    }
    $sql = "INSERT INTO orders (orderlist, totalprice, address, status, paymentmode, user_id, transaction_number) VALUES(:orderlist, :totalprice, :address, :status, :paymentmode, :user_id, :transaction_number)";
    $stmt = $conn->prepare($sql);
    $data = json_encode($arr);
    $values = array(
        ":orderlist"=>$data,
        ":totalprice"=> (string)$total_price,
        ":address"=>$address,
        ":status" => (string)$a,
        ":paymentmode" => $pm,
        ":user_id" => $id,
        ":transaction_number" => $trans_number,
    );

    $str_amt = strval($total_price."00"); 
    $amt = (int) $str_amt;
    $desc = $trans_number;

    $data = '{"data":{"attributes":{"amount":'.$amt.',"description":"'.$desc.'"}}}';
    $res= $client->request('POST', 'https://api.paymongo.com/v1/links', [
    'body' => $data,
    'headers' => [
        'accept' => 'application/json',
        'authorization' => 'Basic c2tfdGVzdF9aS1VZRzY3djNjMmhuYXU4ZURiODNpckc6cGtfdGVzdF9HS2F5VTN3Tk1tZTh6dDFDa3Q4ZUNkcmY=',
        'content-type' => 'application/json',
    ],
    ]);

    $a =  json_decode($res->getBody(), true);


    if($pm==0 && $stmt->execute($values)){
        $response = ['status' => 3, 'link'=>$a['data']['attributes']['checkout_url']];
    }else if($stmt->execute($values)) {
        $response = ['status' => 1, 'message'=>'Order added successfully'];
    }

    echo json_encode($response);
}
?>