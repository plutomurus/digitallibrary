<?php

require_once '../Connection.php';

Class Peminjam extends Connection {
    public function getPeminjam(){
        $query = mysqli_query($this->conn, "SELECT*FROM buku");

        $row = [];
        while($result = mysqli_fetch_assoc($query)){
            $row[] = $result;
        }

        return $row;
    }

    public function getDataToInsert($id) {
        $query = mysqli_query($this->conn, "SELECT buku.*, GROUP_CONCAT(kategoribuku.NamaKategori SEPARATOR ', ') AS kategori
        From buku LEFT JOIN kategoribuku_relasi ON buku.BukuID = kategoribuku_relasi.BukuID LEFT JOIN kategoribuku ON kategoribuku.KategoriID = kategoribuku_relasi.KategoriID WHERE buku.BukuID='$id'");

        $result = mysqli_fetch_assoc($query);

        return $result;
    }

    public function insertPeminjam($id, $user, $data){
        $checkData = mysqli_query($this->conn, "SELECT*FROM peminjaman WHERE UserID = '$user' and BukuID = '$id'");

        // cek data duplikat dan input tanggal salah
        mysqli_num_rows($checkData) > 0 ? exit(header("location:?page=peminjaman&id=$id&duplicate")) :'';
        $data["tanggalPinjam"] >= $data["tanggalKembali"] ? exit(header("location:index.php?page=peminjaman&id=$id&datewrong")) :'';
        
        $status = 'Pinjam';
        $stmt = $this->conn->prepare("INSERT INTO peminjaman (UserID, BukuID, TanggalPeminjaman, TanggalPengembalian, StatusPeminjaman) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $user, $id, $data["tanggalPinjam"], $data["tanggalKembali"], $status);
        $stmt->execute();

        // exit(header("location:index.php?page=peminjaman&id=$id"));
        return $stmt->affected_rows > 0;

    }

    public function getBuku($id){
        $query = mysqli_query($this->conn, "SELECT * FROM peminjaman LEFT JOIN user ON user.UserID = peminjaman.UserID LEFT JOIN buku ON buku.BukuID = peminjaman.BukuID WHERE peminjaman.UserID = '$id' ");

        $rows = []; // Membuat array kosong untuk menyimpan semua hasil

        while($result = mysqli_fetch_assoc($query)){
            $rows[] = $result; // Menambahkan setiap hasil ke dalam array
        }

        return $rows; // Mengembalikan array yang berisi semua hasil
    }

    public function insertUlasan($buku, $user, $data){
        $ulasan = $data['ulasan'];
        $rating = $data['rating'];

        $stmt = $this->conn->prepare("INSERT INTO ulasanbuku (UserID, BukuID, Ulasan, Rating) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $user, $buku, $ulasan, $rating);
        $stmt->execute();
    }
}