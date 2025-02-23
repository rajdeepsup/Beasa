<?php
session_start();
include('config.php');

// Update visitor count
$today = date('Y-m-d');
$sql = "INSERT INTO visitors (visit_date, count) VALUES ('$today', 1) 
        ON DUPLICATE KEY UPDATE count = count + 1";
mysqli_query($conn, $sql);

// Get total visitors
$sql = "SELECT SUM(count) as total FROM visitors";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_visitors = str_pad($row['total'], 6, "0", STR_PAD_LEFT);

// Get notices
$sql = "SELECT * FROM notices WHERE is_active = 1 ORDER BY date_posted DESC LIMIT 10";
$notices = mysqli_query($conn, $sql);
?>
<?php include 'header.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>BEASA BIHAR</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/all.min.css">
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
            color: white;
            padding: 1rem;
            font-size: 16px;
        }
        .navbar-dark .navbar-nav .nav-link:hover {
            background-color: #003366;
        }
        .main-container {
            display: flex;
            margin-top: 20px;
        }
        .slider-container {
            width: 75%;
            padding-right: 15px;
        }
        .carousel-item {
            height: 400px;
        }
        .carousel-item img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }
        .carousel-indicators li {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }
        .notice-section {
            width: 25%;
            background: #fff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            height: 400px;
        }
        .notice-header {
            background:rgb(138, 19, 132);
            color: white;
            padding: 10px;
            font-weight: bold;
            text-align: center;
        }
        .notice-content {
            height: 350px;
            overflow: hidden;
            position: relative;
        }
        .notice-list {
            animation: scrollNotices 20s linear infinite;
            padding: 10px;
            position: relative;
            top: 0;
        }
        .notice-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }
        .notice-item:last-child {
            border-bottom: none;
        }
        .notice-date {
            font-size: 12px;
            color: #666;
        }
        .notice-title {
            font-weight: bold;
            color: #004d99;
        }
        @keyframes scrollNotices {
            0% { transform: translateY(0); }
            100% { transform: translateY(-50%); }
        }
        .notice-list:hover {
            animation-play-state: paused;
        }
        .visitor-section {
            padding: 8px 0;
        }
        .counter-box {
            display: flex;
            justify-content: center;
            gap: 1px;
        }
        .digit {
            background: linear-gradient(to bottom, #fff, #f0f0f0);
            border: 1px solid #ddd;
            padding: 3px 6px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 2px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        .visitor-stats {
            margin-top: 5px;
            font-size: 12px;
            color: #666;
        }
        .visitor-stats i {
            color: #28a745;
            margin-right: 2px;
            font-size: 12px;
        }
        .text-warning {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .credit-section {
            font-size: 14px;
            line-height: 1.6;
        }
        .credit-section p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <!-- Main Content -->
    <div class="container main-container">
        <!-- Slider Container -->
        <div class="slider-container">
            <div id="imageSlider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#imageSlider" data-slide-to="0" class="active"></li>
                    <li data-target="#imageSlider" data-slide-to="1"></li>
                    <li data-target="#imageSlider" data-slide-to="2"></li>
                    <li data-target="#imageSlider" data-slide-to="3"></li>
                    <li data-target="#imageSlider" data-slide-to="4"></li>
                    <li data-target="#imageSlider" data-slide-to="5"></li>
                    <li data-target="#imageSlider" data-slide-to="6"></li>
                    <li data-target="#imageSlider" data-slide-to="7"></li>
                    <li data-target="#imageSlider" data-slide-to="8"></li>
                    <li data-target="#imageSlider" data-slide-to="9"></li>
                    <li data-target="#imageSlider" data-slide-to="10"></li>
                    <li data-target="#imageSlider" data-slide-to="11"></li>
                    <li data-target="#imageSlider" data-slide-to="12"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/slide1.jpg" class="d-block w-100" alt="Slide 1">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide2.jpg" class="d-block w-100" alt="Slide 2">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide3.jpg" class="d-block w-100" alt="Slide 3">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide4.jpg" class="d-block w-100" alt="Slide 4">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide5.jpg" class="d-block w-100" alt="Slide 5">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide6.jpg" class="d-block w-100" alt="Slide 6">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide7.jpg" class="d-block w-100" alt="Slide 7">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide8.jpg" class="d-block w-100" alt="Slide 8">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide9.jpg" class="d-block w-100" alt="Slide 9">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide10.jpg" class="d-block w-100" alt="Slide 10">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide11.jpg" class="d-block w-100" alt="Slide 11">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide12.jpg" class="d-block w-100" alt="Slide 12">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide13.jpg" class="d-block w-100" alt="Slide 13">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>

        <!-- Notice Section -->
        <div class="notice-section">
            <div class="notice-header">
                <i class="fas fa-bell"></i> Latest Notices
            </div>
            <div class="notice-content">
                <div class="notice-list">
                    <?php
                    if (mysqli_num_rows($notices) > 0) {
                        while ($notice = mysqli_fetch_assoc($notices)) {
                            echo '<div class="notice-item">';
                            echo '<div class="notice-date">' . date('d M Y', strtotime($notice['date_posted'])) . '</div>';
                            echo '<div class="notice-title">' . $notice['title'] . '</div>';
                            if ($notice['content']) {
                                echo '<div class="notice-text">' . $notice['content'] . '</div>';
                            }
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="notice-item">No notices available</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Visitor Counter Section -->
    <div class="container mt-2">
        <div class="visitor-section text-center py-1">
            <h2 class="text-warning">Our Visitor</h2>
            <div class="counter-box mb-1">
                <?php
                for($i = 0; $i < strlen($total_visitors); $i++) {
                    echo '<span class="digit">' . $total_visitors[$i] . '</span>';
                }
                ?>
            </div>
            <div class="visitor-stats">
                <i class="fas fa-chart-line"></i>Total Users: <?php echo $total_visitors; ?>
            </div>
        </div>
    </div>

    <!-- Credit Section -->
    <div class="credit-section text-center py-2" style="background-color: #90EE90;">
        <div class="container">
            <p class="mb-1">Content Owned by IT Team BEASA, Supaul</p>
            <p class="mb-1"> Supaul , Developed and hosted by Rajdeep Yadav</p>
            <p class="mb-1">Mob :- 9473287701 Email :- rajdeepsupaul@gmail.com</p>
            <p class="mb-0">Last Updated: <?php echo date('M d, Y'); ?></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
