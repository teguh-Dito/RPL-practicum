<?php
    include_once("inc/inc_koneksi.php");
    include_once("inc/inc_fungsi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangBelajarKita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo url_dasar()?>/css/style.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>
<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href='<?php echo url_dasar() ?>'>RuangKita</a></div>
            <div class="menu">
                <ul>
                    <li><a href="<?php echo url_dasar() ?>#home">Home</a></li>
                    <li><a href="courses.php">Courses</a></li>
                    <li><a href="tutors.php">Subscription</a></li>
                    
                    <li><a href="<?php echo url_dasar() ?>#partners">Partners</a></li>
                    <li><a href="<?php echo url_dasar() ?>#contact">Contact</a></li>
                    <li><a href="formlogin/logout-user.php" class="tbl-biru">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">