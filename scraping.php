<?php

require_once("./phpQuery-onefile.php");


$key = $_POST["comment"];

var_dump($key);

$html = file_get_contents("https://www.itmedia.co.jp/");

echo phpQuery::newDocument($html)->find("title")->text();