<?php

// Headers 

header('Access-Control-Allow-Origin: *');
header('Content-Type: applecation/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-Width');

// include database and appointment model
include_once '../Database/Database.php';
include_once '../Modele/RDV.php';

// Instantiate Database 
$database = new Database();
// db = connect->conn
$db = $database->connect();
// Instantiate
$RDV       =   new RDV($db);
// get data
$data   =   json_decode(file_get_contents("php://input"));

// push data into properties
$RDV->Motif         =   $data->Motif;
// $RDV->Date         =   $data->Date;
$RDV->Num_Creneau   =   $data->Num_creneau;
$RDV->Id_rdv    =   $data->Id_rdv;


if($RDV->update($data->Date)){
    echo json_encode(
        array('message' => 'Modification passe avec succes !')
    );

}else{
    echo json_encode(
        array('message' => "Erreur de modifier")
    );
}