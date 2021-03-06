<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With ');


    include_once '../../config/Database.php';
    include_once '../../models/User.php';


    // Instantiate DB & connect 
    $database = new Database();
    $db = $database->connect();

    // Instantiate user object
    $user = new User($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to delete
    $user->id = $data;

    // Delete user
    if($user->delete()){
        echo json_encode(
            array('message' => 'User ' . $user->id . ' Was Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'User Not Deleted')
        );
    }