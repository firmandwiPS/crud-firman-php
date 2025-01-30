<?php

session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}

if ($_SESSION["level"] != 1 and $_SESSION["level"] != 3 ) {
    echo "<script>
            alert('Perhatian Anda Tidak Punya Hak Akses!!');
            document.location.href='crud-modal.php';
        </script>";
    exit;
}

$title = 'Daftar mahasiswa';

include 'layout/header.php';

// menampilkan data mahasiswa
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");

?>

<div class="container mt-5">
    <h1><i class="fa-solid fa-users-line"></i> Data MahaSiswa </h1>
    <hr>
    <a href="tambah-mahasiswa.php" class="btn btn-primary mb-1"><i class="fa-solid fa-circle-plus">
    </i> Tambah</a>
    <a href="download-excel-mahasiswa.php" class="btn btn-success mb-1"><i class="fas fa-file-excel">
    </i> Download Excel</a>
    <a href="download-pdf-mahasiswa.php" class="btn btn-danger mb-1"><i class="fa-solid fa-circle-plus"></i> Download
        PDF</a>

    <table class="table table-bordered table-striped mt-3" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Jenis Kelamin</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_mahasiswa as $mahasiswa): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $mahasiswa['nama']; ?></td>
                    <td><?= $mahasiswa['prodi']; ?></td>
                    <td><?= $mahasiswa['jk']; ?></td>
                    <td><?= $mahasiswa['telepon']; ?></td>
                    <td class="text-center" width="26%">
                        <a href="detail-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>"
                            class="btn btn-secondary"><i class="fa-solid fa-circle-info"></i> Detail</a>
                        <a href="ubah-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-success"><i
                                class="fa-regular fa-pen-to-square"></i> Ubah</a>
                        <a href="hapus-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-danger"
                            onclick="return confirm('Yakin Data mahasiswa Akan Dihapus.');"><i
                                class="fa-solid fa-trash-can"></i> Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'layout/footer.php'; ?>