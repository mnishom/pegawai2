<?php
require_once __DIR__ . '\classes\Database.php';

class AppHandler
{
    private $database;
    private $pdo;

    public function __construct()
    {
        $this->database = new Database();
        $this->pdo = $this->database->connect();
    }

    public function getAllData($data)
    {
        $query = $this->pdo->prepare("SELECT * FROM employee");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $nom = 1;
        $htmldata = "";
        foreach ($result as $peg) {
            $htmldata .= "<tr>";
            $htmldata .= "<td>" . $nom . "</td>";
            $htmldata .= "<td>" . $peg['nip'] . "</td>";
            $htmldata .= "<td>" . $peg['nama'] . "</td>";
            $htmldata .= "<td>" . $peg['alamat'] . "</td>";
            $htmldata .= "<td>" . $peg['no_hp'] . "</td>";
            $htmldata .= "<td>";
            $htmldata .= "<button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modalEdit'>Edit</button> | <button type='button' class='btn btn-danger btn-sm'>Hapus</button>";
            $htmldata .= "</td>";
            $htmldata .= "</tr>";
            $nom++;
        }
        $response = [
            'status' => 'success',
            'message' => 'OK',
            'result' => $htmldata
        ];
        return json_encode($response);
    }

    public function saveData($data)
    {
        session_start();
        $nip = htmlspecialchars($data['nip']);
        $nama = htmlspecialchars($data['nama']);
        $alamat = htmlspecialchars($data['alamat']);
        $hp = htmlspecialchars($data['hp']);
        $response = [
            'status' => 'success',
            'message' => 'NIP:' . $nip,
        ];
        //header('Content-Type: application/json');
        return json_encode($response);
    }


    public function login($data)
    {
        session_start();
        $inputUsername = htmlspecialchars($data['username']);
        $inputPassword = MD5(htmlspecialchars($data['password']));

        // Prepare SQL statement to prevent SQL injection
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM admins WHERE username = :username AND password= :pwd");
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
            //header('Content-Type: application/json');
            return json_encode($response);
        } else {
            $response = [
                'status' => 'failed',
                'message' => 'invalid username or password',
            ];
            //header('Content-Type: application/json');
            return json_encode($response);
        }
    }

    public function cariData($data)
    {
        $Q = htmlspecialchars($data['key']);
        $stmt = $this->pdo->prepare("SELECT * FROM employee WHERE nip LIKE :nip OR nama LIKE :nama");
        $stmt->bindValue(':nip', '%' . $Q . '%', PDO::PARAM_STR);
        $stmt->bindValue(':nama', '%' . $Q . '%', PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $nom = 1;
        $htmldata = "";
        foreach ($result as $peg) {
            $htmldata .= "<tr>";
            $htmldata .= "<td>" . $nom . "</td>";
            $htmldata .= "<td>" . $peg['nip'] . "</td>";
            $htmldata .= "<td>" . $peg['nama'] . "</td>";
            $htmldata .= "<td>" . $peg['alamat'] . "</td>";
            $htmldata .= "<td>" . $peg['no_hp'] . "</td>";
            $htmldata .= "<td>";
            $htmldata .= "<button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modalEdit'>Edit</button> | <button type='button' class='btn btn-danger btn-sm'>Hapus</button>";
            $htmldata .= "</td>";
            $htmldata .= "</tr>";
            $nom++;
        }
        $response = [
            'status' => 'success',
            'message' => 'OK',
            'result' => $htmldata
        ];
        //header('Content-Type: application/json');
        return json_encode($response);
    }

    public function updateData($data)
    {
        $datetime = date('Y-m-d H:i:s');
        return json_encode(['a' => $datetime]);
    }
}
