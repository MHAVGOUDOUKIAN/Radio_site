<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("maxime-havgoudoukian-etu.pedaweb.univ-amu.fr:80", "h19021074", "eKGsdnf8BSb2Shy", "h19021074");

echo $mysqli

$mysqli->query("DROP TABLE IF EXISTS test");

?>