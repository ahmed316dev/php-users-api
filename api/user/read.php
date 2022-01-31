<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';


    // Instantiate DB & connect 
    $database = new Database();
    $db = $database->connect();

    // Instantiate user object
    $user = new User($db);

    // User query
    $result = $user->read();

    // Get row count
    $num = $result->rowCount();

    if($num > 0) {
        // User array
        $users_arr = array();
        $users_arr['users'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $user_item = array(
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
            );

            // Push to "users"
            array_push($users_arr['users'], $user_item);
        }
        
        // Turn to JSON & output

        echo json_encode($users_arr);
    } else {
        // No users
        echo json_encode (
            array('message' => "No Users Found")
        );
    }
