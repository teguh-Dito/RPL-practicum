<?php
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
include_once("inc_header.php");
?>
    <br>
    <div class="container mt-5">
        <p style="font-size:36px; font-weight:500;">Our Courses</p>
        <p>Choose from a variety of courses tailored to your needs</p>
        
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card">
                    <img src="course_images/uas.png" class="card-img-top" alt="Materi UAS">
                    <div class="card-body">
                        <h5 class="card-title">Materi UAS</h5>
                        <p class="card-text">Comprehensive UAS materials to help you prepare effectively.</p>
                        <br>
                        <a href="course_detail.php?course=materi_uas" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="course_images/tryout.png" class="card-img-top" alt="Try Out">
                    <div class="card-body">
                        <h5 class="card-title">Try Out</h5>
                        <p class="card-text"><br>Mock tests to simulate the real exam environment.</p>
                        <a href="course_detail.php?course=try_out" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="course_images/snbt.png" class="card-img-top" alt="SNBT">
                    <div class="card-body">
                        <h5 class="card-title">SNBT</h5>
                        <p class="card-text"><br>Specialized materials for SNBT preparation.</p>
                        <br>
                        <a href="course_detail.php?course=snbt" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="course_images/mandiri.png" class="card-img-top" alt="Mandiri">
                    <div class="card-body">
                        <h5 class="card-title">Mandiri</h5>
                        <p class="card-text"><br>Independent study materials for self-paced learning.</p>
                        <a href="course_detail.php?course=mandiri" class="btn btn-primary">Learn More</a>
                    </div>
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
