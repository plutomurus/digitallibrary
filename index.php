<?php
include 'action.php';

if(isset($_SESSION["login"])){
    if($_SESSION["login"]["Level"] !== 'peminjam'){
        header("location:dashboard/index.php");
    }else {
        header("location:peminjam/index.php");
    }
}

if(isset($_POST['register'])){
    // Instansiasi Class Aauth
    $objct = new Auth();
    $act =  $objct->register($_POST);

    // Cek Berhasil
    if($act){
        header("location:?register=success");
    }else {
        header("location:?register=fail#signup");
    }

}

if(isset($_POST['login'])){
    // Instansiasi Class
    $objct = new Auth();
    $act = $objct->login($_POST);

    // Cek Berhasil
    if($act){
        header("location:peminjam/index.php");
    }else {
        header("location:index.php?loginfail");
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Perpustakaan Online | Login</title>

    <!-- Bootstrap -->
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="assets/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="assets/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">

<?php if(isset($_GET['register'])): ?>

    <?php if($_GET['register'] == 'success') : ?>
    <div class="row justify-content-center">
        <div class="col-lg-4 alert alert-success alert-dismissible" role="alert" style="position: absolute; margin-top: 1rem">
            <button type="button" class="close btn p-2" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="fa fa-close"></span>
            </button>
            <span class="fa fa-check"></span>&nbsp;&nbsp;&nbsp;Registrasi berhasil.
        </div>
    </div>
    <?php elseif ($_GET['register'] == 'fail') : ?>
    <div class="row justify-content-center">
        <div class="col-lg-4 alert alert-warning alert-dismissible" role="alert" style="position: absolute; margin-top: 1rem">
            <button type="button" class="close btn p-2" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="fa fa-close"></span>
            </button>
            <span class="fa fa-warning"></span>&nbsp;&nbsp;&nbsp;Username sudah ada.
        </div>
    </div>
    <?php endif; ?>

<?php elseif(isset($_GET['loginfail'])): ?>
    <div class="row justify-content-center">
        <div class="col-lg-4 alert alert-danger alert-dismissible" role="alert" style="position: absolute; margin-top: 1rem">
            <button type="button" class="close btn p-2" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="fa fa-close"></span>
            </button>
            <span class="fa fa-warning"></span>&nbsp;&nbsp;&nbsp;Username atau password salah.
        </div>
    </div>
<?php elseif(isset($_GET['logout'])): ?>
    <div class="row justify-content-center">
        <div class="col-lg-4 alert alert-success alert-dismissible" role="alert" style="position: absolute; margin-top: 1rem">
            <button type="button" class="close btn p-2" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="fa fa-close"></span>
            </button>
            <span class="fa fa-check"></span>&nbsp;&nbsp;&nbsp;Anda telah logout.
        </div>
    </div>
<?php endif; ?>

    <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
        <section class="login_content">
            
            <form method="POST" action="index.php">
            <h1>Login Form</h1>
            <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
            </div>
            <div>
                <input type="password" name="password" class="form-control" id="pwlogin" placeholder="Password" required="" autocomplete="off" />
            </div>
            <div class="row d-flex justify-content-between">
                <div class="col-md-5 d-flex">
                    <input type="checkbox" class="pb-3" id="show" onclick="showPassword()">
                    <label for="show" class="pl-1" style="padding-top: 0.7rem">show Password</label>
                </div>
                <button class="btn btn-primary rounded col-md-6" type="submit" name="login">Log in</button>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
                <p class="change_link">Belum Punya Akun?
                <a href="index.php#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

            </div>
            </form>
        </section>
        </div>

        <div id="register" class="animate form registration_form">
        <section class="login_content">
            <form method="POST" action="index.php">
            <h1>Create Account</h1>
            <div>
                <input type="text" class="form-control" name="username" placeholder="Username" required/>
            </div>
            <div class="position-relative">
                <input type="password" class="form-control" name="password" id="pwregister" placeholder="Password" pattern=".{8,}" title="Password harus terdiri dari minimal 8 karakter" required="" autocomplete=""/>
                <button type="button" onclick="showPassword()" class="btn position-absolute" style="top: 0; right: 0;"><span class="fa fa-eye"></span></button>
            </div>
            <div>
                <input type="email" class="form-control" name="email" placeholder="Email" required/>
            </div>
            <div>
                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required/>
            </div>
            <div>
                <textarea name="alamat" class="form-control mb-3" rows="2" placeholder="Alamat" required></textarea>
            </div>
            <div>
                <select name="level" class="form-control mb-3" required>
                    <option value="">Pilih Level</option>
                    <option value="peminjam">Peminjam</option>
                    <option value="administrator">Administrator</option>
                </select>
            </div>
            <div>
                <button class="btn btn-primary rounded col-lg-12" type="submit" name="register">Registrasi</button>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
                <p class="change_link">Sudah punya akun ?
                <a href="index.php#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

            </div>
            </form>
        </section>
        </div>
    </div>
    </div>


    <!-- jQuery -->
    <script src="assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="assets/vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="assets/vendors/iCheck/icheck.min.js"></script>
    <!-- PNotify -->
    <script src="assets/vendors/pnotify/dist/pnotify.js"></script>
    <script src="assets/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="assets/vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="assets/build/js/custom.min.js"></script>

    
    <script type="">
        function showPassword(){
            var x = document.getElementById('pwlogin');
            var y = document.getElementById('pwregister');

            // login
            if(x.type === "password"){
                x.type = "text";
            }else{
                x.type = "password";
            }

            // registrasi
            if(y.type === "password"){
                y.type = "text";
            }else{
                y.type = "password";
            }
        }
    </script>
</body>
</html>
