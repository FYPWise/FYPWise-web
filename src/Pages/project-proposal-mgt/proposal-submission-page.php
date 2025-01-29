<?php
use App\Models\Base;
use App\Models\SideMenu;
use App\Models\Proposal;
use App\Models\Db;

$base = new Base("Proposal Submission");
$sideMenu = new SideMenu();
$db = new Db();
$proposal = new Proposal($db);

// Form submission handling
$successMessage = "";
$errorMessage = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Validate form fields server-side
    if (
        empty($_POST['proposal-title']) || 
        empty($_POST['description']) || 
        empty($_POST['submission-date']) || 
        empty($_POST['specialisation']) || 
        empty($_POST['category']) || 
        empty($_POST['supervisor-id'])
    ) {
        $errorMessage = "Please fill out all required fields.";
    } else {
        // Process the form data (insert into the database)
        try {
            $proposalId = $proposal->createProposal(
                $_POST['proposal-title'],
                $_POST['description'],
                $_POST['submission-date'],
                $_POST['specialisation'],
                $_POST['category'],
                $_POST['supervisor-id']
            );
            $successMessage = "Proposal submitted successfully!";
        } catch (\Exception $e) {
            $errorMessage = "Error submitting the proposal: " . $e->getMessage();
        }
    }
}
?>

<head>
    <link rel="stylesheet" href="/FYPWise-web/src/css/proposal-management-style.css">
    <link rel="stylesheet" href="/FYPWise-web/src/css/form-style.css">
</head>

<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $sideMenu->render(); ?>

            <!-- Proposal Submission Form -->
            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?php echo $base->getTitle() ?></h1>
                    <form class="form" id="proposalForm" method="POST" action="" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="proposal-title">Proposal Title</label>
                            <input type="text" id="proposal-title" name="proposal-title" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" rows="6" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="submission-date">Submission Date</label>
                            <input type="date" id="submission-date" name="submission-date" required>
                        </div>

                        <div class="form-group">
                            <label for="specialisation">Specialisation</label>
                            <select id="specialisation" name="specialisation" required>
                                <option value="" disabled selected>Select Specialisation</option>
                                <option value="Software Engineering">Software Engineering</option>
                                <option value="Data Science">Data Science</option>
                                <option value="Cybersecurity">Cybersecurity</option>
                                <option value="Game Development">Game Development</option>
                                <option value="Artificial Intelligence">Artificial Intelligence</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" name="category" required>
                                <option value="" disabled selected>Select Category</option>
                                <option value="research">Research-based</option>
                                <option value="application">Application-based</option>
                                <option value="research-application">Research & Application-based</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="supervisor-id">Supervisor ID</label>
                            <input type="text" id="supervisor-id" name="supervisor-id" required>
                        </div>

                        <!-- Submit and Reset Buttons -->
                        <div class="form-buttons">
                            <button type="submit" class="btn submit-btn" name="submit">Submit</button>
                            <button type="reset" class="btn reset-btn">Reset</button>
                        </div>
                    </form>

                    <script>
                        function validateForm() {
                            var title = document.getElementById('proposal-title').value;
                            var description = document.getElementById('description').value;
                            var submissionDate = document.getElementById('submission-date').value;
                            var specialisation = document.getElementById('specialisation').value;
                            var category = document.getElementById('category').value;
                            var supervisorId = document.getElementById('supervisor-id').value;

                            if (!title || !description || !submissionDate || !specialisation || !category || !supervisorId) {
                                alert("Please fill out all required fields.");
                                return false;
                            }
                            return true;
                        }
                    </script>
            </section>
            </div>
        </div>
        <?php $base->renderFooter() ?>
    </div>
</body>
</html>
