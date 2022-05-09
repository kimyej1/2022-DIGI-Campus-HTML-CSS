<?php
   
    if(!isset($_GET["cnt"]))
        $cnt = 1;       // count 초기값 1로 설정
    else
        $cnt = $_GET["cnt"];

    $letters = "abcdefghijklmnopqrstuvwxyz";
    $lastIndex = strlen($letters)-1;
    $lastLetter = $letters[$lastIndex];
    
    $len = strlen($letters); 
    $maxCnt = $len * $len * $len * $len;

    if($cnt > $maxCnt)
    {
        echo "Not Found..";     // 다 돌았는데 값 못찾았을때
        exit;
    } else
    {
        $pass4 = ($cnt % $len) -1;
        $pass3 = ((ceil($cnt / $len)) -1) % $len;
        $pass2 = ((ceil($cnt / ($len * $len))) -1) % $len;
        $pass1 = ((ceil($cnt / ($len * $len * $len))) -1) % $len;

        $passwd = $letters[$pass1].$letters[$pass2].$letters[$pass3].$letters[$pass4];

        $sql = "SELECT * FROM members WHERE id = 'test' AND pass = PASSWORD('$passwd')";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);
    
        if($data)
        {
            echo "Data found! Passwd is ". $passwd.".<br> (Cnt : ".$cnt.")<br>";
            exit;
        }else
        {
            $cnt++;
        }

        ?>
            <script>
            setTimeout(function()
            {
                location.href = 'main.php?cmd=<?php echo $cmd;?>&cnt=<?php echo $cnt;?>';
            }, 30)
            </script>
        <?php
    }
?>

<!--
    $second = 123456;   // 몇일 몇시간 몇분 몇초
    $day = (int)($second / (60 * 60 * 24));
    $hour = $second % (60 * 60 * 24);
    $hour = $hour / (60 * 60);

    echo "$day 일 $hour 시";

    -----------------------------------------

    1-26

    aaaz : 26번째 값
    aaba : 27   -- 27 / 26 = 1.xx
    aabz : 52   -- 52 / 26 = 2
    abaa : 26 * 26 + 1
    baaa : 26 * 26 * 26 + 1

    123456 / 26 / 26 ... / 26 = 7.0241..
--> 