<?php
/*
session_start();
$host = 'localhost';
$dbname = 'pegawai';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<h2>Gagal terhubung ke database</h2><br> Error: " . $e->getMessage();
    header("refresh:5;url=login.php");
    exit();
}


if (isset($_POST['username']) and isset($_POST['password'])) {
    $inputUsername = $_POST['username'];
    $inputPassword = MD5($_POST['password']);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM admins WHERE username = :username AND password= :pwd");
    $stmt->bindParam(':username', $inputUsername);
    $stmt->bindParam(':pwd', $inputPassword);
    $stmt->execute();

    // Fetch the result (number of rows with this username)
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "Login Successfully.";
        $_SESSION['username'] = $inputUsername;
        header("refresh:0;url=index.php");
        exit();
    } else {
        echo "invalid username or password";
        header("refresh:5;url=login.php");
        exit();
    }
} else {
    echo "No username and password provided.";
}

*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $host = 'localhost';
    $dbname = 'pegawai';
    $username = 'root';
    $password = '';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "<h2>Gagal terhubung ke database</h2><br> Error: " . $e->getMessage();
        header("refresh:5;url=login.php");
        exit();
    }


    $inputUsername = $_POST['username'];
    $inputPassword = MD5($_POST['password']);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM admins WHERE username = :username AND password= :pwd");
    $stmt->bindParam(':username', $inputUsername);
    $stmt->bindParam(':pwd', $inputPassword);
    $stmt->execute();

    // Fetch the result (number of rows with this username)
    $count = $stmt->fetchColumn();
    if ($count > 0) {
        $_SESSION['username'] = $inputUsername;
        $response = [
            'status' => 'success',
            'message' => 'Login Successfully.',
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = [
            'status' => 'failed',
            'message' => 'invalid username or password',
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Return a JSON response

}
