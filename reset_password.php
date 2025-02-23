<?php
session_start();
include('config.php');

if (!isset($_GET['token'])) {
    header("location: login.php");
    exit();
}

$token = $_GET['token'];
$current_time = date('Y-m-d H:i:s');

// Verify token
$sql = "SELECT * FROM users WHERE reset_token = '$token' AND reset_expiry > '$current_time'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    $_SESSION['error'] = "Invalid or expired reset link.";
    header("location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Update password and clear reset token
        $update_sql = "UPDATE users SET password = '$hashed_password', reset_token = NULL, reset_expiry = NULL WHERE reset_token = '$token'";
        if (mysqli_query($conn, $update_sql)) {
            $_SESSION['message'] = "Password has been reset successfully. Please login with your new password.";
            header("location: login.php");
            exit();
        } else {
            $error = "Error updating password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
    function validatePassword() {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;
        var submit_button = document.getElementById("submit_button");
        var password_match = document.getElementById("password_match");
        
        if(password != confirm_password) {
            password_match.style.color = 'red';
            password_match.innerHTML = 'Passwords do not match!';
            submit_button.disabled = true;
        } else {
            password_match.style.color = 'green';
            password_match.innerHTML = 'Passwords match!';
            submit_button.disabled = false;
        }
    }
    </script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Reset Password</h3>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)) { ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php } ?>
                        <form method="post" action="">
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="password" id="password" class="form-control" onkeyup="validatePassword()" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" onkeyup="validatePassword()" required>
                                <small id="password_match"></small>
                            </div>
                            <button type="submit" id="submit_button" class="btn btn-primary btn-block">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
