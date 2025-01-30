<?php
include 'config/app.php';

$id_barang = (int)$_GET['id_barang'];

session_start();

if (!isset($_SESSION["login"])) {
    echo"<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
  }

    if (delete_barang($id_barang) > 0 )
    {
        echo"<script> 
        alert('Data barang Berhasil DiHapus');
        document.location.href='index.php';
        </script>";
    } else {
        echo"<script> 
        alert('Data barang Gagal Diapus');
        document.location.href='index.php';
        </script>";

    }


    

