<?php include ("inc_header.php") ?>
<?php
$nama = "";
// $kutipan = "";
$isi = "";
$foto = "";
$foto_name = "";
$error = "";
$sukses = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = "";
}

if($id != ""){
    $sql1 = "select * from partners where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nama = $r1['nama'];
    // $kutipan = $r1['kutipan'];
    $isi = $r1['isi'];
    $foto = $r1['foto'];

    if($isi == ''){
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $isi = $_POST['isi'];
    // $kutipan = $_POST['kutipan'];

    if ($nama == '' or $isi == '') {
        $error = "Silahkan isi data terlebih dahulu!";
    }

    // Array ( [foto] => Array ( [name] => 7.png [full_path] => 7.png [type] => image/png [tmp_name] => C:\xampp\tmp\phpAE7B.tmp [error] => 0 [size] => 1647569 ) )
    // print_r($_FILES);
    if($_FILES['foto']['name']){
        $foto_name = $_FILES['foto']['name'];
        $foto_file = $_FILES['foto']['tmp_name'];

        $detail_file = pathinfo($foto_name);
        $foto_ekstensi= $detail_file['extension'];
        // print_r($detail_file);
        // Array ( [dirname] => . [basename] => 7.png [extension] => png [filename] => 7 )
        $ekstensi_diperbolehkan = array("jpg", "jpeg", "png", "gif");
        if(!in_array($foto_ekstensi, $ekstensi_diperbolehkan)){
            $error = "Ekstensi yang diperbolehkan adalah jpg, jpeg, png, dan gif";
        }
    }

    if (empty($error)) {
        if($foto_name){
            $direktori = "../images";
            @unlink($direktori."/$foto"); // delete data
            $foto_name = "partners_".time()."_".$foto_name;
            move_uploaded_file($foto_file, $direktori."/".$foto_name);

            $foto = $foto_name;
        }else{
            $foto_name = $foto; // memasukkan data dari data sebelumnya ada
        }

        if($id != ""){ // proses edit
            $sql1 = "update partners set nama='$nama',foto='$foto_name', isi='$isi', tgl_isi=now() where id= '$id'";
        }
        else{ // proses insert
            // $sql1 = "insert into partners(nama,foto isi) values('$nama','$foto_name', '$isi')";
            $sql1 = "insert into partners(nama, foto, isi) values('$nama','$foto_name', '$isi')";
        }
        $q1 = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $sukses = "Sukses Memasukkan Data";
        } else {
            $error = "Data Gagal Dimasukkan";
        }
    }
}
?>
<h1>Halaman Admin Input Data partners</h1>
<div class="mb-3 row">
    <a href="partners.php">
        << Kembali ke halaman admin partners
    </a>
</div>

<?php
if ($error) {
    ?>
        <div class="alert alert-danger" role="alert">
           <?php echo $error ?>
        </div>
    <?php
}
?>

<?php
if ($sukses) {
    ?>
        <div class="alert alert-primary" role="alert">
           <?php echo $sukses ?>
        </div>
    <?php
}
?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" value="<?php echo $nama ?>" name="nama">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="kutipan" class="col-sm-2 col-form-label">Foto</label>
        <div class="col-sm-10">
            <?php 
                if($foto){
                    echo "<img src='../images/$foto' style='max-height: 100px; max-width: 100px;'>";
                }
            ?>
            <input type="file" class="form-control" id="foto" name="foto">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="isi" class="col-sm-2 col-form-label">Isi</label>
        <div class="col-sm-10">
            <textarea name="isi" class="form-control" id="summernote"><?php echo $isi ?></textarea>
        </div>
    </div>

    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
        </div>
    </div>


</form>
<?php include ("inc_footer.php") ?>