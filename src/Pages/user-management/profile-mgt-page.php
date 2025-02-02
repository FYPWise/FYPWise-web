<?php
use App\Models\Base;
use App\Models\Db;
use App\Models\User;

$base = new Base("Profile Management", ["student", "admin", "lecturer"]);
$db = new Db();
$user = new User();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./src/css/profile-mgt-style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="sidebar">
        <img src="./src/assets/main_logo_white.png" alt="Logo" class="logo">
        <div class="icons">
            <a href="/FYPWise-web"><button id="sidebar-btn"><img src="./src/assets/home3.png" alt="home"></button></a>
            <a href="communication"><button id="sidebar-btn"><img src="./src/assets/messages1.png"
                        alt="messages"></button></a>
            <a href="dashboard"><button id="sidebar-btn"><img src="./src/assets/dashboard1.png" alt="dashboard"></button></a>
        </div>
        <button id="logout-btn" onclick="showLogoutPopup()"><img src="./src/assets/logout2.png" alt="logout"></button>
    </div>
    <!-- Logout Confirmation Popup -->
    <?php include './src/Pages/common-ui/logoutConfirm.html'; ?>

    <!-- Main Container -->
    <div class="container">

        <h1>Your Profile</h1>
        <hr>

        <!-- Profile -->
        <div class="profile">
            <div class="profile-image">
                <form id="imageUploadForm" method="post" enctype="multipart/form-data">
                    <img src="./src/assets/pfp/<?php echo $_SESSION['image'] ?>" alt="Profile Image">
                </form>
            </div>
            <div class="details">
                <form id="profileForm" method="post">
                    <?php
                        function renderInput($label, $value) {
                            echo '<div class="form-group">';
                            echo '<label for="name"><strong>' . $label . ':</strong></label>';
                            echo '<input type="text" id="name" name="name" value="' . $value . '" readonly>';
                            echo '</div>';
                        }

                        renderInput('Name', $_SESSION['name']);
                        renderInput('ID', $_SESSION['id']);
                        renderInput('Email', $_SESSION['email']);

                        if ($_SESSION['role'] == 'student') {
                            renderInput('Specialization', $_SESSION['specialization']);
                            renderInput('Year of study', $_SESSION['year']);
                        } elseif ($_SESSION['role'] == 'lecturer') {
                            renderInput('Position', $_SESSION['position']);
                        }
                    ?>
                    <button type="button" form="profileForm" name="profile" id="submit" onclick="window.location.href = 'profileedit';">Edit Profile</button>
                </form>
                <script src="./src/scripts/passwordCheck.js"></script>
            </div>
        </div>
        <?php $base->renderFooter(); ?>
    </div>
    <?php include 'idinusepopup.php'; ?>
</body>

</html>