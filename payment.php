<?php
include_once("inc_header.php");

// Database connection
$servername = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "onlinecourse";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form data is set
if (isset($_POST['name'], $_POST['address'], $_POST['bank_number'], $_POST['plan'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $bank_number = $_POST['bank_number'];
    $plan = $_POST['plan'];
    $price = ($plan == 'premium') ? 200000 : 100000;

    // Generate a random payment code
    $payment_code = rand(100000, 999999);

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO payments (name, address, bank_number, plan, price, payment_code) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $name, $address, $bank_number, $plan, $price, $payment_code);

    if ($stmt->execute() === TRUE) {
        // Data inserted successfully
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Redirect to the subscription form if the data is not set
    header('Location: subscription_form.php');
    exit();
}

$conn->close();
?>

<style>
    /* Payment Section Styles */
    #payment {
        padding: 60px 0;
        background-color: #f9f9f9;
    }

    .payment-details {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        max-width: 500px;
        margin: auto;
        padding: 20px;
        text-align: center;
    }

    .payment-details h2 {
        color: #333;
        margin-bottom: 15px;
        font-size: 24px;
    }

    .payment-details p {
        color: #666;
        margin-bottom: 20px;
        font-size: 16px;
    }

    .payment-details .price {
        color: #000;
        font-size: 20px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .payment-details .code {
        background-color: #f0f0f0;
        padding: 10px;
        border-radius: 5px;
        font-size: 18px;
        margin-bottom: 20px;
        display: inline-block;
    }
</style>

<section id="payment">
    <div class="tengah">
        <div class="kolom">
            <p class="deskripsi">Payment for <?php echo ucfirst($plan); ?> Plan</p>
            <h2>Complete Your Payment</h2>
        </div>
        <div class="payment-details">
            <h2><?php echo ucfirst($plan); ?> Plan</h2>
            <p class="price">Price: <?php echo $price; ?></p>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($address); ?></p>
            <p><strong>Bank Number:</strong> <?php echo htmlspecialchars($bank_number); ?></p>
            <p>Use the following code to complete your payment:</p>
            <div class="code"><?php echo $payment_code; ?></div>
            <!-- You can add more payment instructions or a form here -->
        </div>
    </div>
</section>

<?php
include_once("inc_footer.php");
?>
