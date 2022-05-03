<?php 
    if(isset($_SESSION[$sessId]) and $_SESSION[$sessLevel] >= $adminLevel)
    {

    } else
    {
        echo "
        <script>
            alert('잘못된 접근입니다.');
            location.href='main.php';
        </script>
        ";

        exit(); /* 브라우저마다 알럿 띄우고 뒤로 계속 진행하는 것도 있어서, 브라우저 타지 않고 무조건 종료되는 코드 */
    }
?>

사용자 관리