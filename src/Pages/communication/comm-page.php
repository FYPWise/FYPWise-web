<?php
use App\Models\Base;
use App\Models\User;
use App\Models\Chat;

$base = new Base("Communication");

$user = new User($_SESSION['id']);
$chat = new Chat();

$chats = $chat->getChat($user);

foreach ($chats as $chat) {
    echo $chat['type']. "".$chat['id'];
    echo "-----";
}
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
                                <button type="button" class="chat-button">
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


                        <li class="chat-entry-list chat-received">
                            <section class="chat-entry">
                                <h4 class="chat-sender-name">Deepak Kumar</h1>
                                    <div class="chat-bubble">
                                        <p class="chat-date">21/12/2024</p>
                                        <p class="chat-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna
                                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                            nisi ut aliquip ex ea commodo consequat. Duis
                                            aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                            fugiat nulla pariatur. Excepteur sint
                                            occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                                            anim id est laborum.</p>
                                        <p class="chat-time">11:36 AM</p>
                                    </div>
                            </section>
                        </li>

                        <li class="chat-entry-list chat-sended">
                            <section class="chat-entry">
                                <h4 class="chat-sender-name">You</h1>
                                    <div class="chat-bubble">
                                        <p class="chat-date">21/12/2024</p>
                                        <p class="chat-text">Hello Bos</p>
                                        <p class="chat-time">11:40 AM</p>
                                    </div>
                            </section>
                        </li>

                        <li class="chat-entry-list chat-received">
                            <section class="chat-entry">
                                <h4 class="chat-sender-name">Deepak Kumar</h1>
                                    <div class="chat-bubble">
                                        <p class="chat-date">21/12/2024</p>
                                        <p class="chat-text">Lorem ipsum dolor sit amet.</p>
                                        <p class="chat-time">11:37 AM</p>
                                    </div>
                            </section>
                        </li>

                        <li class="chat-entry-list chat-sended">
                            <section class="chat-entry">
                                <h4 class="chat-sender-name">You</h1>
                                    <div class="chat-bubble">
                                        <p class="chat-date">21/12/2024</p>
                                        <p class="chat-text">Lorem ipsum odor amet, consectetuer adipiscing elit.
                                            Ultricies senectus curabitur litora cras, id curabitur. Mauris
                                            augue at diam gravida nisi. Montes placerat tempor dis pulvinar rhoncus
                                            sodales imperdiet est. Curae elit ornare
                                            facilisis sem ex. Mollis fermentum sociosqu suscipit bibendum imperdiet
                                            risus.</p>
                                        <p class="chat-time">11:40 AM</p>
                                    </div>
                            </section>
                        </li>

                        <li class="chat-entry-list chat-received">
                            <section class="chat-entry">
                                <h4 class="chat-sender-name">Deepak Kumar</h1>
                                    <div class="chat-bubble">
                                        <p class="chat-date">21/12/2024</p>
                                        <p class="chat-text">Lorem ipsum odor amet, consectetuer adipiscing elit.
                                            Ultricies senectus curabitur litora cras, id curabitur. Mauris
                                            augue at diam gravida nisi. Montes placerat tempor dis pulvinar rhoncus
                                            sodales imperdiet est. Curae elit ornare
                                            facilisis sem ex. Mollis fermentum sociosqu suscipit bibendum imperdiet
                                            risus.Lorem ipsum odor amet, consectetuer adipiscing elit.
                                            Ultricies senectus curabitur litora cras, id curabitur. Mauris
                                            augue at diam gravida nisi. Montes placerat tempor dis pulvinar rhoncus
                                            sodales imperdiet est. Curae elit ornare
                                            facilisis sem ex. Mollis fermentum sociosqu suscipit bibendum imperdiet
                                            risus.</p>
                                        <p class="chat-time">11:37 AM</p>
                                    </div>
                            </section>
                        </li>

                        <li class="chat-entry-list chat-received">
                            <section class="chat-entry">
                                <h4 class="chat-sender-name">Deepak Kumar</h1>
                                    <div class="chat-bubble">
                                        <p class="chat-date">21/12/2024</p>
                                        <p class="chat-text">Lorem ipsum odor amet, consectetuer adipiscing elit.
                                            Ultricies senectus curabitur litora cras, id curabitur. Mauris
                                            augue at diam gravida nisi. Montes placerat tempor dis pulvinar rhoncus
                                            sodales imperdiet est. Curae elit ornare
                                            facilisis sem ex. Mollis fermentum sociosqu suscipit bibendum imperdiet
                                            risus.Lorem ipsum odor amet, consectetuer adipiscing elit.
                                            Ultricies senectus curabitur litora cras, id curabitur. Mauris
                                            augue at diam gravida nisi. Montes placerat tempor dis pulvinar rhoncus
                                            sodales imperdiet est. Curae elit ornare
                                            facilisis sem ex. Mollis fermentum sociosqu suscipit bibendum imperdiet
                                            risus.</p>
                                        <p class="chat-time">11:37 AM</p>
                                    </div>
                            </section>
                        </li>

                        <li class="chat-entry-list chat-received">
                            <section class="chat-entry">
                                <h4 class="chat-sender-name">Deepak Kumar</h1>
                                    <div class="chat-bubble">
                                        <p class="chat-date">21/12/2024</p>
                                        <p class="chat-text">Lorem ipsum odor amet, consectetuer adipiscing elit.
                                            Ultricies senectus curabitur litora cras, id curabitur. Mauris
                                            augue at diam gravida nisi. Montes placerat tempor dis pulvinar rhoncus
                                            sodales imperdiet est. Curae elit ornare
                                            facilisis sem ex. Mollis fermentum sociosqu suscipit bibendum imperdiet
                                            risus.Lorem ipsum odor amet, consectetuer adipiscing elit.
                                            Ultricies senectus curabitur litora cras, id curabitur. Mauris
                                            augue at diam gravida nisi. Montes placerat tempor dis pulvinar rhoncus
                                            sodales imperdiet est. Curae elit ornare
                                            facilisis sem ex. Mollis fermentum sociosqu suscipit bibendum imperdiet
                                            risus.</p>
                                        <p class="chat-time">11:37 AM</p>
                                    </div>
                            </section>
                        </li>
                    </ul>

                </div>
            </div>


        </div>

        <script>
            var chatButton = document.getElementsByClassName("chat-button");

            for (i = 0; i < chatButton.length; i++) {
                chatButton[i].addEventListener("click", function () {
                    this.classList.add("chat-button-active");
                    for (j = 0; j < chatButton.length; j++) {
                        if (this != chatButton[j]) {
                            chatButton[j].classList.remove("chat-button-active");
                        }
                    }
                });
            }
        </script>

        <?php $base->renderFooter() ?>
    </div>
</body>

</html>