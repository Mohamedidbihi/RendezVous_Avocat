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

$res= false;
$Client->Reference = $Client->generateRandomString();
$Client->nom =$data->nom;
$Client->prenom= $data->prenom;
$Client->profession =$data->profession;
$Client->tele = $data->tele;
$Client->cin = $data->cin;
$count = $Client->CinExists();
if($count>0){
    echo json_encode(
        array('message' => 'Existe deja','res' =>false)
    );
    
}else{
    {
        if($Client->Signup()){
            echo json_encode(
                array('message' => 'Creation du compte passe avec succes !!!','reference' => $Client->Reference , 'res' =>true)
            );
            
        }else{
            echo json_encode(
                array('message' =>'Try Again !!','res' =>false)
            );
    }
    }
     
}