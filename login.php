<?php
session_start();

include 'config/app.php';

// cek apakh tombol login dpat di tekan
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $secret_key = "6LfD7ggqAAAAALNBUQexKPIdtNNwegV148xucQME";

    $verifikasi = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $_POST['g-recaptcha-response']);

    $response = json_decode($verifikasi);

    if ($response->success) {
        $result = mysqli_query($db, "SELECT * FROM akun WHERE username = '$username'");

        if (mysqli_num_rows($result) == 1) {
            $hasil = mysqli_fetch_assoc($result);

            if (password_verify($password, $hasil['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['id_akun'] = $hasil['id_akun'];
                $_SESSION['nama'] = $hasil['nama'];
                $_SESSION['username'] = $hasil['username'];
                $_SESSION['email'] = $hasil['email'];
                $_SESSION['level'] = $hasil['level'];

                header("Location: index.php");
                exit;
            } else {
                $errorAuth = true;
            }
        } else {
            $errorAuth = true;
        }
    } else {
        $errorRecaptcha = true;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">




    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">

    <!-- Favicons -->

    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
</head>
<body class="text-center">

    <main class="form-signin">
        <form action="" method="POST">
            <img class="mb-4" src="assets/img/logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Silahkan Login</h1>

            <?php if (isset($errorAuth)) : ?>
                <div class="alert alert-danger">
                    <b>Username/Password SALAH</b>
                </div>
            <?php endif; ?>

            <?php if (isset($errorRecaptcha)) : ?>
                <div class="alert alert-danger text-center">
                    <b>Recaptcha Tidak Valid</b>
                </div>
            <?php endif; ?>

            <div class="form-floating">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username" required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>

            <div class="mb-3">
                <div class="g-recaptcha" data-sitekey="6LfD7ggqAAAAAI6xTRycQzsNyt5f2b2fq0vi5XTN"></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>
                </div>
            </div>
        </form>
        <!-- jQuery -->
        <script src="assets-template/plugins/jquery/jquery.min.js"></script>

        <script src="assets-template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets-template/dist/js/adminlte.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js"></script>
    </main>

</body>

</html>