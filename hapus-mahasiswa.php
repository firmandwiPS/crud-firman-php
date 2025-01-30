<?php
include 'config/app.php';

$id_barang = (int)$_GET['id_mahasiswa'];

session_start();


if (!isset($_SESSION["login"])) {
    echo"<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
  }

    if (delete_mahasiswa($id_barang) > 0 )
    {
        echo"<script> 
        alert('Data Mahasiswa Berhasil DiHapus');
        document.location.href='mahasiswa.php';
        </script>";
    } else {
        echo"<script> 
        alert('Data Mahasiswa Gagal Diapus');
        document.location.href='index.php';
        </script>";

    }


    

