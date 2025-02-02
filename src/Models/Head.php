<?php

namespace App\Models;

class Head{
    private $pageTitle;
    
    public function __construct($pageTitle) {
        $this->pageTitle = $pageTitle;
        echo('
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type="image/x-icon" href="/FYPWise-web/src/assets/main_logo.png">
            <title>'.$pageTitle. '</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet"
            href="https://db.onlinewebfonts.com/c/65dc1b4fb1cd6bf31e730421533dafc7?family=ITC+Avant+Garde+Gothic+W02+Md">
            <link rel="stylesheet" href="/FYPWise-web/src/css/common-ui.css?v=<?php echo time(); ?>">
        </head>
        ');
    }
}
