<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Check if email exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // Generate reset token
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        // Store token in database
        $update_sql = "UPDATE users SET reset_token = '$token', reset_expiry = '$expiry' WHERE email = '$email'";
        mysqli_query($conn, $update_sql);
        
        // In a real application, you would send an email here
        $_SESSION['message'] = "Password reset link has been sent to your email. Please check your inbox.";
        
        // For demo purposes, we'll show the reset link directly
        $_SESSION['demo_reset_link'] = "reset_password.php?token=" . $token;
        
        header("location: login.php");
    } else {
        $error = "No account found with this email address.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Forgot Password</h3>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)) { ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php } ?>
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                        </form>
                        <p class="text-center mt-3">
                            <a href="login.php">Back to Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
