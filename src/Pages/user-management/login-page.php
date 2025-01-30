<?php
unset($_SESSION["Invalid"]);
use App\Models\Authentication;

$auth = new Authentication();

$auth->login();

$showError = isset($_SESSION["Invalid"]);

if (isset($_GET["q"]) && $_GET["q"] == "logout") {
    $auth->logout();
}

if (isset($_SESSION["mySession"])){
    header("location:dashboard");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="./src/assets/main_logo.png">
    <link rel="stylesheet" href="./src/css/common-ui.css">
    <link rel="stylesheet" href="./src/css/login-page-style.css?v=0.2">
</head>

<body>
    <!-- Header Section -->
    <header>
        <button id="home"><a href="/FYPWise-web/"><img src="./src/assets/home3.png" alt="home icon"
                    class="home-image"></a></button>
        <button id="about-us"><a href="about-us"><img src="./src/assets/about us2.png" alt="about us icon"
                    class="aboutus-image"></a></button>
    </header>

    <!-- FYPwise Logo -->
    <img src="./src/assets/horizontal_logo.png" alt="FYPWise logo" id="FYPWise-logo">
    <h2>Login</h2>

    <!-- Login -->
    <form action="" id="testform" method="post">
        <div class="container">
            <div class="id-input">
                <label for="id">ID:</label>
                <input id="text" name="id" type="text" required />
            </div>
            <div class="password-input">
                <label for="password">Password:</label>
                <input id="password" name="password" type="password" required />
                <img id="toggle-password" src="./src/assets/show.png" alt="Show/Hide Password">
            </div>
            <p id="error-msg" class="<?php echo $showError ? 'show' : 'hide'; ?>">Invalid ID or password</p>
            <div class="submit-btn"><button type="submit" form="testform" name="login" value="login" class="submit">LOGIN</button>
            </div>
        </div>
    </form>
    <div class="signup-caption">
        <p>Don't have an account? <a href="student-registration-page.html">Sign Up</a></p>
    </div>

    <footer id="footer">
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
    <script>
        var togglePassword = document.getElementById('toggle-password');
        var passwordInput = document.getElementById('password');
        togglePassword.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                togglePassword.src = './src/assets/hide.png';
            } else {
                passwordInput.type = 'password';
                togglePassword.src = './src/assets/show.png';
            }
        });
    </script>
</body>

</html>