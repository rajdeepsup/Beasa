<?php
session_start();
include('config.php');
?>

<!DOCTYPE html>

<?php include 'header.php'; ?>
<html>
<head>
    <title>Executive Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table { border-collapse: collapse; width: 80%; }
        table { margin:auto; }
        th, td { border: 2px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #088395; }
        
    </style>
</head>
<body>
<h2 style="text-align: center; background-color:rgb(14, 235, 158);">All Bihar Panchayat Executive Details</h2>

</head>


    
    
    <table>
        <tr>
            <th>SL No</th>    
            <th>District</th>
            <th>Block</th>
            <th>Panchayat</th>
            <th>Name</th>
            <th>Mobile N0</th>
        </tr>
        <?php
        $sql = "SELECT * FROM executive_details ORDER BY sl_no";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row["sl_no"]."</td>    
                    <td>".$row["district_name"]."</td>
                    <td>".$row["block_name"]."</td>
                    <td>".$row["panchayat_name"]."</td>
                    <td>".$row["name"]."</td>
                    <td>".$row["mob_number"]."</td>
                    </tr>";
            }
        } 
        ?>
    </table>
</body>
</html>
       
        
<?php $conn->close(); ?>