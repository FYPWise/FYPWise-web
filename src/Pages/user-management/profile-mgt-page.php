<?php
use App\Models\Base;
use App\Models\Db;
use App\Models\UpdateProfile;

$base = new Base("Profile Management", ['lecturer', 'student', 'admin']);
$db = new Db();
$form = new UpdateProfile();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['profile'])) {
        $form->profile();

    } elseif (isset($_POST['image'])) {
        $form->image();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./src/css/profile-mgt-style.css?v=0.1">
    <link rel="stylesheet" href="./src/css/footer.css?v=0.2">
    <script src="./src/scripts/profile_form_response.js?v=0.10"></script>
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
        <a href="login?q=logout"><button id="logout-btn"><img src="./src/assets/logout2.png" alt="logout"></button></a>
    </div>

    <!-- Main Container -->
    <div class="container">

        <h1>User Profile</h1>
        <hr>

        <!-- Profile -->
        <div class="profile">
            <div class="profile-image">
                <form id="imageUploadForm" method="post" enctype="multipart/form-data">
                    <img src="./src/assets/pfp/<?php echo $_SESSION['image'] ?>" alt="Profile Image">
                    <input type="file" id="imageUpload" name="image" accept="image/*" style="display:none;" required>
                    <button type="submit" name="image" id="imageUploadButton" style="display:none;">Upload Image</button>
                </form>
            </div>
            <div class="details">
                <form id="profileForm" method="post" onsubmit="enableDisabledFields()">
                    <div class="form-group">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" id="name" name="name" value="<?php echo $_SESSION['name']; ?>" pattern="[A-Za-z\s]+" readonly>
                    </div>
                    <div class="form-group">
                        <label for="student-id"><strong>ID:</strong></label>
                        <input type="text" id="student-id" name="student-id" value="<?php echo $_SESSION['id']; ?>" pattern="\d{10}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email"><strong>Email:</strong></label>
                        <input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" pattern="\d{10}@student\.mmu\.edu\.my" readonly>
                    </div>
                    <?php if ($_SESSION['role'] == 'student') { ?>
                    <div class="form-group">
                        <label for="specialization"><strong>Specialization:</strong></label>
                        <select id="specialization" name="specialization" disabled>
                            <option value="Cybersecurity" <?php if ($_SESSION['specialization'] == 'Cybersecurity') echo 'selected'; ?>>Cybersecurity</option>
                            <option value="Data Science" <?php if ($_SESSION['specialization'] == 'Data Science') echo 'selected'; ?>>Data Science</option>
                            <option value="Game Development" <?php if ($_SESSION['specialization'] == 'Game Development') echo 'selected'; ?>>Game Development</option>
                            <option value="Software Engineering" <?php if ($_SESSION['specialization'] == 'Software Engineering') echo 'selected'; ?>>Software Engineering</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year"><strong>Year of study:</strong></label>
                        <select id="year" name="year" disabled>
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
                        <input type="text" id="position" name="position" value="<?php echo $_SESSION['position']; ?>" pattern="[A-Za-z\s]+" readonly>
                    </div>
                    <?php } ?>
                    <div class="form-group password-input" style="display:none;">
                        <label for="password">New Password:</label>
                        <input id="password" name="password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,12}" required/>
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
                    <div class="form-group password-input cpass" style="display:none;">
                        <label for="cpass">Confirm Password:</label>
                        <input id="cpass" name="cpass" type="password" required/>
                        <span id="error" class="error" hidden>Please ensure your password match.</span>
                    </div>
                    <button type="submit" name="profile" id="edit-btn" onclick="toggleEditMode()">Edit Profile</button>
                </form>
                <script>
                    document.getElementById('profileForm').onsubmit = function() {
                        var inputs = document.querySelectorAll('#profileForm input, #profileForm select');
                        inputs.forEach(input => {
                            if (input.disabled) {
                                input.disabled = false;
                            }
                        });
                        return true;
                    };
                </script>
                <script src="./src/scripts/passwordCheck.js"></script>
            </div>
        </div>
        <?php $base->renderFooter() ?>
    </div>
</body>

</html>