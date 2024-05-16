<?php
$username = $_POST['username'];
$password = $_POST['password'];
if ($username == "roua" && $password == "Tounsi") {
    $response = array('success' => true);
} else {
    $response = array(
        'success' => false,
        'message' => 'Incorrect username or password'
    );
}

header('Content-Type: application/json');
echo json_encode($response);
