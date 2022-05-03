<!--
    [ 'branch 1'의 실시간 층별 고객 수 시각화 ]
    
    1. 5초에 한번 팝업을 띄워 1층의 고객 수를 입력받는다. (처음 실행 시 고객 수는 0명이다.)
    2. DB 'bank'에 입력받은 1층과 2~3층의 고객 수 정보를 삽입한다.
        * DB 'bank'에는 지점번호와 f1~f3 층별 고객수가 포함되어있다.
        * 2층 고객 수는 1층 고객의 2/3 정도이며, 3층 고객 수는 1층 고객의 1/2 정도이다.
    3. 1~3층 고객 수는 area chart로, 총 고객 수는 line chart로 시각화한다.

    [ 개선점 ]
    1. 팝업이 떠있으면 다시 띄우지 않아야 하는데, 입력을 5초안에 하지 못하면 팝업이 계속 새로고침된다. 
    2. 처음 실행 시 1층 고객 수는 입력받지 못하고 임의로 지정해야 한다.(0명으로 지정하였음)

-->

<div class="row">
    <div class="col colLine">
        <h5 class="text-primary">은행 층별 인원</h5>
    </div>
</div>

<form method="POST" name='hiddenForm' action='main.php?cmd=<?php echo $cmd;?>'>
    <div class="row">
        <div class="col">
            <input type='hidden' class='form-control' id='f1rcv' name='f1rcv' min='0' value='50'>
        </div>
    </div>
</form>

<div>
    <div id='chart_div' style='width: 100%; height: 700px;'></div>
</div>
<script>
    
    setInterval( function(){ 
        window.open('66pop.html', 'kbWindow', 'left=200, top=50, width=500, height=200, resizable=yes');    
    } , 5 * 1000); 
</script>
<?php
    if(isset($_POST['f1rcv']))
        $f1rcv = $_POST['f1rcv'];
    else
        $f1rcv = 0; // 처음 실행 시 1층고객을 0명으로 설정;

    $f1person = $f1rcv;
    $f2person = rand(0, $f1person/3*2);
    $f3person = rand(0, $f1person/2);

    $sql = "INSERT INTO bank (branch, f1, f2, f3, time) VALUES (1, $f1person, $f2person, $f3person, now())";
    $result = mysqli_query($conn, $sql);
?>

<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
<script type='text/javascript'>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['시간', '1층', '2층', '3층', '총계'],
            <?php
                $cntSql = 'SELECT count(*) AS total FROM bank';
                $cntResult = mysqli_query($conn, $cntSql);
                $cntData = mysqli_fetch_array($cntResult);
                $bankCnt = $cntData['total'];

                $limitCnt = 10;
                $limit = $limitCnt; // $i개씩만 보여줄거야

                if($bankCnt >= $limitCnt)
                    $start = $bankCnt - $limitCnt;
                else
                    $start = 0;

                $sql = "SELECT mid(time, 12, 8) AS subTime, f1, f2, f3, f1+f2+f3 AS sum FROM bank order by idx asc limit $start, $limit";
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_array($result);

                while($data)
                {
                    echo "[ '$data[subTime]', $data[f1], $data[f2], $data[f3], $data[sum] ],";
                    $data = mysqli_fetch_array($result);
                }
            ?>
        ]);

        var options = {
            title: '은행 층별 인원',
            hAxis: {title: '시간',  titleTextStyle: {color: '#333'}},
            vAxis: {title: '인원(명)', titleTextStyle: {color: '#333'}},
            colors: ['#f36daa', 'orange', '#3fc26b', 'blue'],
            series: {3: {type: 'line'}}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

    

</script>
