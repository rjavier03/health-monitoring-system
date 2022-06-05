<?php
    session_start();
    include ('connector.php');

    unset($_SESSION["company_name"]);
    unset($_SESSION["company_id"]);
    unset($_SESSION["admin_id"]);

    header("Location: ../index.php");  





?>