<div class="row">
    <div class="col colLine">
        <h5 class="text-primary">은행 층별 인원</h5>
    </div>
</div>

<?php
    // $f1person = rand(0, 100); // 0 ~ 100명
    // $f2person = rand(0, 66);
    // $f3person = rand(0, 50);

    // $sql = "INSERT INTO bank (branch, f1, f2, f3, time) VALUES (1, $f1person, $f2person, $f3person, now())";
    // $result = mysqli_query($conn, $sql);
?>

<div class="row">
    <div class="col colLine" id="chart">
        <div id='chart_div' style='width: 100%; height: 700px;'>aaa</div>
    </div>
</div>


<script>
    setInterval( function(){
        var f1person = Math.ceil((Math.random() * 100) + 1);
        var f2person = Math.ceil((Math.random() * 66) + 1);
        var f3person = Math.ceil((Math.random() * 50) + 1);
        console.log(f1person, f2person, f3person);


        $.ajax({
            url: "66ajaxServer.php",
            type: "POST",
            cache: false,
            data: {
                f1 : f1person,
                f2 : f2person,
                f3 : f3person
            },
            success: function(rsvData) {
                alert(rsvData);
                $('#chart_div').html(rsvData);
                var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        })
    } , 5 * 1000); 

</script>
