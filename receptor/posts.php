<?php

function isJson($string) {
   json_decode($string);
   return json_last_error() === JSON_ERROR_NONE;
}

if(!isset($_POST['token']) || $_POST['token'] !== 'FatfatEatShit') return;
if(!isset($_POST['data']) || !isJson($_POST['data'])) return;

$content = $_POST['data'];

$myfile = fopen("posts.json", "w");
fwrite($myfile, $content);
fclose($myfile);