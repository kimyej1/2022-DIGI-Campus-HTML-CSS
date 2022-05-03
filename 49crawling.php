<?php
    if(isset($_POST["url"]))
    {
        $url = $_POST["url"];
    } else{
        $url = "";
    }
    echo "url = $url <br>";

    
    // CURL : cURL : Client URL
    // wget https://kbstar.com

    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    } else
    {
        $page = 1;
    }

    $start = ($page - 1) * 10 + 1;
    // 1 : 1, 2 : 11, 3 : 21, 4 : 31, ... n : (n-1)*10 + 1

    $OPENURL = "https://search.naver.com/search.naver?where=nexearch&sm=top_hty&fbm=0&ie=utf8&query=국민은행&start=$start";
    // init
    $curl = curl_init();

    // setopt : set option
    curl_setopt($curl, CURLOPT_URL, $OPENURL); // URL 지정
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // 요청결과를 문자열로 반환
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10); // 10 넘어가면 타임아웃이라고 생각해서 회수!
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 원격 서버에 있는 인증서 유효성 검사할지 말지
    $response = curl_exec($curl);

    // Save to DB

    curl_close($curl);
    
?>
<form method='post' action='main.php?cmd=49crawling'>
    <div class='row'>
        <div class='col'>
            <input type='text' name='url' class='form-control'>
        </div>
    </div>
    <div class='row'>
        <div class='col'>
            <button type='submit' class='btn btn-primary'>크롤링</button>
        </div>
    </div>
    <div class='row'>
        <div class='col'>
            <textarea class='form-control' rows='15'>
                <?php
                    if(isset($response))
                    {
                        echo "$response";
                    }
                ?>
            </textarea>
        </div>
    </div>
</form>

<?php
    $nextPage = $page + 1;
    
    if($page >= 10)
        exit();
?>

<!-- 일정한 시간이 지나면.. Start = 1, 11, 21, 31, ... 이렇게 증가시키면서 계속 동작하게 할 수 있을까? -->
<script>
    function repeatCrawling()
    {
        setTimeout(location.href="main.php?cmd=49crawling&page=<?php echo $nextPage ?>" , 3000); // 3000ms(3초)마다 function을 실행한다.
    }
    
    repeatCrawling();
</script>