<?php
use App\Models\Base;
use App\Models\User;
use App\Models\Chat;

$base = new Base("Communication");

$user = new User($_SESSION['id']);
$chat = new Chat();

$chats = $chat->getChat();

$chat->loadChat('1');
?>

<link rel="stylesheet" href="./src/css/comm-style.css">

<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $base->renderMenu() ?>

            <!-- Main Container -->
            <div class="content">
                <div id="page-side">
                    <ul id="chat-menu">
                        <?php foreach ($chats as $chat){ ?>
                            <li class="chat-menu-list">
                                <button type="button" class="chat-button" name="<?php echo $chat['type'] ?>" id="<?php echo $chat['id'] ?>">
                                    <span class="chat-label"><?php echo $chat['name'] ?></span>
                                    <span class="chat-icon <?php echo $chat['type'] ?>-chat-icon"></span>
                                </button>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <section class="main">
                    <h1 id="page-name">Communication Page</h1>
                </section>

                <div id="chat-container">

                    <ul class="chat-list">

                    </ul>

                </div>
            </div>


        </div>

        <script>
            
            var outerContainer = document.getElementById("outer-container");

            outerContainer.scrollTop = outerContainer.scrollHeight;

            let interval;

            function openChat(id, type){
            if (id !== ""){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        document.getElementById("chat-container").innerHTML = this.responseText;

                        var scripts = document.getElementById("chat-container").getElementsByTagName("script");
                        for (var i = 0; i < scripts.length; i++) {
                            eval(scripts[i].innerHTML); // Execute script code
                        }
                    }
                };
                xmlhttp.open("GET", "openchat?id="+id+"&type="+type, true);
                xmlhttp.send();
                
                interval = setInterval(function() {
                    checkNewMessage(id, latestId);
                }, 1000);

                
                }
            }

            var chatButton = document.getElementsByClassName("chat-button");

            for (i = 0; i < chatButton.length; i++) {
                chatButton[i].addEventListener("click", function () {
                    this.classList.add("chat-button-active");
                    this.setAttribute("disabled", "true");
                    if (typeof interval === 'number'){
                        clearInterval(interval);
                    }else{
                    }
                    openChat(this.getAttribute('id'), this.getAttribute('name'));
                    for (j = 0; j < chatButton.length; j++) {
                        if (this != chatButton[j]) {
                            chatButton[j].classList.remove("chat-button-active");
                            chatButton[j].removeAttribute("disabled");
                        }
                    }
                });
            }

            function checkNewMessage(id, latest){
                if (id !== ""){
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function(){
                        if (this.readyState == 4 && this.status == 200){
                            var chatList = document.getElementsByClassName("chat-list")[0];
                            chatList.innerHTML += this.responseText;

                            var scripts = chatList.getElementsByTagName("script");
                            for (var i = 0; i < scripts.length; i++) {
                                eval(scripts[i].innerHTML); // Execute script code
                            }
                        }
                    };
                    xmlhttp.open("GET", "newMessage?id="+id+"&latest="+latest, true);
                    xmlhttp.send();
                    
                    }
            }
        </script>

        <?php $base->renderFooter() ?>
    </div>
</body>

</html>