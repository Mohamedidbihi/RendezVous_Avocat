<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: applecation/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-Width');

include_once '../Database/Database.php';
include_once '../Modele/Client.php';

$database   =   new Database();
$db         =   $database->connect();
$Client       =   new Client($db);
$data   =   json_decode(file_get_contents("php://input"));
$Client->Reference = $data->Reference;


if($Client->Signin()){
    echo json_encode(
        array('message' => 'Login est passe avec succes !!!','Reference' => $Client->Reference)
    );
    
}else{
    echo json_encode(
        array('message' =>'Try Again Ref incorrect!!')
    );
}
?>