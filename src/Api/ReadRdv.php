<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: applecation/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-Width');

include_once '../Database/Database.php';
include_once '../Modele/RDV.php';

$database   =   new Database();
$db         =   $database->connect();
$RDV       =   new RDV($db);
$data   =   json_decode(file_get_contents("php://input"));
$RDV->Reference = $data->Reference;
$result     =   $RDV->read();
$count        =   $result->rowCount();

    if($count > 0){
    $rdv_arr          =   array();
    $rdv_arr['data']  =   array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $rdva  = array(
            'Id_rdv'     => $Id_rdv,
            'Motif'     => $Motif,
            'Date'  => $Date,
            'Num_creneau'  => $Num_creneau,
            // 'Time' => $Time
        );

        array_push($rdv_arr['data'],$rdva);
    }
    echo json_encode($rdv_arr['data']);
}else{
    echo json_encode(
        array('message' => 'No rdv Found')
    );
}


