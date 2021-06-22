<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applecation/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-Width');

include_once '../Database/Database.php';
include_once '../Modele/RDV.php';


//instantiate DB & Connect
$database   =   new Database();
$db         =   $database->connect();
// 
//instantiate Blog Post Object
$rdv       =   new RDV($db);

//Get raw posted data
$data   =   json_decode(file_get_contents("php://input"));
$rdv->Id_rdv = $data->Id_rdv;

//Create post
if ($rdv->delete()) {
    echo json_encode(
        array('message' => 'Rdv Supprimer')
    );
} else {
    echo json_encode(
        array('message' => 'erreur')
    );
}
