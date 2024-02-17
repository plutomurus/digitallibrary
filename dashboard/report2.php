<?php
require_once 'action.php';

$objct = new Graph();

$data = $objct->reportPeminjam();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>
<body>

<table align="center" border="1" cellpadding="5" cellspacing="0">
    <thead>
        <th>#</th>
        <th>User</th>
        <th>Buku</th>
        <th>Tanggal Peminjaman</th>
        <th>Tanggal Pengembalian</th>
    </thead>
    <tbody>
        
        <?php 
        $no = 1;
        foreach($data as $row) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row["Username"] ?></td>
            <td><?= $row["Judul"] ?></td>
            <td><?= date('l, m Y',strtotime($row["TanggalPeminjaman"])) ?></td>
            <td><?= $row["TanggalPengembalian"] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    
</body>
</html>