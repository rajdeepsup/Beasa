<?php
session_start();
include('config.php');
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // अनलॉगिन यूजर को लॉगिन पर भेजें
    exit();
}

// फॉर्म डेटा प्रोसेस करें
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $letter_no = mysqli_real_escape_string($conn, $_POST['letter_no']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $downloads = mysqli_real_escape_string($conn, $_POST['downloads']);

    $sql = "INSERT INTO letters (letter_no, date, subject, downloads)
    VALUES ('$letter_no', '$date', '$subject', '$downloads')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>New record added successfully</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>

<?php include 'header.php'; ?>

<html>
<head>
    <title>District Letter</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>District Latter</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 2px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #088395; }
    </style>
</head>
<body>
<h2 style="text-align: center;">Submit New Letter</h2>
    <form method="post">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 18px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        input {
            width: 98%;
            padding: 5px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: green;
            color: white;
            border: none;
            padding: 10px;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
        }
        input[type="submit"]:hover {
            background-color: darkgreen;
        }
    </style>
</head>


    
    <form method="post">
        <table>
            <tr>
                <th>Letter No</th>
                <td><input type="text" name="letter_no" required></td>
            </tr>
            <tr>
                <th>Date</th>
                <td><input type="date" name="date" required></td>
            </tr>
            <tr>
                <th>Subject</th>
                <td><input type="text" name="subject" required></td>
            </tr>
            <tr>
                <th>Download</th>
                <td><input type="url" name="downloads" required></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Submit"></td>
            </tr>
        </table>
    </form>

   
    <table>
        <tr>
            <th>Letter No</th>
            <th>Latter Date</th>
            <th>Subject</th>
            <th>Download</th>
        </tr>
        <?php
        $sql = "SELECT * FROM letters ORDER BY date DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row["letter_no"]."</td>
                    <td>".$row["date"]."</td>
                    <td>".$row["subject"]."</td>
                    <td><a href='".$row["downloads"]."'>डाउनलोड</a></td>
                </tr>";
            }
        } 
        ?>
    </table>
</body>
</html>

        
<?php $conn->close(); ?>