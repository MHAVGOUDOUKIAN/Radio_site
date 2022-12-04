<?php

require 'utils.php';
require 'database.php';

init_session();

echo $_SESSION['email'];
echo "\n".$_SESSION['username'];

if(isset($_POST['add_radio_btn']) && is_logged()) {
    add_radio($_POST["radio_name"],$_POST["radio_url"], $_POST["radio_lat"], $_POST["radio_long"], $_SESSION['email']);
}

header('Location: index.php');