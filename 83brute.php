<?php
    $pass = "";

    $now = getNow();
    echo "now = $now <br>";

    $cnt = 0;
    $exitflag = false;

    $letters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $lastIndex = strlen($letters)-1;
    $lastLetter = $letters[$lastIndex];

    // 배열로 도는 것 확인
    // echo "0 : ". $letters[0]."<br>";
    // echo "1 : ". $letters[1]."<br>";

    // 문자~ 숫자는 연속적이지 않으므로, 연속된 형태로 만들고 배열의 연속 맞는지 확인
    // for($x = 0; $x < strlen($letters); $x++)
    // {
    //     echo "$x : ". $letters[$x]. "<br>";
    // }

    for($i=0; $i<=$lastIndex; $i++)
    {
        for($j=0; $j<=$lastIndex; $j++)
        {
            for($k=0; $k<=$lastIndex; $k++)
            {
                for($l=0; $l<=$lastIndex; $l++)
                {
                    $cnt++;
                    $pass = $letters[$i]. $letters[$j]. $letters[$k]. $letters[$l];
                    // echo "$pass<br>";

                    $sql = "SELECT * FROM members WHERE id='test' AND pass=password('$pass')";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_array($result);

                    // 찾으면 exitflag == true;
                    if($data)
                    {
                        $exitflag = true;
                        break;
                    }
                }
                if($exitflag == true)
                    break;
            }
            if($exitflag == true)
                break;
        }
        if($exitflag == true)
            break;
    }

    echo "cnt = $cnt, pass = $pass<br>";
    $now = getNow();
    echo "now = $now <br>";
?>