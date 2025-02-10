<?php
session_start();

if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}

if ($_SESSION["level"] != 1 and $_SESSION["level"] != 2) {
    echo "<script>
            alert('Perhatian Anda Tidak Punya Hak Akses!!');
            document.location.href='akun.php';
        </script>";
    exit;
}

$title = 'Daftar Barang';
include 'layout/header.php';

$jumlahDataPerhalaman = 5;
$halamanAktif = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
$jumlahHalaman = 1; // Default value to avoid undefined variable warning

if (isset($_POST['filter'])) {
    $harga_min = (int)strip_tags($_POST['harga_min']);
    $harga_max = (int)strip_tags($_POST['harga_max']);

    $data_barang = select("SELECT * FROM barang WHERE harga BETWEEN $harga_min AND $harga_max ORDER BY harga ASC");
} else {
    $jumlahData = count(select("SELECT * FROM barang"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
    $data_barang = select("SELECT * FROM barang ORDER BY id_barang DESC LIMIT $awalData, $jumlahDataPerhalaman");
}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm rounded">
          <div class="card-header bg-primary text-white">
            <h3 class="card-title"><i class="nav-icon fas fa-box"></i> Data Barang</h3>
          </div>
          <div class="card-body">
            <!-- Action Buttons -->
            <div class="mb-3">
              <a href="tambah-barang.php" class="btn btn-primary rounded-pill px-4 py-2" data-toggle="tooltip" title="Tambah Barang">
              Tambah Barang
              </a>
              <button type="button" class="btn btn-success rounded-pill px-4 py-2" data-toggle="modal" data-target="#modalFilter" data-toggle="tooltip" title="Filter Data">
                <i class="fas fa-search"></i> Filter Data
              </button>
            </div>

            <!-- Table -->
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead class="thead-light">
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Barcode</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = $awalData + 1; ?>
<?php foreach ($data_barang as $barang): ?>
  <tr>
    <td><?= $no++; ?></td>
    <td><?= htmlspecialchars($barang['nama']); ?></td>
    <td><?= htmlspecialchars($barang['jumlah']); ?></td>
    <td>RP. <?= number_format($barang['harga'], 0, ',', '.'); ?></td>
    <td class="text-center">
      <img src="barcode.php?codetype=Code128&size=15&text=<?= htmlspecialchars($barang['barcode']); ?>&print=true" alt="barcode">
    </td>
    <td><?= date("d/m/Y | H:i:s", strtotime($barang['tanggal'])); ?></td>
    <td class="text-center">
      <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-warning rounded-pill" data-toggle="tooltip" title="Ubah Data">
        Ubah
      </a>
      <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger rounded-pill" onclick="return confirm('Yakin Data Barang Akan Dihapus?');" data-toggle="tooltip" title="Hapus Data">
        Hapus
      </a>
    </td>
  </tr>
<?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-4">
              <ul class="pagination justify-content-center">
                <?php if ($halamanAktif > 1) : ?>
                  <li class="page-item">
                    <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                  <li class="page-item <?= $i == $halamanAktif ? 'active' : ''; ?>">
                    <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                  </li>
                <?php endfor; ?>

                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                  <li class="page-item">
                    <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </nav>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <!-- /.content -->
  </div>


<!-- Modal Filter -->
<div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title"><i class="fas fa-search"></i> Filter Data Berdasarkan Harga</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="harga_min">Harga Minimum</label>
            <input type="number" name="harga_min" id="harga_min" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="harga_max">Harga Maksimum</label>
            <input type="number" name="harga_max" id="harga_max" class="form-control" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" name="filter" class="btn btn-primary">Filter</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




  <?php include 'layout/footer.php' ?>