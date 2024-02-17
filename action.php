<?php
require_once 'connection.php';

class Auth extends Connection{

    public function register($data) {
        
        $user = strtolower($data['username']);
        $pass = $data['password'];
        $email = $data['email'];
        $nama = $data['nama'];
        $alamat = $data['alamat'];
        $level = $data['level'];

        // Hash Password
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        
        // Cek apakah username sudah ada
        $checkPass = mysqli_query($this->conn, "SELECT * FROM user WHERE Username = '$user'");
        if(mysqli_num_rows($checkPass) > 0){
            return false;
            exit;

        }

        // Insert ke database
        $stmt = $this->conn->prepare("INSERT INTO user (Username, Password, Email, NamaLengkap, Alamat, Level) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $user, $pass, $email, $nama, $alamat, $level);
        $stmt->execute();
        
        return $stmt->affected_rows;
    }

    public function login($data) {

        $user = $data['username'];
        $pass = $data['password'];


        $query = mysqli_query($this->conn, "SELECT * FROM user WHERE Username = '$user'");

        // Mengecek jumlah data berdasarkan username dan password
        $row = mysqli_num_rows($query);

        if($row > 0 ){

            $getUser = mysqli_fetch_assoc($query);
            $finalPass = password_verify($pass, $getUser['Password']);

            if($finalPass){
                $_SESSION["login"] = $getUser;
                // $_SESSION["user"] = $user;

                return true;
            }

            return false;

        }

    }
}