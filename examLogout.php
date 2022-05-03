<?php
    session_save_path("./sess");
    session_start();
    include "config.php";

    $msg = "$_SESSION[$sessName]"."님, 안녕히가세요.";

    echo "
        <script>
            alert('$msg');
            location.href='exam2.php';
        </script>
    ";

    session_destroy();
?>