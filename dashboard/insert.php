<?php

require_once 'action.php';

$data = new Book();

if(isset($_POST["submit"])){

    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // Simpan file di server
    move_uploaded_file($file_tmp,"../book/".$file_name);

    $data->insertNewBook($_POST, $file_name);
    
}

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
            <form class="form-label-left input_mask" method="POST" enctype="multipart/form-data">

                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Judul Buku</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" placeholder="Judul Buku" name="judul" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Penulis</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" placeholder="Penulis" name="penulis" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Penerbit</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" placeholder="Penerbit" name="penerbit" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Tahun Terbit</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="number" class="form-control" placeholder="Tahun Terbit" name="tahun" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-form-label col-md-3 col-sm-3 ">Kategori</label>
                    <div class="col-md-9 col-sm-9 ">
                        <?php foreach($data->getCategory() as $rows) : ?>
                            <input type="checkbox" class="flat mb-2" name="kategori[]" value="<?= $rows["KategoriID"] ?>" id="<?= $rows["NamaKategori"] ?>" data-parsley-mincheck="1" />
                            <label for="<?= $rows["NamaKategori"] ?>"><?= $rows["NamaKategori"] ?></label>
                            <!-- <br/> -->
                        <?php endforeach; ?>
    
                    </div>

                </div>

                <div class="form-group row">
                    <label  class="col-form-label col-md-3 col-sm-3 ">Deskripsi Buku</label>
                    <div class="col-md-9 col-sm-9 ">
                        <textarea name="deskripsi" class="form-control" id="" cols="10" rows="2" placeholder="Deskripsi Buku" required></textarea>
                    </div>

                </div>

                <div class="form-group row">
                    <label  class="col-form-label col-md-3 col-sm-3 ">File Buku</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="file" id="file" class="form-control" name="file" required>
                    </div>

                </div>

                <div class="ln_solid"></div>
                <div class="form-group row">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <a class="btn btn-primary" href="?page=buku">Cancel</a>
                        <button class="btn btn-primary" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success" name="submit">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
</div>