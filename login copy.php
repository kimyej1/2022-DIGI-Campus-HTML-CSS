<?php
	session_save_path("./sess"); /* 나도 sess폴더에서 로그인 이런거 확인할거야 */
	session_start();

	include "config.php";

    if(isset($_POST["id"]) and $_POST["id"]=="test") /* method="post" 로 넘어온 id값이 있나? -> 그 id가 test인가? */
    {
        $_SESSION[$sessName]="김예지";
        $_SESSION[$sessId]="test";
        $_SESSION[$sessLevel]=1;

        $_SESSION[$sessTel]='010-8978-6405';
        $_SESSION[$sessEmail]='yeji2501@gmail.com';
        $_SESSION[$sessAddress]='수원시 팔달구';

        $msg="$_SESSION[$sessName]"."님, 반갑습니다.";
    } else if(isset($_POST["id"]) and $_POST["id"]=="admin")
    {
        $_SESSION[$sessName]="관리자";
        $_SESSION[$sessId]="admin";
        $_SESSION[$sessLevel]=9;
        
        $_SESSION[$sessTel]='010-1234-5678';
        $_SESSION[$sessEmail]='admin@gmail.com';
        $_SESSION[$sessAddress]='서울시 영등포구 여의도동';

        $msg="$_SESSION[$sessName]"."님, 반갑습니다.";
    } else
    {
        $msg="아이디와 비밀번호를 확인하세요.";
    }

    echo "
        <script>
            alert('$msg');
            location.href='main.php';
        </script>
    ";
?>