<?php
    include "db.php";
    $conn = connectDB();

    $id = $_POST['id'];
    $sql = "SELECT * FROM members WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result); // 제일 위 한줄만 가져오는 것 : fetch

    // 얘는 같은게 있어도 한개밖에 없을거니까 while문 돌 필요 없고, fetch를 여러번 할 필요도 없음(있냐/없냐가 중요)..
    if($data)
    {
        echo '<span class="text-danger"><span class="material-icons icon">error</span> 이미 사용중인 아이디입니다.</span>';
    }
    else
    {
        echo '<span class="text-success"><span class="material-icons icon">expand_circle_down</span> 사용할 수 있는 아이디입니다.</span>';
    }
   
    closeDB($conn);
?>