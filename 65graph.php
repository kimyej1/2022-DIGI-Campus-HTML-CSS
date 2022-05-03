<div class="row">
    <div class="col colLine">
        <h5 class="text-primary">🌡 실시간 온도/습도</h5>
    </div>
</div>
<div class="row">
    <div class="col colLine">
        <div id="curve_chart" style="width: 100%; height: 700px"></div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['시간', '습도', '온도'],
            <?php
                    $cntSql = "SELECT count(*) AS total FROM iot";
                    $cntResult = mysqli_query($conn, $cntSql);
                    $cntData = mysqli_fetch_array($cntResult);
                    $iotCnt = $cntData["total"];

                    $limitCnt = 10;
                    $limit = $limitCnt; // $i개씩만 보여줄거야

                    if($iotCnt >= $limitCnt)
                        $start = $iotCnt - $limitCnt;
                    else
                        $start = 0;

                    $sql = "SELECT * from iot order by idx asc limit $start, $limit";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_array($result);

                    while($data)
                    {
                        echo "[ '$data[time]', $data[humidity], $data[temperature] ],";
                        $data = mysqli_fetch_array($result);
                    }
            ?>
        ]);

        var options = {
          title: '실시간 온도/습도',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
</script>
<!-- <script>
    setTimeout( function(){ // setTimeout( function(){} , 5000);
        location.href = 'main.php?cmd=<?php echo $cmd; ?>' 
    } , 3 * 1000); 

</script> -->