<?php
use App\Models\Base;
$base = new Base("Milestone Submission");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milestone Submission</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            padding-top: 50px;
        }
        #outer-container {
            width: 100%;
        }
        #main-container {
            display: flex;
            min-height: 100vh;
        }
        #side-menu {
            width: 250px;
            background: #0044cc;
            color: white;
            padding: 20px;
        }
        .menu-button {
            background: none;
            border: none;
            color: white;
            text-align: left;
            width: 100%;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
        }
        .menu-button:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            background: white;
            border-radius: 10px;
            margin: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            color: #0044cc;
            text-align: center;
        }
        .form {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
        }
        textarea, input[type="date"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-buttons {
            display: flex;
            justify-content: space-between;
        }
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .edit-btn {
            background: #ff9800;
            color: white;
        }
        .save-btn {
            background: #4CAF50;
            color: white;
        }
        .reset-btn {
            background: #f44336;
            color: white;
        }
        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>


            <div class="content">
                <h2 class="form-title">Milestone Submission</h2>
                <hr>
                <form id="milestone-form" class="form">
                    <div class="form-group">
                        <label for="milestone-id">Milestone ID</label>
                        <p id="milestone-id">M1</p>
                    </div>
                    <div class="form-group">
                        <label for="milestone-description">Milestone Description</label>
                        <textarea id="milestone-description" name="description" readonly>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ultrices odio odio, at lacinia metus aliquet eget.
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="start-date">Start Date</label>
                        <input type="date" id="start-date" name="start-date" value="2025-01-10" readonly>
                    </div>
                    <div class="form-group">
                        <label for="end-date">End Date</label>
                        <input type="date" id="end-date" name="end-date" value="2025-05-31" readonly>
                    </div>
                    <div class="form-buttons">
                        <button type="button" id="edit-btn" class="btn edit-btn" onclick="toggleEdit(true)">Edit</button>
                        <button type="button" id="save-btn" class="btn save-btn" style="display:none;" onclick="saveChanges()">Save</button>
                        <button type="reset" id="reset-btn" class="btn reset-btn" onclick="resetForm()">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <?php $base->renderFooter() ?>
    </div>
</body>
</html>