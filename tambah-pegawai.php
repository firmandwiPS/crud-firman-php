<?php

session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}


$title = 'Tambah Mahasiswa';

include 'layout/header.php';

if (isset($_POST['tambah'])) {
    if (create_pegawai($_POST) > 0) {
        echo "<script>
            alert('Data mahaSiswa Berhasil Ditambahkan');
            document.location.href = 'pegawai.php';
            </script>";
    } else {
        // echo "<script>
        // alert('Data mahaSiswa Gagal Ditambahkan');
        //     document.location.href = 'pegawai.php';
        //     </script>";
    }
}
?>

<div class="container mt-5">
    <h1> Tambah Data Pegawai </h1>
    <hr>
    <a href="pegawai.php" class="btn btn-primary mb-3 rounded-pill"><i class="fa-solid fa-right-from-bracket"></i> Kembali</a>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pegawai</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai..." required>
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan..." required>
        </div>

        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Telepon..." Required>
        </div>
        
        <div class="mb-3">
            <label for="Alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control"></textarea>
        </div>


        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email..." Required>
        </div>

        <button type="submit" name="tambah" class="btn btn-primary rounded-pill" style="float: right;"> <i
                class="fas fa-plus"></i>Tambah</button>

    </form>
</div>
<?php include 'layout/footer.php'; ?>