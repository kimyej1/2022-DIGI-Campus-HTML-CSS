<div class="row">
    <div class="col colLine">
        <h5 class="text-primary">온도, 습도 생성기</h5>
    </div>
</div>

<?php
    $tempRand = rand(200, 600)/10; 
    $humRand = rand(400, 700)/10;
    // rand : random
    // 소수점 한자리까지 만들려고 /10 했음!

    $sql = "INSERT INTO iot (branch, temperature, humidity, time) VALUES (1, $tempRand, $humRand, now())";
    $result = mysqli_query($conn, $sql);
?>

<div class="row">
    <div class="col colLine">
        tempRand = <?php echo $tempRand; ?><br>
        humRand = <?php echo $humRand; ?>
    </div>
</div>

<script>
    setTimeout( function(){ // setTimeout( function(){} , 5000);
        location.href = 'main.php?cmd=<?php echo $cmd; ?>' // 계속 새로고침되는게 싫으면 ajax를 이용하면 됨(→ 화면은 가만히 있고 내부적으로만 작동)
    } , 3 * 1000); 

</script>