<?php
require_once 'action.php';

$data = new Category();

if(isset($_POST["submit"])){

    $objct = $data->insertCategory($_POST);

    if($objct) exit(header("location:?page=kategori"));
        
}

?>

<div class="row">
    <div class="col-md-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Input Kategori Baru</h2>
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
                    <label class="col-form-label col-md-3 col-sm-3 ">Kategori</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" placeholder="Kategori Baru" name="kategori" required>
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