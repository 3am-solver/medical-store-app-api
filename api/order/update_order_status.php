<?php

use Rakit\Validation\Validator;

require '../../config/config.php';
$validator = new Validator;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Authenticating user
    if (!empty($fun)) {
        $user = $fun->verify_token();
    }

    $request = file_get_contents("php://input");
    $request = json_decode($request);

    // request validator
    $validation = $validator->make((array)$request, [
        'id' => 'required|integer',
        'status' => 'required',
    ]);

    $validation->validate();

    // handling request errors
    if ($validation->fails()) {
        $errors = $validation->errors();
        echo json_encode($errors->firstOfAll());
        http_response_code(406);
        exit;
    }

    // updating product
    try {
        if (!empty($db)) {
            $result = $db->update('products')
                ->where('id')->is($request->id)
                ->set(array(
                    'status' => $request->status,
                ));
        }
        http_response_code(204);
    } catch (Exception $ex) {
        echo json_encode($ex->getMessage());
        http_response_code(500);
    }
} else {
    http_response_code(405);
}
