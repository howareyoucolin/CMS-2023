<?php

$data = file_get_contents(dirname(__FILE__).'/data.json');
$website_data = json_decode($data);

echo '<pre>';
var_dump($website_data);