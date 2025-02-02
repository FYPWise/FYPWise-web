<?php
use App\Models\Base;
use App\Models\User;

$base = new Base("Create User", "admin");

function getNewLecturerID() {
    $user = new User();
    return $user->getNewLecturerID();
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User();
    $user->create($_POST['role']);
    echo"created";
}

$newLecturerID = getNewLecturerID();
?>

<head>
    <link rel="stylesheet" href="./src/css/form-style.css">
    <link rel="stylesheet" href="./src/css/announcements-mgt-style.css">
    <link rel="stylesheet" href="./src/css/user-mgt-style.css">
</head>

<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $base->renderMenu() ?>

            <div class="content">
                <section class="main">
                    <h1 id="page-name">Create New User</h1>

                    <form class="form" id="userForm" method="POST">
                        <div class="form-group">
                            <label for="user-role">Role</label>
                            <select id="user-role" name="role" required>
                                <option value="" disabled selected>Select User Role</option>
                                <option value="student">Student</option>
                                <option value="lecturer">Lecturer</option>
                            </select>
                        </div>

                        <div class="form-group ">
                            <label for="user-id">User ID</label>
                            <input class="disabled" type="text" id="user-id" name="id" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group" id="position-field" style="display:none">
                            <label for="position">Position</label>
                            <select id="position" name="position" required>
                                <option value="" disabled selected>Select Lecturer's Position</option>
                                <option value="Professor">Professor</option>
                                <option value="Associate Professor">Associate Professor</option>
                                <option value="Senior Lecturer">Senior Lecturer</option>
                                <option value="Lecturer">Lecturer</option>
                            </select>
                        </div>

                        <div class="form-group student-field" id="year-field" style="display:none">
                            <label for="year">Year</label>
                            <select class="student-field" id="year" name="year" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="form-group student-field" style="display:none">
                            <label for="specialization">Specialization :</label>
                            <select class="student-field" name="specialization" id="faculty" required>
                                <option value="" disabled selected>Select student's Specialization<y/option>
                                <option value="Cybersecurity">Cybersecurity</option>
                                <option value="Data Science">Data Science</option>
                                <option value="Game Development">Game Development</option>
                                <option value="Software Engineering">Software Engineering</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input id="password" name="password" type="password"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}"
                                title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 to 12 characters"
                                required />
                        </div>

                        <!-- submit and reset buttons -->
                        <div class="form-buttons">
                            <button type="submit" class="btn submit-btn">Submit</button>
                            <button type="reset" class="btn reset-btn">Reset</button>
                        </div>
                    </form>
                </section>
            </div>


        </div>

                <?php $base->renderFooter() ?>

        <!-- JavaScript -->

        <script>

            var studentFields = document.getElementsByClassName("student-field");

            function hideStudentField(hide){
                if (hide == true){
                    for (var i = 0; i < studentFields.length; i++){
                        studentFields[i].style.display = 'none';
                        studentFields[i].removeAttribute("required");
                    }
                }else{
                    for (var i = 0; i < studentFields.length; i++){
                        studentFields[i].style.display = 'inherit';
                        studentFields[i].setAttribute("required", true);
                    }
                }
                
            }

            var userIDInput = document.getElementById("user-id");

            document.getElementById("user-role").addEventListener("change", function () {
                var role = event.target.value;

                if (role === "student") {
                    userIDInput.value = "";
                    userIDInput.removeAttribute("disabled");
                    userIDInput.classList.remove("disabled");
                    document.getElementById("position-field").style.display = "none";
                    document.getElementById("position").removeAttribute("required");
                    hideStudentField(false);
                } else if (role === "lecturer") {
                    userIDInput.value = "<?php echo $newLecturerID; ?>";
                    userIDInput.classList.add("disabled");
                    document.getElementById("position-field").style.display = "inherit";
                    document.getElementById("position").setAttribute("required", true);
                    hideStudentField(true);
                } 
            });

            function getLecturerID(){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        document.getElementById("table-name").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "userlist?userid="+userID, true);
                xmlhttp.send();
            }
        </script>
    </div>
</body>

</html>