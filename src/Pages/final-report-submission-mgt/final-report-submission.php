<?php
use App\Models\Base;
use App\Models\FinalSubmissionModel;

$base = new Base("Final Report Submission", ["student"]);
$finalSubmissionModel = new FinalSubmissionModel();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_report'])) {
    $submissionMessage = $finalSubmissionModel->submitFinalReport();
    echo "<script>alert('" . addslashes($submissionMessage) . "'); window.location.href='/FYPWise-web/final-submission';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0px;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            margin-top: 100px;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f9f9f9;
        }

        input[readonly] {
            background-color: #e9ecef;
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: #0056b3;
        }
    </style>
</head>
<div id="outer-container">
    <?php $base->renderHeader(); ?>

    <body>
        <div class="container">
            <h1>Final Report Submission</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Full Name:</label>
                    <input type="text"
                        value="<?php echo htmlspecialchars($_SESSION['name'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label>Student ID:</label>
                    <input type="text"
                        value="<?php echo htmlspecialchars($_SESSION['id'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label>Project Title:</label>
                    <input type="text"
                        value="<?php echo htmlspecialchars($_SESSION["project_title"] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label>Submit Report:</label>
                    <input type="file" name="report_file" accept="application/pdf" required>
                </div>
                <button type="submit" name="submit_report" class="btn-submit">Submit</button>
            </form>
        </div>
        <?php $base->renderFooter(); ?>
    </body>
</div>
</html>
