<?php

use App\Models\Base;
use App\Models\CriteriaModel;
use App\Models\SideMenu;
use App\Models\Db;

$base = new Base("Criteria Score Page");
$sideMenu = new SideMenu();
$db = new Db();
$criteriaModel = new CriteriaModel($db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $marksheetID = $_POST['marksheetID'];
    $evaluatorID = $_POST['evaluatorID'];
    $scores = $_POST['scores'];
    $comments = $_POST['comments'];

    foreach ($scores as $criteria => $score) {
        $comment = $comments[$criteria] ?? '';
        $criteriaModel->insertCriteriaScore($score, $criteria, $comment, $marksheetID, $evaluatorID);
    }

    header("Location: " . $_SERVER["HTTP_REFERER"]);
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

        <!-- Main Content -->
        <div id="main-container">
            <!-- Side Menu -->
            <?php $sideMenu->render(); ?>

            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?php echo $base->getTitle(); ?></h1>

                    <div class="form-container">
                        <div class="header-info">
                            Marksheet ID: <span>MK001</span><br>
                            Evaluator ID: <span>M123</span>
                        </div>

                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <input type="hidden" name="marksheetID" value="MK001">
                            <input type="hidden" name="evaluatorID" value="M123">

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
                                echo "<div class='criteria-section'>
                                        <h3>$label</h3>
                                        <div class='criteria-input'>
                                            <input type='number' name='scores[$key]' placeholder='Enter Score' required>
                                            <textarea name='comments[$key]' rows='3' placeholder='Add Comments (if any)'></textarea>
                                        </div>
                                      </div>";
                            }
                            ?>

                            <div class="form-buttons">
                                <button type="submit" class="btn submit">Submit</button>
                                <button type="reset" class="btn cancel">Cancel</button>
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