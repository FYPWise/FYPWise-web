<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration</title>
        <link rel="icon" type="image/x-icon" href="../assets/main_logo.png">
        <link rel="stylesheet" href="../css/student-registration-page-style.css">
        <link rel="stylesheet" href="../css/footer.css">
        <script>
            function response() {
                var form = document.getElementById('testform');
                var inputs = form.querySelectorAll('input, select');

                var profileInfo = '';
                inputs.forEach(input => {
                  profileInfo += `${input.name}: ${input.value}\n`;
                });
            
                alert(`Profile Information:\n${profileInfo}`);
            }
        </script>
    </head>
    <body>
        <!-- Header Section -->
        <header>
            <button id="home"><a href="home-page.html"><img src="../assets/home.png" alt="home icon" class="home-image"></a></button>
            <button id="about-us"><a href="about-us-page.html"><img src="../assets/about us.png" alt="about us icon" class="aboutus-image"></a></button>
        </header>

        <h2><span id="text1">Create</span> New <span id="text2">Account</span></h2>

        <!-- Login -->
            <form id="testform" onsubmit="response()">
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
                        <img id="toggle-password" src="../assets/show.png" alt="Show/Hide Password" >
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
                    <div class="study-year">
                        <label for="study-year">Year of study</label>
                        <select name="study-year" id="study-year" required>
                            <option value="" disabled selected>Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="faculty">
                        <label for="faculty">Specialization :</label>
                        <select name="faculty" id="faculty" required>
                            <option value="" disabled selected>Select your Specialization<y/option>
                            <option value="Cybersecurity">Cybersecurity</option>
                            <option value="Data Science">Data Science</option>
                            <option value="Game Development">Game Development</option>
                            <option value="Software Engineering">Software Engineering</option>
                        </select>
                    </div>
                    <div class="submit-btn" disabled><button  id="submit" type="submit" form="testform" value="sign-up" class="submit" >Sign Up</button></div>
                </div>
            </form>
        <div class="login-caption"><p>Already have an account? <a href="login-page.html">Login</a></p></div>
        <!-- Footer -->
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
            // Password check
            var passwordInput = document.getElementById('password');
            var confirmPasswordInput = document.getElementById('cpass');
            var submitButton = document.getElementById('submit');
            var tooltip = document.getElementById('tooltip');
            var error = document.getElementById('error');
            var togglePassword = document.getElementById('toggle-password');
            var requirements = {
                number: /(?=.*\d)/,
                uppercase: /(?=.*[A-Z])/,
                lowercase: /(?=.*[a-z])/,
                special: /(?=.*[!@#$%^&*])/,
                length: /.{8,16}/
            };

            passwordInput.addEventListener('focus', function() {
                tooltip.style.opacity = '1';
            });

            passwordInput.addEventListener('blur', function() {
                tooltip.style.opacity = '0';
            });

            passwordInput.addEventListener('input', function() {
                var value = passwordInput.value;
                for (var key in requirements) {
                    var element = document.getElementById(key);
                    if (requirements[key].test(value)) {
                        element.classList.remove('invalid');
                        element.classList.add('valid');
                    } else {
                        element.classList.remove('valid');
                        element.classList.add('invalid');
                    }
                }
            });

            // Confirm Password
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);

            function checkPasswordMatch() {
                if (passwordInput.value === confirmPasswordInput.value) {
                    confirmPasswordInput.style.border = '3px solid green';
                    confirmPasswordInput.style.marginBottom = '1em';
                    submitButton.disabled = false;
                    error.hidden = true;
                } else {
                    confirmPasswordInput.style.border = '3px solid red';
                    confirmPasswordInput.style.marginBottom = '0';
                    submitButton.disabled = true;
                    error.hidden = false;
                    error.style.marginBottom = '1em';
                }
            }
            togglePassword.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    togglePassword.src = '../assets/hide.png';
                } else {
                    passwordInput.type = 'password';
                    togglePassword.src = '../assets/show.png';
                }
            });
        </script>
    </body>
</html>