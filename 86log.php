최근 1시간동안 접속 페이지별 ip 갯수를 그래프로 그리고 싶습니다.<br>
top 10만 그래프로 표시하시오. (꺾은선 그래프로 클릭횟수, ip갯수)<br>
<br>
최근 1시간..<br>
SELECT ADDDATE(now(), INTERVAL -1 HOUR) AS checktime;<br>
SELECT distinct cmd FROM log_table;<br>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['페이지', 'ip', 'click'],
        <?php
            $sql = "SELECT ADDDATE(now(), INTERVAL -1 HOUR) AS graphtime";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_array($result);
            $graphtime = $data["graphtime"];
            
            $sql = "SELECT distinct cmd FROM log_table WHERE time>'$graphtime' ORDER BY cmd ASC";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_array($result);

            while($data)
            {
                $clickSql = "SELECT count(*) as sumclick, count(distinct ip) as sumip from log_table where cmd='$data[cmd]' and time>'$graphtime'";
                $clickResult = mysqli_query($conn, $clickSql);
                $clickData = mysqli_fetch_array($clickResult);
                // $ipCount = mysqli_num_rows($ipResult); -- select distinct ip...로 해서 카운트 안걸고 id만 뽑았을 때는 fetch array 대신 이렇게 결과출력!

                echo "[ '$data[cmd]', $clickData[sumip], $clickData[sumclick] ],";
                $data = mysqli_fetch_array($result);
            }
        ?>
    ]);

    var options = {
        title: '최근 1시간 접속 페이지',
        // curveType: 'function',
        legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
    }
</script>

<div class="row">
    <div class="col colLine">
        <div id="curve_chart" style="width: 1300px; height: 700px"></div>
    </div>
</div>


