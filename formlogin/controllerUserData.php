<?php 
session_start();
require "connection.php";
$email = "";
$name = "";
$errors = array();

function sendEmail($to, $subject, $message, $headers) {
    if(mail($to, $subject, $message, $headers)){
        return true;
    } else {
        error_log("Failed to send email to $to using headers: $headers");
        return false;
    }
}

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM usertable WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0){
        $userData = mysqli_fetch_assoc($result);
        if(password_verify($password, $userData['password'])){
            $_SESSION['email'] = $userData['email'];
            $_SESSION['password'] = $userData['password'];
            echo "berhasil"; // Menampilkan pesan berhasil (opsional)
            header('location: ../index.php'); // Mengarahkan ke halaman utama
            exit();
        } else {
            $errors['login-error'] = "Invalid email or password!";
        }    
    } else {
        $errors['login-error'] = "Invalid email or password!";
    }
}

if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO usertable (name, email, password, code, status) values('$name', '$email', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code" ;
            $headers = "From: teguhdarmapinan@gmail.com";
            if(sendEmail($email, $subject, $message, $headers)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            error_log("Database insertion error: " . mysqli_error($con));
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }
}

if(isset($_POST['check'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if($update_res){
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header('location: ../index.php');
            // header('location: home.php');
            exit();
        }else{
            $errors['otp-error'] = "Failed while updating code!";
        }
    }else{
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

if(isset($_POST['check-email'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $code = rand(999999, 111111);
        $update_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
        if(mysqli_query($con, $update_code)){
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";
            $headers = "From: teguhdarmapinan@gmail.com";
            if(sendEmail($email, $subject, $message, $headers)){
                $info = "We've sent a password reset otp to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while updating code in database!";
        }
    }else{
        $errors['email'] = "This email address does not exist!";
    }
}

if(isset($_POST['check-reset-otp'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $code = 0;
        $update_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
        $update_res = mysqli_query($con, $update_code);
        header('location: new-password.php');
        exit();
    }else{
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

if(isset($_POST['change-password'])){
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }else{
        $code = 0;
        $email = $_SESSION['email']; // Retrieve the email from the session
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE usertable SET code = $code, password = '$encpass' WHERE email = '$email'";
        if(mysqli_query($con, $update_pass)){
            $_SESSION['info'] = "Your password has been changed. You can now login with your new password.";
            header('Location: password-changed.php');
        }else{
            $errors['db-error'] = "Failed while updating password!";
        }
    }
}