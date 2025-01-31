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
            document.location.href='akun.php';
        </script>";
    exit;
}

$title = 'Daftar mahasiswa';

include 'layout/header.php';

// menampilkan data mahasiswa
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="nav-icon fas fa-user-graduate"></i> Data Mahasiswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Mahasiswa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm rounded">
          <div class="card-header bg-primary text-white">
            <h3 class="card-title">Tabel Data Mahasiswa</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- Action Buttons -->
            <div class="mb-3">
              <a href="tambah-mahasiswa.php" class="btn btn-primary rounded-pill mb-1">
                Tambah
              </a>
              <a href="download-excel-mahasiswa.php" class="btn btn-success rounded-pill mb-1">
                Download Excel
              </a>
              <a href="download-pdf-mahasiswa.php" class="btn btn-danger rounded-pill mb-1">
                Download PDF
              </a>
            </div>

            <!-- Table -->
            <div class="table-responsive">
              <table id="serverside" class="table table-bordered table-hover">
                <thead class="thead-light">
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
                      <td><?= htmlspecialchars($mahasiswa['nama']); ?></td>
                      <td><?= htmlspecialchars($mahasiswa['prodi']); ?></td>
                      <td><?= htmlspecialchars($mahasiswa['jk']); ?></td>
                      <td><?= htmlspecialchars($mahasiswa['telepon']); ?></td>
                      <td class="text-center" width="26%">
                        <a href="detail-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-secondary rounded-pill" data-toggle="tooltip" title="Detail">
                          <i class="fa-solid fa-circle-info"></i> Detail
                        </a>
                        <a href="ubah-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-warning rounded-pill" data-toggle="tooltip" title="Ubah">
                          <i class="fa-regular fa-pen-to-square"></i> Ubah
                        </a>
                        <a href="hapus-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-danger rounded-pill" onclick="return confirm('Yakin Data mahasiswa Akan Dihapus?');" data-toggle="tooltip" title="Hapus">
                          <i class="fa-solid fa-trash-can"></i> Hapus
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col-12 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>

<?php include 'layout/footer.php'; ?>