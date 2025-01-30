<?php


    session_start();


if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}

if ($_SESSION["level"] != 1 and $_SESSION["level"] != 2 ) {
    echo "<script>
            alert('Perhatian Anda Tidak Punya Hak Akses!!');
            document.location.href='crud-modal.php';
        </script>";
    exit;
}


$title = 'Daftar Barang';

include 'layout/header.php';

$data_barang = select("SELECT * FROM barang ORDER BY id_barang ASC");
?>


<div class="container mt-5">
    <h1><i class="fa-solid fa-boxes-stacked"></i> Data Barang</h1>
    <hr>
    <a href="tambah-barang.php" class="btn btn-primary mb-1"><i class="fa-solid fa-circle-plus"></i> Tambah</a>

    <table class="table table-bordered table-striped mt-3" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>barcode</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_barang as $barang): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $barang['nama']; ?></td>
                    <td><?= $barang['jumlah']; ?></td>
                    <td>RP. <?= number_format($barang['harga'], 0, ',', '.'); ?></td>
                    <td class="text-center">
                        <img src="barcode.php?codetype=Code128&size=15&text=<?= $barang['barcode']; ?>&print=true"
                            alt="barcode">
                    </td>
                    <td><?= date("d/m/Y | H:i:s", strtotime($barang['tanggal'])); ?></td>
                    <td width="20%" class="text-center">
                        <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-success"><i class="fa-regular fa-pen-to-square"></i> Ubah</a>
                        <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger"
                            onclick="return confirm('Yakin Data Barang Akan Dihapus.');"><i class="fa-solid fa-trash"></i> Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'layout/footer.php'; ?>