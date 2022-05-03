<?php
	session_save_path("./sess");
	session_start();

	include "config.php"; 
    /* 이름이나 id를 넣어주고싶으면 변수때문에 config가 필요하고, 그냥 로그아웃만 시켜줄거면 include 불필요 */

    $outName = $_SESSION[$sessName];
    $msg = "$outName"." 님, 안녕히가세요."; /* "." 이렇게 하면 문장 이어붙어서 나옴 (홍길동님) */

    session_destroy(); /* session파일의 데이터 모두 지우기 (close) */

    echo "
        <script>
            alert('$msg');
            location.href='main.php';
        </script>
    ";
?>