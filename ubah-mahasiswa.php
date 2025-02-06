<?php

session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}


$title = 'Ubah Mahasiswa';
include 'layout/header.php';


if (isset($_POST['tambah'])) {
    if (update_mahasiswa($_POST) > 0) {
        echo "<script>
                alert('Data mahasiswa Berhasil Di Tambahkan');
                document.location.href='mahasiswa.php';
            </script>";
    } else {
        "<script>
                alert('Data mahasiswa Gagal Di Tambahkan');
                document.location.href='mahasiswa.php';
            </script>";
    }
}

// menagmbil id mahasiswa dari url
$id_mahasiswa = (int) $_GET['id_mahasiswa'];

// menampilkan data mahasiswa
$mahasiswa = mysqli_query($db, "SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa");
$mahasiswa = mysqli_fetch_array($mahasiswa);

?>
<div class="content-wrapper ">
<div class=" container mt-5">
    <h1>Ubah Mahasiswa</h1>
    <hr>
    
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="id_mahasiswa" value="<?= $mahasiswa['id_mahasiswa']; ?>">
        <input type="text" name="fotoLama" value="<?= $mahasiswa['foto']; ?>">
    
        <div class="mb-3">
            <label for="nama" class="form-label">Nama mahasiswa</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama mahasiswa....." required
                value="<?= $mahasiswa['nama'] ?>">
        </div>
    
        <div class="row">
            <div class="mb-3 col-6">
                <label for="prodi" class="form-label">Program Studi</label>
                <select name="prodi" id="prodi" class="form-select" require>
                    <?= $prodi = $mahasiswa ?>
                    <option value="Teknik Informatika" <?= $prodi == 'Teknik Informatika' ? 'Selected' : null ?>>Teknik
                        Informatika</option>
                    <option value="Teknik Mesin" <?= $prodi == 'Teknik Mesin' ? 'Selected' : null ?>>Teknik Mesin
                    <option value="Teknik Vidio" <?= $prodi == 'Teknik Vidio' ? 'Selected' : null ?>>Teknik Vidio
                    </option>
                </select>
            </div>
    
            <div class="mb-3 col">
                <label for="jk" class="form-label">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control" required>
                    <?php $jk = $mahasiswa['jk'] ?>
                    <option value="Laki Laki" <?= $jk == 'Laki-Laki' ? 'selected' : null ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $jk == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                </select>
            </div>
        </div>
    
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon...." required
                value="<?= $mahasiswa['telepon'] ?>">
        </div>
    
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control"> <?= $mahasiswa['alamat']; ?></textarea>
        </div>
    
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email...." required
                value="<?= $mahasiswa['email'] ?>">
        </div>
    
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto....">
            <p>
                <small>
                    Gambar sebelumnya
                </small>
            </p>
            <img src="assets/img/<?= $mahasiswa['foto']; ?>" alt="foto" width="100px">
        </div>
    
        <button type="submit" class="btn btn-primary rounded-pill " name="tambah" style="float: right;">Ubah
    
        </button>
    </form>
    <hr>
    </div>
</div>

<script>
    function previewImg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function (e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?php include 'layout/footer.php'; ?>