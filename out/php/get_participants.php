<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include 'keys.php';
    $conn = mysqli_connect($db_host, $db_uname, $db_password, $db_name);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "FROM registrations COUNT(email)";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        $stat = "success";
        $count = $result;
    } else {
        $stat = "error " . $sql . "<br>" . mysqli_error($conn);
        $count = 0;
    }

    mysqli_close($conn);
    $result = array("status" => $stat, "count" => $count);


    http_response_code(200);
    echo json_encode($result);
?>
