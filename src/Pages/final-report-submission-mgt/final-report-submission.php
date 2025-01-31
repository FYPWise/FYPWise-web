<?php
use App\Models\Base;
use App\Models\FinalSubmissionModel;

$base = new Base("Final Report Submission");
$pdo = new PDO("mysql:host=localhost;dbname=fypwise;charset=utf8", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
$model = new FinalSubmissionModel($pdo);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userID = 3;
$studentDetails = null;

if ($userID) {
    $studentDetails = $model->getStudentDetails($userID);
}

$uploadDir = __DIR__ . '/../../uploads/';
$uploadOk = 1;
$allowedTypes = ['pdf', 'doc', 'docx'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_report'])) {
    if (!empty($_FILES['report_file']['name']) && isset($studentDetails['student_id'])) {
        $fileName = basename($_FILES['report_file']['name']);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $targetFilePath = $uploadDir . $fileName;

 
        if (!in_array($fileType, $allowedTypes)) {
            echo "<script>alert('Only PDF, DOC, and DOCX files are allowed.');</script>";
            $uploadOk = 0;
        }

    
        if ($_FILES['report_file']['size'] > 5000000) {
            echo "<script>alert('File is too large. Max 5MB.');</script>";
            $uploadOk = 0;
        }

    
        if ($uploadOk && move_uploaded_file($_FILES['report_file']['tmp_name'], $targetFilePath)) {
            $relativeFilePath = 'src/uploads/' . $fileName;
            $model->submitFinalReport($studentDetails['student_id'], $relativeFilePath);
            echo "<script>alert('Final report submitted successfully!'); window.location.href=window.location.href;</script>";
            exit();
        } else {
            echo "<script>alert('Error uploading file.');</script>";
        }
    } else {
        echo "<script>alert('Please select a file to upload.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($base->getTitle(), ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="styles.css">
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
                        value="<?php echo htmlspecialchars($studentDetails['name'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label>Student ID:</label>
                    <input type="text"
                        value="<?php echo htmlspecialchars($studentDetails['studentID'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label>Project Title:</label>
                    <input type="text"
                        value="<?php echo htmlspecialchars($studentDetails['project_title'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label>Submit Report:</label>
                    <input type="file" name="report_file" required>
                </div>
                <button type="submit" name="submit_report" class="btn-submit">Submit</button>
            </form>
        </div>
        <?php $base->renderFooter(); ?>
    </body>

</html>