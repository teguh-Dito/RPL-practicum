<?php
include_once("inc_header.php");
?>

<style>
    /* Subscription Section Styles */
    #subscription {
        padding: 60px 0;
        background-color: #f9f9f9;
    }

    .subscription-options {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 20px;
    }

    .kartu-subscription {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        max-width: 300px;
        padding: 20px;
        text-align: center;
        transition: transform 0.3s;
    }

    .kartu-subscription:hover {
        transform: scale(1.05);
    }

    .kartu-subscription h3 {
        color: #333;
        margin-bottom: 15px;
        font-size: 24px;
    }

    .kartu-subscription p {
        color: #666;
        margin-bottom: 20px;
        font-size: 16px;
    }

    .kartu-subscription .price {
        color: #000;
        font-size: 20px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .kartu-subscription .tbl-pink, .kartu-subscription .tbl-biru {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s, color 0.3s;
    }

    .kartu-subscription .tbl-pink {
        background-color: #ff7675;
        color: white;
    }

    .kartu-subscription .tbl-pink:hover {
        background-color: #e84342;
        color: white;
    }

    .kartu-subscription .tbl-biru {
        background-color: #0984e3;
        color: white;
    }

    .kartu-subscription .tbl-biru:hover {
        background-color: #0652dd;
        color: white;
    }
</style>

<section id="subscription">
    <div class="tengah">
        <div class="kolom">
            <p class="deskripsi">Subscribe to Access Our Tutors</p>
            <h2>Subscription Plans</h2>
            <p>Select a subscription plan to access our top tutors and their premium content.</p>
        </div>
        <div class="subscription-options">
            <div class="kartu-subscription">
                <h3>Regular Plan</h3>
                <p class="price">Price: 100000</p>
                <p>Access to all regular content and tutors.</p>
                <a href="payment.php?plan=regular" class="tbl-pink">Subscribe</a>
            </div>
            <div class="kartu-subscription">
                <h3>Premium Plan</h3>
                <p class="price">Price: 200000</p>
                <p>Access to all premium content and tutors.</p>
                <a href="payment.php?plan=premium" class="tbl-biru">Subscribe</a>
            </div>
        </div>
    </div>
</section>

<?php
include_once("inc_footer.php");
?>
