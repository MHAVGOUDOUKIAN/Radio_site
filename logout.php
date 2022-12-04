<?php
    require 'utils.php';

    init_session();
    end_session();
    header('Location: index.php');