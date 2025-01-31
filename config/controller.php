<?php

function select($query)
{
 global $db;
 $result =mysqli_query($db, $query);
 $rows = [];
 while($row = mysqli_fetch_array($result))
 { 
    $rows[] = $row;
    }
    return $rows;
return $result;
}

function create_barang($post)
{
    global $db;

    $nama = $post['nama'];
    $jumlah = $post['jumlah'];
    $harga = $post['harga'];
    $barcode = rand(100000, 999999);

    //query tambah 
    $query = "INSERT INTO barang VALUES(null, '$nama', '$jumlah', '$harga', '$barcode', CURRENT_TIMESTAMP())";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function update_barang($post)
{
    global $db;

    $id_barang = $post['id_barang'];
    $nama = $post['nama'];
    $jumlah = $post['jumlah'];
    $harga = $post['harga'];


    
    $query = "UPDATE barang SET nama = '$nama', jumlah = '$jumlah' , harga = '$harga' WHERE id_barang = $id_barang";
    
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function delete_barang($id_barang)

{
    global $db;
    $query = "DELETE FROM barang WHERE id_barang = $id_barang";
    
    mysqli_query($db, $query);
    
    return mysqli_affected_rows($db);
    


}

function create_mahasiswa($post)
{
    global $db;

    $nama       =   ($post['nama']);
    $prodi      =   ($post['prodi']);
    $jk         =   ($post['jk']);
    $telepon    =   ($post['telepon']);
    $alamat    =   $post['alamat'];   
    $email      =   ($post['email']);
    $foto       = upload_file();
   
    if (!$foto) {
        return false;
    }

    //query tambah data
    $query = "INSERT INTO mahasiswa VALUES(null, '$nama', '$prodi', '$jk', '$telepon', '$alamat','$email', '$foto')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


// fungsi upload file
function upload_file()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // cek jika ada error dalam upload
    if ($error !== 0) {
        echo "<script> 
        alert('Terjadi kesalahan saat mengupload file!');
        document.location.href = 'tambah-mahasiswa.php';
        </script>";
        die();
    }

    // cek format/extensi file
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile = explode('.', $namaFile);
    $extensifile = strtolower(end($extensifile));

    if (!in_array($extensifile, $extensifileValid)) {
        // format file tidak valid
        echo "<script> 
        alert('Format File Tidak Valid!');
        document.location.href = 'tambah-mahasiswa.php';
        </script>";
        die();
    }

    // cek ukuran file (max 2MB)
    if ($ukuranFile > 2048000) {
        // ukuran file lebih besar dari 2MB
        echo "<script> 
        alert('Ukuran File Tidak Boleh Lebih Dari 2MB!');
        document.location.href = 'tambah-mahasiswa.php';
        </script>";
        die();
    }

    // generate nama file baru
    $namaFileBaru = uniqid(); // Membuat nama file unik
    $namaFileBaru .= '.' . $extensifile; // Menambahkan ekstensi file yang valid

    // pindahkan file ke folder tujuan
    $folderTujuan = 'assets/img/' . $namaFileBaru;
    if (move_uploaded_file($tmpName, $folderTujuan)) {
        return $namaFileBaru; // Mengembalikan nama file yang berhasil diupload
    } else {
        echo "<script> 
        alert('Terjadi kesalahan saat memindahkan file!');
        document.location.href = 'tambah-mahasiswa.php';
        </script>";
        die();
    }
}


function delete_mahasiswa($id_mahasiswa)
{
    global $db;

    //query hapus data mahasiswa
    $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// function update_mahasiswa($post)
// {
//     global $db;

    
//     $id_mahasiswa = strip_tags($post['id_mahasiswa, ']);
//     $nama = strip_tags($post['nama']);
//     $prodi = strip_tags($post['prodi']);
//     $jk = strip_tags($post['jk']);
//     $telepon = strip_tags($post['telepon']);
//     $email = strip_tags($post['email']);
//     $foto = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
//     unlink("assets/img/". $foto['foto']) ;
    
//     $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";

    
//     mysqli_query($db, $query);
    
//     return mysqli_affected_rows($db);
// }

function update_mahasiswa($post)
{
    global $db;

    $id_mahasiswa = strip_tags($post['id_mahasiswa']);
    $nama = strip_tags($post['nama']);
    $prodi = strip_tags($post['prodi']);
    $jk = strip_tags($post['jk']);
    $telepon = strip_tags($post['telepon']);
    $alamat = $post['alamat'];
    $email = strip_tags($post['email']);
    $fotolama = strip_tags($post['fotolama']);
    ;

    // check upload foto baru atau tidak
    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotolama;
    } else {
        $foto = upload_file();
    }

    //query ubah data
    $query = "UPDATE mahasiswa SET 
    nama = '$nama', 
    prodi = '$prodi', 
    jk = '$jk', 
    telepon = '$telepon', 
    alamat = '$alamat',
    email = '$email', 
    foto = '$foto' WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function create_akun($post)
{
    global $db;

    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $email = strip_tags($post['email']);
    $password = strip_tags($post['password']);
    $level = strip_tags($post['level']);

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //query tambah data
    $query = "INSERT INTO akun VALUES(null, '$nama', '$username', '$email', '$password', '$level')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function delete_akun($id_akun)
{
    global $db;

    //query hapus data akun
    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);


}


function update_akun($post)
{
    global $db;

    $id_akun = strip_tags($post['id_akun']);
    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $email = strip_tags($post['email']);
    $password = strip_tags($post['password']);
    $level = strip_tags($post['level']);

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //query ubah data
    $query = "UPDATE akun SET nama = '$nama', username = '$username', email = '$email', password = '$password', level = '$level' WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}



function create_pegawai($post)
{
    global $db;

    $nama       =   ($post['nama']);
    $jabatan        =   ($post['jabatan']);
    $email      =   ($post['email']);
    $telepon    =   ($post['telepon']);
    $alamat    =   ($post['alamat']);   
   

    //query tambah data
    $query = "INSERT INTO pegawai VALUES(null, '$nama', '$jabatan', '$telepon', '$alamat','$email',)";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}