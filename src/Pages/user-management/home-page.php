<?php
    use App\Models\Announcement;
    $announcement = new Announcement();
    $announcement->latest();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FYPWise</title>
    <link rel="icon" type="image/x-icon" href="./src/assets/main_logo.png">
    <link rel="stylesheet" href="./src/css/common-ui.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./src/css/home-page-style.css?v=<?php echo time(); ?>">
</head>

<body>
    <!-- Header Section -->
    <header>
        <button id="about-us"><a href="about-us"><img src="./src/assets/about us2.png" alt="about us icon"
                    class="aboutus-image"></a></button>
    </header>

    <!-- FYPwise Logo -->
    <img src="./src/assets/horizontal_logo.png" alt="FYPWise logo" id="FYPWise-logo">

    <!-- Announcement -->
    <div class="announcement">
        <p class="announcement-caption">Announcements</p>
        <div class="announcement-box">
            <?php if ($announcement->getTitle() !== null){ ?>
            <div class="announcement-header">
                <img src="./src/assets/pfp/<?php echo $announcement->getFN();?>" alt="User" class="user-image">
                <div class="user-details">
                    <p class="user-name"><?php echo $announcement->getName(); ?></p>
                    <p class="announcement-time"><?php echo $announcement->getTime(); ?> &nbsp; | &nbsp; <?php echo $announcement->getDate(); ?></p>
                </div>
            </div>
            <div class="announcement-content">
                <h4 class="announcement-title"><?php echo $announcement->getTitle(); ?></h4>
                <p class="announcement-text"><?php echo $announcement->getDes(); ?>
                </p>
            </div>
            <?php } else { ?>
            <p>No announcement</p>
            <?php } ?>
        </div>
    </div>

    <!-- Caption and Buttons Container -->
    <div class="container">
        <p class="login-caption">Already have an account?</p>
        <div class="buttons">
            <button id="reg-btn" onclick="window.location.href = 'register';"
                class="btn registration">Student
                Registration</button>
            <button id="login-btn" onclick="window.location.href = 'login';" class="btn login">Log In</button>
        </div>
    </div>

    <footer>
        <h3><a href="https://www.mmu.edu.my/">Multimedia University, Persiaran Multimedia, 63100 Cyberjaya, Selangor,
                Malaysia</a></h3>
        <div id="side">
            <a class="link" href="http://www.mmu.edu.my/">MMU Website</a>
            <a class="link" href="https://online.mmu.edu.my/">MMU Portal</a>
            <a class="link" href="https://clic.mmu.edu.my/">CLiC</a>
            <a class="link" href="https://servicedesk.mmu.edu.my/psp/crmprd/?cmd=login&languageCd=ENG&">Service Desk</a>
        </div>
        FYP Wise &copy; <em id="date"></em>Syabell Imran Aida Firzan
    </footer>
</body>

</html>