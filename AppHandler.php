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
            $htmldata .= "<button type='button' title='Ubah Data' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modalEdit' onclick=\"setData('" . $peg['id'] . "','" . $peg['nip'] . "','" . $peg['nama'] . "','" . $peg['alamat'] . "','" . $peg['no_hp'] . "')\"><i class=\"fa-solid fa-user-pen\"></i></button> | <button title='Hapus Data' type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modalDelete' onclick=\"modalHapusData('" . $peg['id'] . "','" . $peg['nip'] . "','" . $peg['nama'] . "')\"><i class=\"fa-solid fa-trash-can\"></i></button>";
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
        try {
            session_start();
            $nip = htmlspecialchars($data['nip']);
            $nama = htmlspecialchars($data['nama']);
            $alamat = htmlspecialchars($data['alamat']);
            $hp = htmlspecialchars($data['hp']);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $Query = "INSERT INTO employee (nip,nama,alamat,no_hp) VALUES (:nip, :nama, :alamat, :no_hp)";
            $stmt = $this->pdo->prepare($Query);
            $stmt->bindParam(':nip', $nip);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':no_hp', $hp);
            $stmt->execute();

            $response = [
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan',
            ];
            //header('Content-Type: application/json');
            return json_encode($response);
        } catch (PDOException $e) {
            $response = [
                "status" => "error",
                "message" => "Error: " . $e->getMessage(),
            ];
            return json_encode($response);
        }
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
            $htmldata .= "<button type='button' title='Ubah Data' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modalEdit' onclick=\"setData('" . $peg['id'] . "','" . $peg['nip'] . "','" . $peg['nama'] . "','" . $peg['alamat'] . "','" . $peg['no_hp'] . "')\"><i class=\"fa-solid fa-user-pen\"></i></button> | <button title='Hapus Data' type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modalDelete' onclick=\"modalHapusData('" . $peg['id'] . "','" . $peg['nip'] . "','" . $peg['nama'] . "')\"><i class=\"fa-solid fa-trash-can\"></i></button>";
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
        $id = htmlspecialchars($data['eid']);
        $nip = htmlspecialchars($data['enip']);
        $nama = htmlspecialchars($data['enama']);
        $alamat = htmlspecialchars($data['ealamat']);
        $hp = htmlspecialchars($data['ehp']);

        $stmt = $this->pdo->prepare("UPDATE employee SET nip = :nip, nama = :nama, alamat = :alamat, no_hp = :hp WHERE id = :id");
        $stmt->bindParam(':nip', $nip);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':hp', $hp);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $response = [
            'status' => 'success',
            'message' => 'Data berhasil diupdate',
        ];
        //header('Content-Type: application/json');
        return json_encode($response);
    }

    public function deleteData($data)
    {
        $delid = htmlspecialchars($data['delid']);

        $stmt = $this->pdo->prepare("DELETE FROM employee WHERE id = :id");
        $stmt->bindParam(':id', $delid);
        $stmt->execute();

        $response = [
            'status' => 'success',
            'message' => 'Data berhasil dihapus',
        ];
        //header('Content-Type: application/json');
        return json_encode($response);
    }
}
