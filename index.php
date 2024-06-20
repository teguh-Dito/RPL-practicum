<?php 
require_once "formlogin/controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: formlogin/reset-code.php');
            }
        }
        else{
            header('Location: formlogin/user-otp.php');
        }
    }
}else{
    // header('Location: formlogin/login-user.php');
    // echo "apa coba";
    // header('Location: index.php');
}
if($email == "" && $password == ""){
    header('Location: formlogin/login-user.php');
}
?>
<?php 
    include_once("inc_header.php");
?>
        <!-- untuk home -->
        <section id="home">
            <img src="<?php echo ambil_gambar('2') ?>" width="600px" alt="gambarEducationDay">
            <div class="kolom">
                <p class="deskripsi"><?php echo ambil_kutipan('2') ?></p>
                <h2><?php echo ambil_judul('2') ?></h2>
                <p><?php echo maximum_kata(ambil_isi('2'), 20)?></p>
                <!-- <p><a href="http://localhost/belajar/ProjectOnlineCourse/CobaCourse/admin/halaman.php/8/judul" class="tbl-pink">Pelajari Lebih Lanjut</a></p> -->
                <p><a href="<?php echo buat_link_halaman('2') ?>" class="tbl-pink">Pelajari Lebih Lanjut</a></p>
            </div>
        </section>

        <!-- untuk courses -->
        <section id="courses">
            <div class="kolom">
                <p class="deskripsi"><?php echo ambil_kutipan('8') ?></p>
                <h2><?php echo ambil_judul('8') ?></h2>
                <p><?php echo maximum_kata(ambil_isi('8'), 20) ?></p>
                <p><a href="<?php echo buat_link_halaman('8') ?>" class="tbl-biru">Pelajari Lebih Lanjut</a></p>
            </div>
            <!-- <img src="https://img.freepik.com/free-vector/online-learning-isometric-concept_1284-17947.jpg?size=626&ext=jpg&ga=GA1.2.1769275626.1605867161"/> -->
            <img src="<?php echo ambil_gambar('8') ?>" width="500px">
        </section>

        <!-- untuk tutors -->
        <section id="tutors">
            <div class="tengah">
                <div class="kolom">
                    <p class="deskripsi">Our Top Tutors</p>
                    <h2>Tutors</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, optio!</p>
                </div>

                <div class="tutor-list">
                    <?php 
                        $sql1 = "select * from tutors order by id desc ";
                        $q1 = mysqli_query($koneksi, $sql1);
                        while($r1 = mysqli_fetch_array($q1)){
                            ?>
                                <div class="kartu-tutor">
                                    <a href="<?php echo buat_link_tutors($r1['id']) ?>">
                                        <!-- <img src="https://dfu1k3y1rami2.cloudfront.net/wp-content/uploads/2014/07/26195109/2020_cb.jpg"/> -->
                                        <img src="<?php echo url_dasar()."/images/".tutors_foto($r1['id']) ?>" alt="">
                                        <!-- <p>Lorem, ipsum.</p> -->
                                        <p><?php echo $r1['nama'] ?></p>
                                    </a>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </section>

        <!-- untuk partners -->
        <section id="partners">
            <div class="tengah">
                <div class="kolom">
                    <p class="deskripsi">Our Top Partners</p>
                    <h2>Partners</h2>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi magni tempore expedita sequi. Similique rerum doloremque impedit saepe atque maxime.</p>
                </div>

                <div class="partner-list">
                    <?php 
                        $sql1 = "select * from partners order by id desc ";
                        $q1 = mysqli_query($koneksi, $sql1);
                        while($r1 = mysqli_fetch_array($q1)){
                            ?>
                                <div class="kartu-partner">
                                    <a href="<?php echo buat_link_tutors($r1['id']) ?>">
                                    <!-- <img src="assets/zenius.jpg"/> -->
                                    <img src="<?php echo url_dasar()."/images/".partners_foto($r1['id']) ?>" alt="">
                                    </a>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </section>
    <?php 
        include_once("inc_footer.php");
    ?>