<?php

    $id = $_POST["id"];
    $pass = $_POST["pass"];

    $sql = "SELECT * FROM members WHERE id='$id' and pass=password('$pass')";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    if($data)
    {
        $_SESSION[$sessName] = $data["name"];
        $_SESSION[$sessId] = $data["id"];
        $_SESSION[$sessLevel] = $data["level"];
        $msg = "$_SESSION[$sessName] 님, 반갑습니다.";
    }else
    {
        $msg = "아이디와 비밀번호를 확인하세요";
    }

    echo "
    <script>
        alert('$msg');
        location.href='main.php';
    </script>
    ";
?>