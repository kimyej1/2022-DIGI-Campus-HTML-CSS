<div class="row">
    <div class="col colLine">
        <h5 class="text-primary">지역별 인원/평균나이</h5>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
        // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
            ['지역', '인원(명)', '평균나이'],
                <?php
                    $sql = "SELECT distinct local FROM kb_customer ORDER BY local ASC";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_array($result);

                    while($data)
                    {
                        $cntSql = "SELECT count(*) as total from kb_customer where local='$data[local]'";
                        $cntResult = mysqli_query($conn, $cntSql);
                        $cntData = mysqli_fetch_array($cntResult);

                        $ageSql = "SELECT round(avg(left(now(),4) - left(birth,4)),2) AS avrAge FROM kb_customer WHERE local='$data[local]'";
                        $ageResult = mysqli_query($conn, $ageSql);
                        $ageData = mysqli_fetch_array($ageResult);

                        echo "[ '$data[local]', $cntData[total], $ageData[avrAge] ],";
                        $data = mysqli_fetch_array($result);
                    }
                ?>
            ]);
            // <?php
            //     $minSql = "SELECT (left(now(),4) - left(birth,4)) AS minAge FROM kb_customer WHERE local='$data[local]' ORDER BY minAge asc LIMIT 1";
            //     $maxSql = "SELECT (left(now(),4) - left(birth,4)) AS maxAge FROM kb_customer WHERE local='$data[local]' ORDER BY maxAge desc LIMIT 1";
            //     $minResult = mysqli_query($conn, $minSql);
            //     $minData = mysqli_fetch_array($minResult);
            //     $maxResult = mysqli_query($conn, $maxSql);
            //     $maxData = mysqli_fetch_array($maxResult);
            // ?>
            
            var options = {
                title : '지역별 인원/평균나이',
                vAxes: [{
                title: '인원'
                // minValue: 3000,
                // maxValue: 16000
                }, {
                title: '평균나이'
                // minValue: 46.75,
                // maxValue: 47.25
                }],
                hAxis: {title: '지역'},
                seriesType: 'bars',
                series: {
                    0: {
                        type: "bars",
                        targetAxisIndex: 0,
                        color: "skyblue"
                    },
                    1: {
                        type: "line",
                        targetAxisIndex: 1,
                        color: "purple"
                    }
                }
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>

<div class="row">
    <div class="col colLine">
    <div id="chart_div" style="width: 100%; height: 700px;"></div>
    </div>
</div>