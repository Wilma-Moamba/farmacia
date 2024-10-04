<?php
    session_start();

    if (!(isset($_SESSION['nome'])))
        header ("Location: ../../index.php");

    if (!(isset($_SESSION['role'])))
    header ("Location: ../../index.php");

?>