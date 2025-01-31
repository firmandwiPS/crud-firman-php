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

$title = 'Daftar Pegawai';

include 'layout/header.php';
$data_pegawai = select("SELECT * FROM pegawai ORDER BY id_pegawai DESC");

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="nav-icon fas fa-user"></i> Data pegawai</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Pegawai</li>
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
            <h3 class="card-title">Tabel Data Pegawai</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- Action Buttons -->
            <div class="mb-3">
              <!-- <a href="tambah-pegawai.php" class="btn btn-primary rounded-pill mb-1">
                <i class="fa-solid fa-circle-plus"></i> Tambah Pegawai
              </a> -->
            </div>

            <!-- Table -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead class="thead-light">
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                  </tr>
                </thead>
                <tbody id="live_data">
                  <!-- Data will be populated here dynamically -->
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
    </div>


    <script>
       $('document').ready(function(){
        setInterval(function(){
            getPegawai()
        }, 200)
    });

    function getPegawai() {
        $.ajax({
            url : "realtime-pegawai.php",
            type : "GET",
            success: function(response) {
                $('#live_data').html(response)
            }
        });
    }
    </script>

<?php include 'layout/footer.php'; ?>