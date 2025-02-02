<?php
use App\Models\Base;
use App\Models\CriteriaModel;
use App\Models\Db;


$base = new Base("Criteria Score Page", ['lecturer']);
$db = new Db();
$criteriaModel = new CriteriaModel($db);

// Get marksheet ID from URL or default to an empty value
$marksheetID = isset($_GET['marksheetID']) ? htmlspecialchars($_GET['marksheetID']) : '';

$criteriaScores = $criteriaModel->getCriteriaScoresByMarksheetID($marksheetID);

// Convert the retrieved data into an associative array for easy access
$scoresData = [];
foreach ($criteriaScores as $score) {
    $scoresData[$score['criteria']] = [
        'score' => $score['score'],
        'comment' => $score['comment']
    ];
}

// Handle form submission (Updating Scores)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['marksheetID'], $_POST['evaluatorID'])) {
        echo "<script>alert('❌ Missing required fields!'); history.back();</script>";
        exit();
    }

    $marksheetID = $_POST['marksheetID'];
    $evaluatorID = $_POST['evaluatorID'];
    $scores = $_POST['scores'];
    $comments = $_POST['comments'];

    foreach ($scores as $criteria => $score) {
        $comment = $comments[$criteria] ?? '';

        // Check if score exists for the criteria
        if (isset($scoresData[$criteria])) {
            // Update existing score
            $criteriaModel->updateCriteriaScoreByMarksheet($marksheetID, $criteria, $score, $comment);
        } else {
            // Insert new score if not already recorded
            $criteriaModel->insertCriteriaScore($score, $criteria, $comment, $marksheetID, $evaluatorID);
        }
    }

    echo "<script>alert('✅ Criteria scores updated successfully!'); window.location.href='/FYPWise-web/marksheetpage';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criteria Score</title>
    <link rel="stylesheet" href="../css/common-ui.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .form-container {
            max-width: 600px;
            margin: 2em auto;
            background-color: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            text-align: center;
        }
        .header-info {
            margin-bottom: 1.5em;
            text-align: center;
            font-size: 1.1em;
            font-weight: bold;
            color: #06509f;
        }
        .header-info span {
            color: black;
            font-weight: normal;
        }
        .criteria-section {
            margin-bottom: 1.5em;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1.5em;
            background-color: #f9f9f9;
            text-align: left;
        }
        .criteria-section h3 {
            margin: 0 0 10px;
            color: #06509f;
            font-size: 1.2em;
        }
        .criteria-input {
            display: flex;
            flex-direction: column;
            gap: 0.8em;
        }
        .criteria-input input,
        .criteria-input textarea {
            width: 100%;
            padding: 0.75em;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            box-sizing: border-box;
        }
        .form-buttons {
            display: flex;
            justify-content: center;
            gap: 1em;
            margin-top: 1.5em;
        }
        .btn {
            padding: 0.75em 1.5em;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
            color: #fff;
        }
        .btn.submit {
            background-color: #4CAF50;
        }
        .btn.cancel {
            background-color: #e74c3c;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>


        <?php $base->renderMenu(); ?>

        <div id="main-container">
            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?php echo $base->getTitle(); ?></h1>

                    <div class="form-container">
                        <div class="header-info">
                            Marksheet ID: <span><?php echo $marksheetID; ?></span>
                        </div>

                        <form method="POST" action="/FYPWise-web/criteriapage">
                            <input type="hidden" name="marksheetID" value="<?php echo htmlspecialchars($marksheetID); ?>">

                            <!-- Evaluator ID Input Field -->
                            <div class="criteria-section">
                                <h3>Evaluator ID</h3>
                                <div class="criteria-input">
                                    <input type="text" name="evaluatorID" placeholder="Enter Evaluator ID" required>
                                </div>
                            </div>

                            <?php
                            $criteriaLabels = [
                                "project_mgt" => "Project Management",
                                "execution" => "Execution",
                                "report" => "Report",
                                "oral_presentation" => "Oral Presentation",
                                "research_paper" => "Research Paper",
                                "commercialization_prpsl" => "Commercialization Proposal",
                                "poster_presentation" => "Poster Presentation"
                            ];

                            foreach ($criteriaLabels as $key => $label) {
                                $existingScore = $scoresData[$key]['score'] ?? '';
                                $existingComment = $scoresData[$key]['comment'] ?? '';

                                echo "<div class='criteria-section'>
                                        <h3>$label</h3>
                                        <div class='criteria-input'>
                                            <input type='number' name='scores[$key]' value='$existingScore' placeholder='Enter Score' required>
                                            <textarea name='comments[$key]' rows='3' placeholder='Add Comments (if any)'>$existingComment</textarea>
                                        </div>
                                      </div>";
                            }
                            ?>

                            <div class="form-buttons">
                                <button type="submit" class="btn submit">Save Changes</button>
                                <button type="reset" class="btn cancel">Reset</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>

        <?php $base->renderFooter(); ?>
    </div>
</body>
</html>
