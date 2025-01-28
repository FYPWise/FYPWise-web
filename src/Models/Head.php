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
            <link rel="icon" type="image/x-icon" href="./src/assets/main_logo.png">
            <title>Page Skeleton</title>
            <link rel="stylesheet" href="./src/css/common-ui.css">
        </head>
        ');
    }
}