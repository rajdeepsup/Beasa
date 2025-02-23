<?php
session_start();
include('config.php');

?>

<!DOCTYPE html>

<?php include 'header.php'; ?>

<html>
<head>
    <title>PRD Letter</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>PRD Latter</title>
    <style>

               table { border-collapse: collapse; width: 100%; margin: 0 auto; }
        th, td { border: 2px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #088395; }
    </style>
</head>
<body>
<h2 style="text-align: center; background-color:rgb(14, 235, 158);">Panchayati Raj Department Letter</h2>

</head>


    
   

   
    <table>
        <tr>
            <th>SL No</th>    
            <th>Letter No</th>
            <th>Latter Date</th>
            <th>Subject</th>
            <th>Download</th>
        </tr>
        <?php
        $sql = "SELECT * FROM prd_letter ORDER BY date DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row["id"]."</td>    
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