<?php
    $keywords = "국민은행, 하나은행, kbstar, KB, 대한민국, 우리나라, 컴퓨터, 교육, 시스템, 운영체제, 네트워크, 학생, 선생, 교육장, 금융, 은행, 학원, 멀티캠퍼스";

    $key = $_POST["key"]; // get 방식으로 넘어온 key 값을 담는 변수 만들기
    $flag = false;

    $splitKey = explode(",", $keywords);
    /* 쉼표 기준으로 쪼개라
        splitKey[0] = 국민은행
        splitKey[1] = 하나은행 ...
    */

    $cnt = 0;
    while(isset($splitKey[$cnt]))
    {
        //              국민은행        은행
        $pos = strpos($splitKey[$cnt], $key);
        // 은행이라고 입력했을 때, '은행'이 들어있는 단어 보여주기

        if($pos === false) // not found
        {

        } else // found
        {
            echo "$splitKey[$cnt] <br>";
        }
        $cnt ++;
    }
?>