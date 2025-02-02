<?php
use App\Models\Chat;
use App\Models\User;

$chat = new Chat();

isset($_GET['id']) ? $id = $_GET['id'] : exit();

?>
<ul class="chat-list">

<?php
if ($chat->loadChat($id)) {
    $latestId = $chat->getLatestMessage();
    foreach ($chat->messages as $message) {
        if ($message->getSenderId() == $_SESSION['mySession']){
            $name = "You";
            $sended = true;
        }else{
            $user = new User();
            $user->readUserId($message->getSenderId());
            $name = $user->getName();
            $sended = false;
        }
        
        ?>
        
        <li class="chat-entry-list chat-<?php echo $sended ? 'sended' : 'received' ?>">
            <section class="chat-entry">
                <h4 class="chat-sender-name"><?php echo $name ?></h1>
                    <div class="chat-bubble">
                        <p class="chat-date"><?php echo $message->getDate() ?></p>
                        <p class="chat-text"><?php echo $message->getContent() ?></p>
                        <p class="chat-time"><?php echo $message->getTime() ?></p>
                    </div>
            </section>
        </li>

    <?php } ?> </ul>  <?php
}else{ 
    $latestId = "null";
    ?>
    
    <p>No chat in history</p>

<?php }

?>

</ul>

<script>

    id = "<?php echo $id ?>";
    latestId = "<?php echo $latestId ?>";

</script>