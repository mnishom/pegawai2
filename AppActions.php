<?php
header('Content-Type: application/json');
require_once __DIR__ . '\AppHandler.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = htmlspecialchars($_POST['action']);
    $handler = new AppHandler();
    if ($action && method_exists($handler, $action)) {
        $response = $handler->$action($_POST);
        echo $response;
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Invalid action.',
        ];
        echo json_encode($response);
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Invalid request method.',
    ];
    echo json_encode($response);
}
