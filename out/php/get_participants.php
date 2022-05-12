<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include 'keys.php';
    // header('Content-type: application/json');

    // read json data (which is not IN _POST!!!!) and convert it into a PHP object
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    http_response_code(200);
    echo json_encode($data);
?>
