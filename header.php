<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEASA BIHAR</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <style>
        
        .navbar {
            background-color: #004d99 !important;
            padding: 0 1rem;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            height: 60px;
        }
        .brand-text {
            color: white;
            font-size: 24px;
            font-weight: bold;
            margin-left: 15px;
            letter-spacing: 1px;
        }
        .navbar-dark .navbar-nav .nav-link {
            color: white !important;
            padding: 1rem;
            font-size: 16px;
        }
        .navbar-dark .navbar-nav .nav-link:hover {
            background-color:rgb(243, 247, 22);
        }
        .dropdown-menu {
            background-color: #004d99;
            border: none;
            margin-top: 0;
            border-radius: 0;
        }
        .dropdown-item {
            color: yelow !important;
            padding: 0.5rem 1.5rem;
        }
        .dropdown-item:hover {
            background-color: #00ffca;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.png" alt="BEASA BIHAR">
                <span class="brand-text">BEASA BIHAR</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="index.php"><i class="bi bi-house"></i>Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-envelope"></i>Letters
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="district_letters.php"><i class="bi bi-envelope-fill"></i>District Letter</a>
                            <a class="dropdown-item" href="prd_letters.php"><i class="bi bi-envelope-fill"></i>PRD Letter</a>
                            <a class="dropdown-item" href="bpsm_letters.php"><i class="bi bi-envelope-fill"></i>BPSM Letter</a>
                        </div>
                    </li>
                    <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="about.php"><i class="bi bi-info-square"></i>About Us</a>
                    </li>
                    <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'tools.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="tools.php"><i class="bi bi-gear"></i>Tools</a>
                    </li>
                    <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'executive.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="executive.php"><i class="bi bi-people-fill"></i>Executive Details</a>
                    </li>
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i>Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'login.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="login.php"><i class="bi bi-box-arrow-in-right"></i>Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    
    <script>
    $(document).ready(function(){
        // Enable dropdowns
        $('.dropdown-toggle').dropdown();
        
        // Show dropdown on hover
        $('.dropdown').hover(
            function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
            },
            function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
            }
        );
    });
    </script>
</body>
</html>
