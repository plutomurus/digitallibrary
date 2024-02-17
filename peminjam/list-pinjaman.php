<?php
    $result = $data->getBuku($_SESSION["login"]["UserID"]);
?>
<table id="example" class="table table-striped" style="width:100%">
<thead>
    <tr>
    <th>Judul</th>
    <th>Tanggal Peminjaman</th>
    <th>Tanggal Pengembalian</th>
    <th>Lihat Buku</th>
    </tr>
</thead>
<tbody>
    <?php foreach($result as $row):  ?>
    <tr>
        <td><?= $row["Judul"] ?></td>
        <td><?= $row["TanggalPeminjaman"] ?></td>
        <td><?= date($row["TanggalPengembalian"]) ?></td>
        <td><a href="../book/<?= $row['File'] ?>" target="_blank">Unduh File PDF</a></td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>

<script>
$(document).ready(function() {
    $('#example').DataTable({
    "paging": true, // Aktifkan pagination
    "searching": true, // Aktifkan live search
    "ordering": true // Aktifkan sorting
    });
});
</script>