<?php
use App\Models\Base;
use App\Models\FinalSubmissionModel;
//use PDO;

$base = new Base("Final Report Submission");
$pdo = new PDO("mysql:host=localhost;dbname=fypwise;charset=utf8", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
$model = new FinalSubmissionModel($pdo);

// Start session safely
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userID = $_SESSION['userID'] ?? null;
$studentDetails = null;

if ($userID) {
    $studentDetails = $model->getStudentDetails($userID);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_report'])) {
    if (!empty($_FILES['report_file']['name']) && isset($studentDetails['student_id'])) {
        $reportFile = $_FILES['report_file']['name'];
        $filePath = 'uploads/' . basename($reportFile);
        if (move_uploaded_file($_FILES['report_file']['tmp_name'], $filePath)) {
            $model->submitFinalReport($studentDetails['student_id'], $filePath);
            echo "<script>alert('Final report submitted successfully!'); window.location.reload();</script>";
        } else {
            echo "<script>alert('Error uploading file.');</script>";
        }
    } else {
        echo "<script>alert('Please select a file to upload.');</script>";
    }
}
?>

<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <div id="main-container">
            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?php echo htmlspecialchars($base->getTitle(), ENT_QUOTES, 'UTF-8'); ?></h1>
                    <div class="content" style="max-width: 600px; margin: auto; padding: 20px; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                        <h2 class="form-title" style="text-align: center;">Submit Final Report</h2>
                        <form method="POST" enctype="multipart/form-data">
                            <label>Full Name:</label>
                            <input type="text" value="<?php echo htmlspecialchars($studentDetails['full_name'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>" readonly>

                            <label>Student ID:</label>
                            <input type="text" value="<?php echo htmlspecialchars($studentDetails['student_id'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>" readonly>

                            <label>Project ID:</label>
                            <input type="text" value="<?php echo htmlspecialchars($studentDetails['project_id'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>" readonly>

                            <label>Submit Report:</label>
                            <input type="file" name="report_file" required>

                            <button type="submit" name="submit_report">Submit</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
        
        <?php $base->renderFooter(); ?>
    </div>
</body>