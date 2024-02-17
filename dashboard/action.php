<?php

require_once '../connection.php';

// use MyApp\Connection;

class Book extends Connection{

    public function getBookData(){

        $query = mysqli_query($this->conn, "SELECT buku.*, GROUP_CONCAT(kategoribuku.NamaKategori SEPARATOR ', ') AS kategori
                                    FROM buku
                                    LEFT JOIN kategoribuku_relasi ON buku.BukuID = kategoribuku_relasi.BukuID
                                    LEFT JOIN kategoribuku ON kategoribuku_relasi.KategoriID = kategoribuku.KategoriID
                                    GROUP BY buku.BukuID");

        $row = [];
        while ($result = mysqli_fetch_assoc($query)) {
            $row[] = $result;
        }

        return $row;

    }

    public function getCategory() {
        $query = mysqli_query($this->conn, "SELECT*FROM kategoribuku");

        $row = [];
        while($result = mysqli_fetch_assoc($query)){
            $rows[] = $result;
        }

        return $rows;
    }

    public function insertNewBook($data, $file){

        $judul = $data['judul'];
        $penulis = $data['penulis'];
        $penerbit = $data['penerbit'];
        $tahun = $data['tahun'];
        $deskripsi = $data['deskripsi'];

        // insert data ke table buku
        $stmt =$this->conn->prepare("INSERT INTO buku (Judul, Penulis, Penerbit, TahunTerbit, Deskripsi, File) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $judul, $penulis, $penerbit, $tahun, $deskripsi, $file);
        $stmt->execute();
        $stmt->close();

        // ambil id buku yang baru dimasukan
        $buku_id = $this->conn->insert_id;

        // Memasukkan kategori yang dipilih ke dalam tabel relasi
        if(isset($_POST['kategori']) && is_array($_POST['kategori'])) {
            foreach($_POST['kategori'] as $kategori) {
                // Query untuk memasukkan kategori ke dalam tabel relasi
                $stmt = $this->conn->prepare("INSERT INTO kategoribuku_relasi (BukuID, KategoriID) VALUES (?, ?)");
                $stmt->bind_param("ii", $buku_id, $kategori);
                $stmt->execute();
                $stmt->close();
                
            }
        }

    }

    public function edit($id) {
        $q1 = mysqli_query($this->conn, "SELECT*FROM buku WHERE BukuID='$id' ");
        $r1 = mysqli_fetch_assoc($q1);

        // Ambil kategori yang telah dipilih untuk buku yang akan diedit
        $selected = [];
        $q2 = mysqli_query($this->conn, "SELECT KategoriID FROM kategoribuku_relasi WHERE BukuID='$id'");
        while ($result = mysqli_fetch_assoc($q2)) {
            $selected[] = $result['KategoriID'];
        }

        // Tambahkan array selectedCategories ke dalam data buku yang akan dikembalikan
        $r1['selected'] = $selected;

        var_dump($r1);
        die;

        return $r1;

    }

    public function Update($data, $id) {
        $judul = $data["judul"];
        $penulis = $data["penulis"];
        $penerbit = $data["penerbit"];
        $tahun = $data["tahun"];
        $tahun = $data["tahun"];
        $deskripsi = $_POST["deskripsi"];

        $stmt = $this->conn->prepare("UPDATE buku SET Judul = ?, Penulis = ?, Penerbit = ?, TahunTerbit = ?, Deskripsi = ? WHERE BukuID = ?");
        $stmt->bind_param("sssssi", $judul, $penulis, $penerbit, $tahun, $deskripsi, $id);
        $stmt->execute();

        if($stmt->execute()){
            return true;
        }else {
            return false;
        }
    }

    public function Delete($id){
        $query = mysqli_query($this->conn, "DELETE FROM buku WHERE BukuID='$id' ");

        if($query){
            header("location:index.php?page=buku");
        }

        return true;

    }

}


Class Category extends Connection {
    public function getData(){
        $query = mysqli_query($this->conn, "SELECT*FROM kategoribuku");
        
        $row = [];
        while($result = mysqli_fetch_assoc($query)){
            $row[] = $result;
        }

        return $row;

    }

    public function insertCategory($data) {

        $kategori = $data['kategori'];
        $stmt = $this->conn->prepare("INSERT INTO kategoribuku (NamaKategori) VALUES (?)");
        $stmt->bind_param("s", $kategori);
        $stmt->execute();
        $stmt->close();

        return mysqli_affected_rows($this->conn);
    }

    public function Edit($id){
        $query = mysqli_query($this->conn, "SELECT*FROM kategoribuku WHERE KategoriID='$id' ");

        $result = mysqli_fetch_assoc($query);

        return $result;
    }

    public function Update($data, $id){
        $kategori = $data['kategori'];

        mysqli_query($this->conn, "UPDATE kategoribuku SET NamaKategori='$kategori' WHERE KategoriID='$id' ") ? $n = true : $n = false;

        return $n;

    }

    public function Delete($id){
        mysqli_query($this->conn, "DELETE FROM kategoribuku WHERE KategoriID='$id' ") ? $n = true : $n = false;

        return $n;
    }

}

class Ulasan extends Connection {

    public function getUlasan(){
        $query = mysqli_query($this->conn, "SELECT*FROM ulasanbuku LEFT JOIN user ON user.UserID = ulasanbuku.UserID LEFT JOIN buku ON buku.BukuID = ulasanbuku.BukuID");


        $row = [];
        while($result = mysqli_fetch_assoc($query)){
            $row[] = $result;
        }

        return $row;
    }
}

class Graph extends Connection {

    public function getPeminjam(){
        // Mendapatkan tanggal hari Senin pada minggu ini
        $monday = date('Y-m-d', strtotime('monday this week'));

        // Mendapatkan tanggal Minggu setelah hari Senin pada minggu ini
        $sunday = date('Y-m-d', strtotime('sunday this week'));

        // Variabel untuk menyimpan tanggal mulai dan selesai
        $start_date = $monday;
        $end_date = $sunday;

        // Mengeluarkan tanggal dalam format yang dapat digunakan dalam kueri SQL
        $start_date_sql = mysqli_real_escape_string($this->conn, $start_date);
        $end_date_sql = mysqli_real_escape_string($this->conn, $end_date);

        // Membuat kueri SQL untuk mendapatkan data peminjaman antara tanggal mulai dan selesai
        $query = mysqli_query($this->conn, "SELECT * FROM peminjaman WHERE TanggalPeminjaman BETWEEN '$start_date_sql' AND '$end_date_sql'");

        $row = ['Monday' => 0, 'Tuesday' => 0, 'Wednesday' => 0, 'Thursday' => 0, 'Friday' => 0, 'Saturday' => 0, 'Sunday' => 0];

        // Loop melalui hasil kueri dan menghitung jumlah rekaman untuk setiap hari
        while ($data = mysqli_fetch_assoc($query)) {
            // Mendapatkan hari dari tanggal peminjaman
            $day_of_week = date('l', strtotime($data['TanggalPeminjaman']));
            
            // Menambahkan 1 ke jumlah rekaman untuk hari tersebut
            $row[$day_of_week]++;
        }

        // Mengembalikan data dalam bentuk array
        return $row;
    }

    public function reportPeminjam(){
        $query = mysqli_query($this->conn, "SELECT*FROM peminjaman LEFT JOIN user ON user.UserID = peminjaman.UserID LEFT JOIN buku ON buku.BukuID = peminjaman.BukuID");

        $row = [];
        while($result = mysqli_fetch_assoc($query)){
            $row[] = $result;
        }

        return $row;
    }
}