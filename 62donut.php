<div class="row">
    <div class="col colLine">
        <h5 class="text-primary">지역별 고객 분포</h5>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart() 
    {
        var data = google.visualization.arrayToDataTable([
            ['지역', '고객(명)'],
            <?php
                $sql = "SELECT distinct local FROM kb_customer";
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_array($result);

                while($data)
                {
                    $cntSql = "SELECT count(*) as total from kb_customer where local='$data[local]'";
                    $cntResult = mysqli_query($conn, $cntSql);
                    $cntData = mysqli_fetch_array($cntResult);

                    echo "[ '$data[local]', $cntData[total] ], ";
                    $data = mysqli_fetch_array($result);
                }
            ?>
        ]);

        var options = {
            title: '지역별 고객 분포',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
</script>

<div class="row">
    <div class="col colLine">
        <div id="donutchart" style="width: 100%; height: 700px;"></div>
    </div>
</div>