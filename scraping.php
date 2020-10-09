<?php

require_once("./phpQuery-onefile.php");

$html = file_get_contents("https://www.itmedia.co.jp/");

echo phpQuery::newDocument($html)->find("h3")->text();