<?php
use App\Models\Base;
use App\Models\Db;
use App\Models\User;
use App\Models\File;

$base = new Base("Profile Management", ["student", "admin", "lecturer"]);
$db = new Db();
$user = new User();
$file = new File();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['profile'])) {
        $existingUser = $user->find($_POST['student-id']);
        if ($existingUser && $_POST['student-id'] != $_SESSION['id']) {
            $error = "ID already in use.";
        } else {
            $user->update();
        }
    } elseif (isset($_POST['image'])) {
        $file->uploadFile('image', './src/assets/pfp/', 'users', 'filename');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./src/css/profile-mgt-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./src/css/footer.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="sidebar">
        <img src="./src/assets/main_logo_white.png" alt="Logo" class="logo">
        <div class="icons">
            <a href="/FYPWise-web"><button id="sidebar-btn"><img src="./src/assets/home3.png" alt="home"></button></a>
            <a href="Communication"><button id="sidebar-btn"><img src="./src/assets/messages1.png"
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
                <img src="./src/assets/pfp/<?php echo $_SESSION['image'] ?>" alt="Profile Image">
                <form id="imageUploadForm" method="post" enctype="multipart/form-data">
                    <input type="file" id="imageUpload" name="image" accept="image/*"  required>
                    <button type="submit" name="image" id="imageUploadButton">Upload Image</button>
                </form>
            </div>
            <div class="details">
                <form id="profileForm" method="post">
                    <div class="form-group">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" id="name" name="name" value="<?php echo $_SESSION['name']; ?>" pattern="[A-Za-z\s]+" title="Please put your fullname according to your ID card"/>
                    </div>
                    <div class="form-group">
                        <label for="student-id"><strong>ID:</strong></label>
                    <input type="text" id="student-id" name="student-id" value="<?php echo $_SESSION['id']; ?>" pattern="<?php echo $_SESSION['role'] == 'student' ? '\\d{10}' : ($_SESSION['role'] == 'lecturer' ? 'L\\d{3}' : 'A\\d{3}'); ?>" title="Please enter your Student ID.">
                    </div>
                    <div class="form-group">
                        <label for="email"><strong>Email:</strong></label>
                        <input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" pattern="<?php echo $_SESSION['role'] == 'student' ? '\\d{10}@student\\.mmu\\.edu\\.my' : ($_SESSION['role'] == 'lecturer' ? 'L\\d{3}@lecturer\\.mmu\\.edu\\.my' : 'A\\d{3}@admin\\.mmu\\.edu\\.my'); ?>" title="Please enter your Student Email.">
                    </div>
                    <?php if ($_SESSION['role'] == 'student') { ?>
                    <div class="form-group">
                        <label for="specialization"><strong>Specialization:</strong></label>
                        <select id="specialization" name="specialization">
                            <option value="Cybersecurity" <?php if ($_SESSION['specialization'] == 'Cybersecurity') echo 'selected'; ?>>Cybersecurity</option>
                            <option value="Data Science" <?php if ($_SESSION['specialization'] == 'Data Science') echo 'selected'; ?>>Data Science</option>
                            <option value="Game Development" <?php if ($_SESSION['specialization'] == 'Game Development') echo 'selected'; ?>>Game Development</option>
                            <option value="Software Engineering" <?php if ($_SESSION['specialization'] == 'Software Engineering') echo 'selected'; ?>>Software Engineering</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year"><strong>Year of study:</strong></label>
                        <select id="year" name="year">
                            <option value="1" <?php if ($_SESSION['year'] == '1') echo 'selected'; ?>>1</option>
                            <option value="2" <?php if ($_SESSION['year'] == '2') echo 'selected'; ?>>2</option>
                            <option value="3" <?php if ($_SESSION['year'] == '3') echo 'selected'; ?>>3</option>
                            <option value="4" <?php if ($_SESSION['year'] == '4') echo 'selected'; ?>>4</option>
                            <option value="5" <?php if ($_SESSION['year'] == '5') echo 'selected'; ?>>5</option>
                        </select>
                    </div>
                    <?php } elseif($_SESSION['role'] == 'lecturer') { ?>
                    <div class="form-group">
                        <label for="position"><strong>Position:</strong></label>
                        <select id="position" name="position">
                            <option value="Senior Lecturer" <?php if ($_SESSION['position'] == 'Senior Lecturer') echo 'selected'; ?>>Senior Lecturer</option>
                            <option value="Associate Professor" <?php if ($_SESSION['position'] == 'Associate Professor') echo 'selected'; ?>>Associate Professor</option>
                            <option value="Professor" <?php if ($_SESSION['position'] == 'Professor') echo 'selected'; ?>>Professor</option>
                            <option value="Lecturer" <?php if ($_SESSION['position'] == 'Lecturer') echo 'selected'; ?>>Lecturer</option>
                            <option value="Principal Lecturer" <?php if ($_SESSION['position'] == 'Principal Lecturer') echo 'selected'; ?>>Principal Lecturer</option>
                        </select>
                    </div>
                    <?php } ?>
                    <div class="form-group password-input">
                        <label for="password">New Password:</label>
                        <input id="password" name="password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,12}"/>
                        <img id="toggle-password" src="./src/assets/show.png" alt="Show/Hide Password" >
                        <span id="tooltip" class="tooltip" style="display:none;">
                            <ul>
                                <li id="number" class="invalid">Have one number</li>
                                <li id="uppercase" class="invalid">Have one uppercase character</li>
                                <li id="lowercase" class="invalid">Have one lowercase character</li>
                                <li id="special" class="invalid">Have one special character (!@#$%^&*)</li>
                                <li id="length" class="invalid">Have 8 to 16 characters</li>    
                            </ul>
                        </span>
                    </div>
                    <div class="form-group password-input cpass">
                        <label for="cpass">Confirm Password:</label>
                        <input id="cpass" name="cpass" type="password" title="test"/>
                    </div>
                    
                    <span id="error" class="error" hidden>Please ensure your password match.</span>
                    <button type="submit" form="profileForm" name="profile" id="submit">Save Profile</button>
                </form>
                <script src="./src/scripts/passwordCheck.js?v=<?php echo time(); ?>"></script>
                <script>
                    passwordInput.addEventListener('focus', function() {
                        

                    });
                    
                    passwordInput.addEventListener('blur', function() {
                        tooltip.style.display = 'none';
                    });
                </script>
            </div>
        </div>
        <?php $base->renderFooter(); ?>
    </div>
    <?php include 'idinusepopup.php'; ?>
</body>

</html>