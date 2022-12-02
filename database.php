<?php
$servername = "localhost";
$username = "h19021074";
$password = "eKGsdnf8BSb2Shy";

try {
  $conn = new PDO("mysql:host=$servername;dbname=eKGsdnf8BSb2Shy", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";

  $conn->query()
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>  