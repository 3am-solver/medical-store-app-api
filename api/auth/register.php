<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Rakit\Validation\Validator;

require '../../config/config.php';
$validator = new Validator;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $request = file_get_contents("php://input");
    $request = json_decode($request);

    // request validator 
    $validation = $validator->make((array)$request, [
        'first_name' => 'required',
        'last_name' => 'required',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
        'zip' => 'required|min:6',
        'phone' => 'required',
        'email' => 'required|email',
        'username' => 'required',
        'password' => 'required|min:6',
        'confirm_password' => 'required|same:password',
        'avatar' => 'nullable',
    ]);

    $validation->validate();

    // handling request errors
    if ($validation->fails()) {
        $errors = $validation->errors();
        echo json_encode(["success" => false, "msg" => $errors->firstOfAll()]);
        exit;
    }

    // checking that data is unique or not 
    $uniq = $db->from('users')
        ->where('phone')->is($request->phone)
        ->orWhere('email')->is($request->email)
        ->orWhere('username')->is($request->username)
        ->select()
        ->count();
        
    if($uniq > 0){
        echo json_encode(["success" => false, "msg" => "user already exist"]);
        exit;
    }

    // creating new user
    $result = $db->insert(array(
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'address' => $request->address,
        'city' => $request->city,
        'state' => $request->state,
        'zip' => $request->zip,
        'phone' => $request->phone,
        'username' => $request->username,
        'email' => $request->email,
        'mail_hash' => hash('md5', $request->email),
        'password' => password_hash($request->password, PASSWORD_BCRYPT)
    ))->into('users');

    // Getting user info 
    $result = $db->from('users')
        ->where('phone')->is($request->phone)->select()
        ->first();
    if ($request == true) {
        // generating new auth token 
        $request_data = [
            'iat'  => $date->getTimestamp(),
            'data' => $result
        ];
        $token = JWT::encode(
            $request_data,
            SECRET_KEY,
            'HS512'
        );

        // Updating user
        $result = $db->update('users')
            ->where('userid')->is($result->userid)
            ->set(array(
                'remember_token' => $token
            ));
        // sending response 
        echo json_encode(["status" => true, "token" => $token]);
    }
} else {
    echo json_encode(["status" => false, "msg" => "Method not allowed"]);
}