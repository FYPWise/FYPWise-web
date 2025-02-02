<?php
use App\Models\Base;

$base = new Base("Error 404");
?>

<head>
    <link rel="stylesheet" href="/FYPWise-web/src/css/home-page-style.css?v=<?php echo time(); ?>">
</head>

<body>
    <!-- Header Section -->
    <header>
        <button id="about-us"><a href="about-us"><img src="/FYPWise-web/src/assets/about us2.png" alt="about us icon"
                    class="aboutus-image"></a></button>
    </header>

    
    <!-- FYPwise Logo -->
    <img src="/FYPWise-web/src/assets/horizontal_logo.png" alt="FYPWise logo" id="FYPWise-logo">

    <!-- Announcement -->
    <div class="announcement">
        <p>Error 404 - Page Not Found</p>
    </div>

    <?php $base->renderFooter() ?>
</body>

</html>