<?php include ("inc_header.php"); 
// include("inc/inc_fungsi.php");
?>

<?php
$nama = "";
// $kutipan = "";
$isi = "";
$video = "";
$video_name = "";
$error = "";
$sukses = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = "";
}

if($id != ""){
    $sql1 = "select * from course where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nama = $r1['nama'];
    // $kutipan = $r1['kutipan'];
    $isi = $r1['isi'];
    $video = $r1['video'];

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

    // Array ( [video] => Array ( [name] => 7.png [full_path] => 7.png [type] => image/png [tmp_name] => C:\xampp\tmp\phpAE7B.tmp [error] => 0 [size] => 1647569 ) )
    // print_r($_FILES);
    if($_FILES['video']['name']){
        $video_name = $_FILES['video']['name'];
        $video_file = $_FILES['video']['tmp_name'];

        $detail_file = pathinfo($video_name);
        $video_ekstensi= $detail_file['extension'];
        // print_r($detail_file);
        // Array ( [dirname] => . [basename] => 7.png [extension] => png [filename] => 7 )
        $ekstensi_diperbolehkan = array("jpg", "jpeg", "mp4", "gif");
        if(!in_array($video_ekstensi, $ekstensi_diperbolehkan)){
            $error = "Ekstensi yang diperbolehkan adalah mp4, jpeg, png, dan gif";
        }
    }

    if (empty($error)) {
        if($video_name){
            $direktori = "../images";
            @unlink($direktori."/$video"); // delete data
            $video_name = "course_".time()."_".$video_name;
            move_uploaded_file($video_file, $direktori."/".$video_name);

            $video = $video_name;
        }else{
            $video_name = $video; // memasukkan data dari data sebelumnya ada
        }

        if($id != ""){ // proses edit
            $sql1 = "update course set nama='$nama',video='$video_name', isi='$isi', tgl_isi=now() where id= '$id'";
        }
        else{ // proses insert
            // $sql1 = "insert into course(nama,video isi) values('$nama','$video_name', '$isi')";
            $sql1 = "insert into course(nama, video, isi) values('$nama','$video_name', '$isi')";
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
<h1>Halaman Admin Input Data course</h1>
<div class="mb-3 row">
    <a href="course.php">
        << Kembali ke halaman admin course
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
        <label for="kutipan" class="col-sm-2 col-form-label">video</label>
        <div class="col-sm-10">
            <?php 
                if($video){
                    echo "<img src='../images/$video' style='max-height: 100px; max-width: 100px;'>";
                }
            ?>
            <input type="file" class="form-control" id="video" name="video">
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