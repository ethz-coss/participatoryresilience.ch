<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include 'keys.php';

    // read json data (which is not IN _POST!!!!) and convert it into a PHP object
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    echo json_encode($data);

    if (!array_key_exists("name", $data) || !array_key_exists("email", $data)) {
        die(json_encode(array("status" => "error - missing data entries")));
    }

    $name = $data["name"];
    $email = $data["email"];


    $conn = mysqli_connect($db_host, $db_uname, $db_password, $db_name);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO registrations (name,email) VALUES ('$name','$email')";

    if (mysqli_query($conn, $sql)) {
        $stat = "success";
    } else {
        $stat = "error " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    $status = array("status" => $stat);


    http_response_code(200);
    echo json_encode($status);
?>
