<?php

use App\Models\Base;

$base = new Base('About us');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="icon" type="image/x-icon" href="./src/assets/main_logo.png">
    <link rel="stylesheet" href="./src/css/common-ui.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./src/css/about-us-page-style.css?v=<?php echo time(); ?>">
</head>

<body>
    <!-- Header -->
    <header>
        <h2>About us</h2>
        <button id="home"><a href="/FYPWise-web/"><img src="./src/assets/home3.png" alt="home icon"
            class="home-image"></a></button>
    </header>
    <h1>Section: TC1L</h1>
    <h3>Meet Our Team</h3>

    <hr>

    <!-- Member Details -->
    <div class="container">
        <div class="member">
            <img src="./src/assets/aisyah.jpg" alt="Team Member" class="member-image">
            <div class="details">
                <p>Nur Aisyah Nabila Binti Nahar </p>
                <p><strong>ID :</strong> 1211104230 </p>
                <p><strong>Email :</strong> <a
                        href="mailto:1211104230@student.mmu.edu.my">1211104230@student.mmu.edu.my</a> </p>
            </div>
        </div>
        <div class="member">
            <img src="./src/assets/Imran.jpg" alt="Team Member" class="member-image">
            <div class="details">
                <p>Mohamed Imran Bin Mohamed Yunus</p>
                <p><strong>ID :</strong> 1211101935</p>
                <p><strong>Email :</strong> <a
                        href="mailto:1211101935@student.mmu.edu.my">1211101935@student.mmu.edu.my</a></p>
            </div>
        </div>
        <div class="member">
            <img src="./src/assets/firzan.jpg " alt="Team Member" class="member-image">
            <div class="details">
                <p>Muhammad Firzan Ruzain bin Firdus </p>
                <p><strong>ID :</strong> 1211103220</p>
                <p><strong>Email :</strong> <a
                        href="mailto:1211103220@student.mmu.edu.my">1211103220@student.mmu.edu.my</a></p>
            </div>
        </div>
        <div class="member">
            <img src="./src/assets/aida.jpg" alt="Team Member" class="member-image">
            <div class="details">
                <p>Nur Farahiya Aida Binti Abd Razak </p>
                <p><strong>ID :</strong> 1211103194 </p>
                <p><strong>Email :</strong> <a
                        href="mailto:1211103194@student.mmu.edu.my">1211103194@student.mmu.edu.my</a> </p>
            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <div class="footer">
        <div class="quote-container">
            <p class="quote">"Greatest Team In The World" - Madam SRS</p>
            <p class="quote">"Success is no accident. It's hard work and perseverance."</p>
            <p class="quote">"Teamwork makes the dream work!"</p>
            <p class="quote">"The strength of the team is each individual member."</p>
            <p class="quote">"Alone we can do so little; together we can do so much."</p>
        </div>
    </div>
    <?php $base->renderFooter() ?>
</body>

</html>