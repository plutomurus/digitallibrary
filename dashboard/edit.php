<?php
require_once 'action.php';

$data = new Book();

// Menangkap id dari url
$id = $_GET["id"];

// Dapatkan data buku dari variabel $r1 yang dikembalikan
$result = $data->edit($id);

if(isset($_POST["submit"])){
    $updt = $data->Update($_POST, $id);


    if($updt){
        header("location:?page=buku");
        // echo "
        //     <script>
        //     window.location.href='index.php?page=buku';
        //     </script>
        // ";
    }
}

ob_end_flush();
?>
<div class="row">
    <div class="col-md-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Input Data Buku Baru</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="ml-2"><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form class="form-label-left input_mask" method="POST">

                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Judul Buku</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" placeholder="Judul Buku" name="judul" value="<?= $result["Judul"] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Penulis</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" placeholder="Penulis" name="penulis" value="<?= $result["Penulis"] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Penerbit</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" placeholder="Penerbit" name="penerbit" value="<?= $result["Penerbit"] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Tahun Terbit</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="number" class="form-control" placeholder="Tahun Terbit" name="tahun" value="<?= $result["TahunTerbit"] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-form-label col-md-3 col-sm-3 ">Kategori</label>
                    <div class="col-md-9 col-sm-9 ">
                        <?php foreach($data->getCategory() as $rows) : ?>
                            <input type="checkbox" class="flat mb-2" name="kategori[]" value="<?= $rows["KategoriID"] ?>" id="<?= $rows["NamaKategori"] ?>" data-parsley-mincheck="2" <?= $rows["KategoriID"] ?> <?= in_array($rows["KategoriID"], $result['selected']) ? 'checked' : '' ?> />
                            <label for="<?= $rows["NamaKategori"] ?>"><?= $rows["NamaKategori"] ?></label>
                        <?php endforeach; ?>
                    </div>

                </div>

                <div class="form-group row">
                    <label  class="col-form-label col-md-3 col-sm-3 ">Deskripsi Buku</label>
                    <div class="col-md-9 col-sm-9 ">
                        <textarea name="deskripsi" class="form-control" id="" cols="10" rows="2" placeholder="Deskripsi Buku"><?= $result["Deskripsi"] ?></textarea>
                    </div>

                </div>

                <div class="ln_solid"></div>
                <div class="form-group row">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <a class="btn btn-primary" href="?page=buku">Cancel</a>
                        <button type="submit" class="btn btn-success" name="submit">Simpan Perubahan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
</div>