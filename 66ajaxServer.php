<?php
    include "db.php";
    $conn = connectDB();

    $f1 = $_POST['f1'];
    $f2 = $_POST['f2'];
    $f3 = $_POST['f3'];

    $sql = "INSERT INTO bank (f1, f2, f3, time) VALUES ($f1, $f2, $f3, now())";
    $result = mysqli_query($conn, $sql);

?>


<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
<script type='text/javascript'>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['시간', '1층', '2층', '3층'],
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

                $sql = 'SELECT * FROM bank order by idx asc limit $start, $limit';
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_array($result);

                while($data)
                {
                    echo "[ '$data[time]', $data[f1], $data[f2], $data[f3] ],";
                    $data = mysqli_fetch_array($result);
                }
            ?>
        ]);

        var options = {
            title: '은행 층별 인원',
            hAxis: {title: '시간',  titleTextStyle: {color: '#333'}},
            vAxis: {title: '인원(명)', titleTextStyle: {color: '#333'}}
        };

        // var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        // chart.draw(data, options);
    }
    
</script>

<?php  
    
    closeDB($conn);
?>