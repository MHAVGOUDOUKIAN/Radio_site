<?php
    require 'utils.php';
    require 'database.php';
    
    init_session();

    echo var_dump($_SESSION);
    echo var_dump($_POST);

    if(isset($_POST['create_account_btn']) && !is_logged()) {
        if(isset($_POST['email_field']) && !empty($_POST['email_field']) &&
        isset($_POST['pass_field']) && !empty($_POST['pass_field']) &&
        isset($_POST['name_field']) && !empty($_POST['name_field']) &&
        isset($_POST['surname_field']) && !empty($_POST['surname_field'])) {
            insert_user_into_db($_POST['name_field'],$_POST['surname_field'], $_POST['pass_field'], $_POST['email_field']);
        }
    }

    if(isset($_POST['login_btn']) && !is_logged()) {
        if(isset($_POST['email_field']) && !empty($_POST['email_field']) &&
        isset($_POST['pass_field']) && !empty($_POST['pass_field'])) {
            $user_info = get_users($_POST['email_field'], $_POST['pass_field']);
            if($user_info) {
                $_SESSION['username'] = $user_info['name'];
                $_SESSION['firstname'] = $user_info['surname'];
                $_SESSION['email'] = $user_info['email'];
            }
        }
    }

    header('Location: index.php');