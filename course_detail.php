<?php
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
include_once("inc_header.php");

// Get the course parameter from the URL
$course = isset($_GET['course']) ? $_GET['course'] : '';

$course_titles = [
    'materi_uas' => 'Materi UAS',
    'try_out' => 'Try Out',
    'snbt' => 'SNBT',
    'mandiri' => 'Mandiri'
];

$course_videos = [
    'materi_uas' => 'video/uas.mp4',
    'try_out' => 'video/tryout.mp4',
    'snbt' => 'video/snbt.mp4',
    'mandiri' => 'video/mandiri.mp4'
];

// Ensure a valid course was selected
if (!array_key_exists($course, $course_titles)) {
    header('Location: courses.php');
    exit;
}

$course_title = $course_titles[$course];
$course_video = $course_videos[$course];
?>
    
    <div class="container mt-5">
        <a href="courses.php" class="btn btn-primary">Back</a>
        <p style="font-size:36px; font-weight:500; width: 200px"><?php echo $course_title; ?></p>
        <p>Watch the video below to learn more about <?php echo $course_title; ?>.</p>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="embed-responsive embed-responsive-16by9">
                    <video class="embed-responsive-item" controls>
                        <source src="<?php echo $course_video; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    <?php 
    include_once("inc_footer.php");
    ?>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
