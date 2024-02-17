<?php 
require_once 'action.php';

$data = new Category();

?>

<div class="x_panel">
    <!-- Header -->
    <div class="x_title">
        <h2>Data Kategori Buku</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="ml-2">
                <a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- \Header -->

    <!-- Content -->
    <a class="btn btn-success" href="?page=kategori&act=insertCat"><i class="fa fa-plus"></i> Tambah Kategori</a>

    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php foreach($data->getData() as $rows) : ?>
                                <tr>
                                    <td><?= $rows["NamaKategori"] ?? '' ?></td>
                                    <td>
                                        <a class="btn btn-danger rounded" href="?page=kategori&act=deleteCat&id=<?= $rows["KategoriID"] ?>"><i class="fa fa-trash"></i></a>
                                        <a class="btn btn-primary rounded" href="?page=kategori&act=editCat&id=<?= $rows["KategoriID"] ?>"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- \Content -->

</div>