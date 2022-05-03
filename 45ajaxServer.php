<!-- 뭔가 실시간으로 데이터 비교하고 서버통신하는건 ajax로밖에 할 수 없다 -->

<?php
    $userList[1] = "test";
    $userList[2] = "admin";
    $userList[3] = "kdhong";
    $userList[4] = "sslee";
    $userList[5] = "tester";

    $keywords = "국민은행, 하나은행, kbstar, KB, 대한민국, 우리나라, 컴퓨터, 교육, 시스템, 운영체제, 네트워크, 학생, 선생, 교육장, 금융, 은행, 학원, 멀티캠퍼스"

    $key = $_POST['key']; // get 방식으로 넘어온 key 값을 담는 변수 만들기
    $flag = false;

    // 1 : 1
    // 2 : 11
    // 3 : 21

    for($i=1; $i<=5; $i++)
    {
        if($userList[$i] == $key) // 중복된 아이디가 있는 경우
        {
            $flag = true;
            echo "이미 사용중인 아이디입니다.";
            break;
        }
    }

    if($flag == false)
    {
        echo "사용 가능한 아이디입니다.";
    }
    // echo "your input is $key ";
?>