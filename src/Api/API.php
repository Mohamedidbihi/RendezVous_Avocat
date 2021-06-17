<?php
 include 'db.php'; 
if(isset($_SERVER['HTTP_ORIGIN'])) {
    
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 1000');

}
if ($_SERVER['REQUEST_METHODE']=='OPTIONS'){
    if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])){
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    }
    if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])){
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
    }
    exit(0);
    
}

?>