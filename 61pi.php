<div class="row">
    <div class="col colLine">
        <h5 class="text-primary">학과별 인원 분포</h5>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() 
        {

            var data = google.visualization.arrayToDataTable([
            ['학과', '인원(명)'],

            <?php
                    $sql = "SELECT distinct major from dept order by major asc";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_array($result);
                    while($data)
                    {
                        // 출력
                        $cntSql = "SELECT count(*) as total from dept where major='$data[major]'";
                        $cntResult = mysqli_query($conn, $cntSql);
                        $cntData = mysqli_fetch_array($cntResult);

                        echo "[ '$data[major]', $cntData[total] ], ";
                        $data = mysqli_fetch_array($result);
                    }
            ?>
            
            ]);

            var options = {
            title: '학과별 인원분포'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>


<div class="row">
    <div class="col colLine">
        <div id="piechart" style="width: 100%; height: 700px;"></div>
    </div>
</div>