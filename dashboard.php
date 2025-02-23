<?php
session_start();
include('config.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit();
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM users WHERE id = $user_id";
$user_result = mysqli_query($conn, $user_query);
$user_data = mysqli_fetch_assoc($user_result);

// Fetch reports from database
$sql = "SELECT * FROM reports WHERE user_id = " . $_SESSION['user_id'];
$result = mysqli_query($conn, $sql);
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Welcome, <?php echo $user_data['full_name']; ?>!</h4>
                    </div>
                    <div class="card-body">
                        <h5>Your Profile Information:</h5>
                        <table class="table">
                            <tr>
                                <th>Full Name:</th>
                                <td><?php echo $user_data['full_name']; ?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo $user_data['email']; ?></td>
                            </tr>
                            <tr>
                                <th>Mobile Number:</th>
                                <td><?php echo $user_data['mobile_number']; ?></td>
                            </tr>
                            <tr>
                                <th>District:</th>
                                <td><?php echo $user_data['district']; ?></td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td><?php echo ucfirst($user_data['gender']); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <h2>Your Reports</h2>
                <div class="table-responsive mt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['title'] . "</td>";
                                    echo "<td>" . $row['created_at'] . "</td>";
                                    echo "<td>" . $row['status'] . "</td>";
                                    echo "<td><a href='view_report.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>View</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No reports found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
