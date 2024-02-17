<?php 
require_once 'action.php';

$data = new Ulasan();

?>

<div class="x_panel">
    <!-- Header -->
    <div class="x_title">
        <h2>Data Ulasan Buku</h2>
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
    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Ulasan</th>
                            <th>Rating</th>
                            <th>User</th>
                            <th>Buku</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php foreach($data->getUlasan() as $rows) : ?>
                                <tr>
                                    <td><?= $rows["Ulasan"] ?? '' ?></td>
                                    <td><?= $rows["Rating"] ?>/5</td>
                                    <td><?= $rows["Username"] ?? '' ?></td>
                                    <td><?= $rows["Judul"] ?? '' ?></td>
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