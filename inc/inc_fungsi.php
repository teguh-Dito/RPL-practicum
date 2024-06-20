<?php

function url_dasar(){
    // $_SERVER['SERVER_NAME'] : Memberikan alamat website (misalkan teguh.com)
    // $_SERVER['SCRIPT_NAME'] : menyimpan directory website (misalkan teguh.com/status) (status adalah script name)
    $url_dasar = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']);

    return $url_dasar;
}

function ambil_gambar($id_tulisan){
    global $koneksi;
    $sql1 = "select * from halaman where id = '$id_tulisan'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $text = $r1['isi'];

    preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $text, $img);
    $gambar = $img[1]; // ../images/a97da629b098b75c294dffdc3e463904.jpg
    $gambar = str_replace("../images/", url_dasar()."/images/", $gambar);
    return $gambar;
}

function ambil_kutipan($id_tulisan){
    global $koneksi;
    $sql1 = "select * from halaman where id = '$id_tulisan'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $text = $r1['kutipan'];
    return $text;
}

function ambil_judul($id_tulisan){
    global $koneksi;
    $sql1 = "select * from halaman where id = '$id_tulisan'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $text = $r1['judul'];
    return $text;
}

function ambil_isi($id_tulisan){
    global $koneksi;
    $sql1 = "select * from halaman where id = '$id_tulisan'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $text = strip_tags($r1['isi']);
    return $text;
}

function bersihkan_judul($judul){
    $judul_baru = strtolower($judul);
    $judul_baru = preg_replace("/[^a-zA-Z0-9\s]/", "", $judul_baru);
    $judul_baru = str_replace(" ", "-", $judul_baru);
    return $judul_baru;
}

function buat_link_halaman($id){
    global $koneksi;
    $sql1 = "select * from halaman where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    // $judul = $r1['judul'];
    $judul = bersihkan_judul($r1['judul']);
    // http://localhost/belajar/ProjectOnlineCourse/CobaCourse/admin/halaman.php/8/judul
    // return $judul;
    return url_dasar()."/halaman.php/$id/$judul";
}

function dapatkan_id(){
    $id = "";
    if(isset($_SERVER['PATH_INFO'])){
        $id = dirname($_SERVER['PATH_INFO']);
        $id = preg_replace("/[^0-9]/", "", $id);
    }
    return $id;
}

function set_isi($isi){
    $isi = str_replace("../images/", url_dasar()."/images/",$isi);
    return $isi;
}

function maximum_kata($isi, $maximum){
    $array_isi = explode(" ", $isi);
    $array_isi = array_slice($array_isi, 0, $maximum);
    $isi = implode(" ", $array_isi);
    return $isi;
}

function tutors_foto($id){
    global $koneksi;
    $sql1 = "select * from tutors where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $foto = $r1['foto'];

    if($foto){
        return $foto;
    }
    else{
        return 'tutors_default_icture.png';
    }
}

function buat_link_tutors($id){
    global $koneksi;
    $sql1 = "select * from tutors where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    // $judul = $r1['judul'];
    $nama = bersihkan_judul($r1['nama']);
    // http://localhost/belajar/ProjectOnlineCourse/CobaCourse/admin/halaman.php/8/judul
    // return $judul;
    return url_dasar()."/tutors.php/$id/$nama";
}

function partners_foto($id){
    global $koneksi;
    $sql1 = "select * from partners where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $foto = $r1['foto'];

    if($foto){
        return $foto;
    }
    else{
        return 'partners_default_icture.png';
    }
}

function buat_link_partners($id){
    global $koneksi;
    $sql1 = "select * from partners where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    // $judul = $r1['judul'];
    $nama = bersihkan_judul($r1['nama']);
    // http://localhost/belajar/ProjectOnlineCourse/CobaCourse/admin/halaman.php/8/judul
    // return $judul;
    return url_dasar()."/partners.php/$id/$nama";
}

function ambil_isi_info($id, $kolom){
    global $koneksi;
    $sql1 = "select $kolom from info where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    return $r1[$kolom];
}

function course_video($id){
    global $koneksi;
    $sql1 = "select * from course where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $video = $r1['video'];

    if($video){
        return $video;
    }
    else{
        return 'video_default_icture.png';
    }
}