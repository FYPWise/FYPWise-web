<?php
use App\Models\Base;
use App\Models\User;

$base = new Base("Registration");

if (isset($_POST['submit'])){
    $user = new User();
    $existingUser = $user->find($_POST['id']);
    if ($existingUser) {
        $error = "ID already in use.";
    } else {
        $user->create("student");
        header('location:login');
        exit();
    };
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration</title>
        <link rel="icon" type="image/x-icon" href="../assets/main_logo.png">
        <link rel="stylesheet" href="./src/css/student-registration-page-style.css?v=0.3">
        <link rel="stylesheet" href="./src/css/footer.css?v=0.2">
    </head>
    <body>
        <!-- Header Section -->
        <header>
            <button id="home"><a href="/FYPWise-web/"><img src="./src/assets/home3.png" alt="home icon" class="home-image"></a></button>
            <button id="about-us"><a href="about-us-page.html"><img src="./src/assets/about us2.png" alt="about us icon" class="aboutus-image"></a></button>
        </header>

        <h2><span id="text1">Create</span> New <span id="text2">Account</span></h2>

        <!-- Login -->
            <form id="testform" method="POST">
                <div class="container">
                    <div class="name-input">
                        <label for="name">Name:</label>
                        <input id="name" name="name" type="text" placeholder="Full name according to ID" pattern="[A-Za-z\s]+" title="Please put your fullname according to your ID card" required/>
                    </div>
                    <div class="id-input">
                        <label for="id">Student ID:</label>
                        <input id="id" name="id" type="text" placeholder="1211030429" pattern="\d{10}" title="Please enter your Student ID."  required/>
                    </div>
                    <div class="email-input">
                        <label for="email">Student Email:</label>
                        <input id="email" name="email" placeholder="1211030429@student.mmu.edu.my" pattern="\d{10}@student\.mmu\.edu\.my" type="email" required/>
                    </div>
                    <div class="password-input">
                        <label for="password">Password:</label>
                        <input id="password" name="password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,12}" required/>
                        <img id="toggle-password" src="./src/assets/show.png" alt="Show/Hide Password" >
                        <span id="tooltip" class="tooltip">
                            <ul>
                                <li id="number" class="invalid">Have one number</li>
                                <li id="uppercase" class="invalid">Have one uppercase character</li>
                                <li id="lowercase" class="invalid">Have one lowercase character</li>
                                <li id="special" class="invalid">Have one special character (!@#$%^&*)</li>
                                <li id="length" class="invalid">Have 8 to 16 characters</li>    
                            </ul>
                        </span>
                    </div>
                    <div class="cpass-input">
                        <label for="cpass">Confirm Password:</label>
                        <input id="cpass" name="cpass" type="password" required/>
                        <span id="error" class="error" hidden>Please ensure your password match.</span>
                    </div>
                    <div class="year">
                        <label for="year">Year of study</label>
                        <select name="year" id="study-year" required>
                            <option value="" disabled selected>Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="specialization">
                        <label for="specialization">Specialization :</label>
                        <select name="specialization" id="faculty" required>
                            <option value="" disabled selected>Select your Specialization<y/option>
                            <option value="Cybersecurity">Cybersecurity</option>
                            <option value="Data Science">Data Science</option>
                            <option value="Game Development">Game Development</option>
                            <option value="Software Engineering">Software Engineering</option>
                        </select>
                    </div>
                    <div class="submit-btn"><button  id="submit" name="submit" type="submit" form="testform" value="sign-up" class="submit" >Sign Up</button></div>
                </div>
            </form>
        <div class="login-caption"><p>Already have an account? <a href="login-page.html">Login</a></p></div>
        <!-- Footer -->
        <?php $base->renderFooter() ?>
        <script src="./src/scripts/passwordCheck.js"></script>
        <?php include 'idinusepopup.php'; ?>
    </body>
</html>