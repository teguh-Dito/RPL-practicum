<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include("../inc/inc_koneksi.php");
include("../inc/inc_fungsi.php");

// Mendapatkan nama file saat ini
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <link href="../css/summernote-image-list.min.css">
    <script src="../js/summernote-image-list.min.js"></script>

    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-b65ba6efdfc8a0938d2ba59fb4cb2a9118cf03e4b8c7a5e847c48d46a4d695c0" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.css">

    <style>
        .image-list-content .col-lg-3{
            width: 100%;
        }
        .image-list-content img{
            float:left;
            width:20%;
        }
        .image-list-content p{
            float:left;
            padding-left:20%;
        }
        .image-list-item{
            padding: 10px 0px 10px 0px;
        }
    </style>
</head>
<body class="container">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php">Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php if($current_page == 'halaman.php'){echo 'active';} ?>" href="halaman.php">Halaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($current_page == 'tutors.php'){echo 'active';} ?>" href="tutors.php">Tutors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($current_page == 'partners.php'){echo 'active';} ?>" href="partners.php">Partner</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link <?php if($current_page == 'contact.php'){echo 'active';} ?>" href="contact.php">Contact</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link <?php if($current_page == 'member.php'){echo 'active';} ?>" href="member.php">Member</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($current_page == 'course.php'){echo 'active';} ?>" href="course.php">Course</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout>></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
