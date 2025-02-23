<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    
    // Password validation
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (full_name, email, password, mobile_number, district, gender) 
                VALUES ('$full_name', '$email', '$password', '$mobile_number', '$district', '$gender')";
        
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "Registration successful! Please login.";
            header("location: login.php");
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}

// List of districts in Bihar
$districts = array(
    "Araria", "Arwal", "Aurangabad", "Banka", "Begusarai", "Bhagalpur", "Bhojpur", 
    "Buxar", "Darbhanga", "East Champaran", "Gaya", "Gopalganj", "Jamui", "Jehanabad", 
    "Kaimur", "Katihar", "Khagaria", "Kishanganj", "Lakhisarai", "Madhepura", 
    "Madhubani", "Munger", "Muzaffarpur", "Nalanda", "Nawada", "West Champaran", 
    "Patna", "Purnia", "Rohtas", "Saharsa", "Samastipur", "Saran", "Sheikhpura", 
    "Sheohar", "Sitamarhi", "Siwan", "Supaul", "Vaishali"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
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
                        <h3 class="text-center">Register</h3>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)) { ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php } ?>
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="full_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="tel" name="mobile_number" class="form-control" pattern="[0-9]{10}" title="Please enter valid 10-digit mobile number" required>
                            </div>
                            <div class="form-group">
                                <label>District</label>
                                <select name="district" class="form-control" required>
                                    <option value="">Select District</option>
                                    <?php
                                    foreach($districts as $district) {
                                        echo "<option value='" . $district . "'>" . $district . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control" onkeyup="validatePassword()" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" onkeyup="validatePassword()" required>
                                <small id="password_match"></small>
                            </div>
                            <button type="submit" id="submit_button" class="btn btn-primary btn-block">Register</button>
                        </form>
                        <p class="text-center mt-3">
                            Already have an account? <a href="login.php">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
