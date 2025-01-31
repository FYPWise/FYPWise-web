<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>
        <?php if (isset($error)) { ?>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = document.getElementById('errorModal');
                var closeBtn = document.getElementsByClassName('close')[0];
                modal.style.display = 'block';
                closeBtn.onclick = function() {
                    modal.style.display = 'none';
                }
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = 'none';
                    }
                }
            });
        <?php } ?>
    </script>
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 30px;
            border: 1px solid #888;
            width: 30%;
        }

        .close {
            position: relative;
            bottom: 5px;
            color: #aaa;
            float: right;
            font-size: 24px;
            font-weight: bold;
        }

        .close:hover {
            color: black;
            cursor: pointer;
        }
    </style>
    <!-- Modal -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p><?php echo $error; ?></p>
        </div>
    </div>
</body>

</html>