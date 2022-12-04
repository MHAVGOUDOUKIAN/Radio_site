<?php

function connect_to_db() {
  $host = "localhost";
  $dbname = "WebRadio";
  $user = "psql_periodic";
  $pass = "H1mg12SN50";

  try {
    $PDO = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "PDOection failed: " . $e->getMessage();
  }

  return $PDO;
}

function insert_user_into_db($name, $surname, $pass, $email) {
  $PDO = connect_to_db();
  
  $pass = password_hash($pass, PASSWORD_BCRYPT);
  $query = "SELECT * from users WHERE email='$email';";
  $res = $PDO->query($query, PDO::FETCH_ASSOC);
  if(!$res->fetch()) {
    $query = "INSERT INTO users (name, surname, hash_pass, email) VALUES ('$name','$surname','$pass','$email');";
    $PDO->query($query);
    $query = "INSERT INTO radios (name, url, long, lat, own_by) VALUES ('RTL2','http://streaming.radio.rtl.fr/rtl-1-44-128',48.88405934210131,2.2723762360776267,'$email');";
    $PDO->query($query);
    $query = "INSERT INTO radios (name, url, long, lat, own_by) VALUES ('France info','https://icecast.radiofrance.fr/franceinter-midfi.mp3',48.85326698142289,2.2781261047018315,'$email');";
    $PDO->query($query);
    $query = "INSERT INTO radios (name, url, long, lat, own_by) VALUES ('Sud Radio','https://start-sud.ice.infomaniak.ch/start-sud-high.mp3',48.903531879069234,2.2403908651476234,'$email');";
    $PDO->query($query);
    $query = "INSERT INTO radios (name, url, long, lat, own_by) VALUES ('Radio Classique','https://radioclassique.ice.infomaniak.ch/radioclassique-high.mp3',48.87653675275951,2.3205542137869104,'$email');";  
    $PDO->query($query);
  }
}

function get_users($email, $pass) {
  $PDO = connect_to_db();

  $query = "SELECT * FROM users WHERE email = '$email';";
  $res = $PDO->query($query, PDO::FETCH_ASSOC);
  return $res->fetch();
}

function add_radio($name, $url, $lat, $long, $owner_email) {
  $PDO = connect_to_db();

  $query = "INSERT INTO radios (name, url, lat, long, own_by) VALUES ('$name','$url',$lat,$long, '$owner_email');";
  $PDO->query($query);
}

function get_radio_by_owner($owner_email) {
  $PDO = connect_to_db();

  $query = "SELECT * FROM radios WHERE own_by = '$owner_email';";
  $res = $PDO->query($query, PDO::FETCH_ASSOC);
  return $res->fetchAll();
}