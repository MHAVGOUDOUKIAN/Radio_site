<?php

require 'utils.php';
require 'database.php';

init_session();

if(isset($_POST['del_radio_btn']) && is_logged()) {
    del_radio($_POST['radio_selection'], $_SESSION['email']);
}

header('Location: index.php');