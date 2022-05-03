<?php
    session_save_path("./sess");
    session_start();
    include "config.php";

	if(isset($_POST["id"]) and $_POST["id"]=="test")
    {
        $_SESSION[$sessName]="김예지";
        $_SESSION[$sessId]="test";
        $msg="$_SESSION[$sessName]"."님, 안녕하세요.";
    } else
    {
        $msg="아이디와 비밀번호를 확인하세요.";
    }

    echo "
        <script>
            alert('$msg');
            location.href='exam2.php';
        </script>
    ";
?>