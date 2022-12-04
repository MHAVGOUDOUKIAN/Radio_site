<?php

function init_session() : bool {
    if(!session_id()) {
        session_start();
        session_regenerate_id();
        return true;
    }

    return false;
}

function end_session() {
    session_unset();
    session_destroy();
}

function is_logged() : bool {
    if(isset($_SESSION['username']) && !empty($_SESSION['username']) && isset($_SESSION['email']) && !empty($_SESSION['email'])) {
        return true;
    }
    return false;
}

init_session();