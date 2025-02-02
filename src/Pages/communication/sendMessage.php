<?php

use App\Models\Chat;

if(($_GET['content'] !== '') && ($_GET['id']) != 0){
    $content = $_GET['content'];    
    $id = $_GET['id'];

    $chat = new Chat();

    $chat->sendMessage($id, $content);

    echo'sended';
}else{
    echo 'no';
}