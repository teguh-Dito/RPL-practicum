<?php
include_once("inc_header.php");

// Get the plan from the URL
$plan = isset($_GET['plan']) ? $_GET['plan'] : 'regular';

?>

<style>
    /* Form Section Styles */
    #subscription-form {
        padding: 60px 0;
        background-color: #f9f9f9;
    }

    .form-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        max-width: 500px;
        margin: auto;
        padding: 20px;
    }

    .form-container h2 {
        color: #333;
        margin-bottom: 15px;
        font-size: 24px;
        text-align: center;
    }

    .form-container label {
        display: block;
        margin-bottom: 5px;
        color: #666;
    }

    .form-container input[type="text"], .form-container input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .form-container input[type="submit"] {
        background-color: #0984e3;
        color: white;
        border: none;
        cursor: pointer;
    }

    .form-container input[type="submit"]:hover {
        background-color: #0652dd;
    }
</style>

<section id="subscription-form">
    <div class="form-container">
        <h2>Enter Your Details</h2>
        <form action="payment.php" method="POST">
            <input type="hidden" name="plan" value="<?php echo $plan; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            <label for="bank_number">Bank Number:</label>
            <input type="text" id="bank_number" name="bank_number" required>
            <input type="submit" value="Proceed to Payment">
        </form>
    </div>
</section>

<?php
include_once("inc_footer.php");
?>
