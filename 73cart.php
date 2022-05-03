<?php
    if(isset($_GET['mode']))
    {
        $mode = $_GET['mode'];
        $idx = $_GET['idx'];

        if($mode == 'delete')
        {
            $sql = "DELETE FROM cart WHERE idx='$idx' and time='$_SESSION[$sessTime]'"; // 주소창에 idx 넣으면서 남의꺼 지울수도 있으니까 세션까지 확인!!
            $result = mysqli_query($conn, $sql);
            echo "
            <script>
                location.href='main.php?cmd=$cmd';
            </script>
            ";
        }
    }
?>

<div class="row">
    <div class="col">
        <h5 class="text-primary"><span class="material-icons icon">shopping_bag</span> 장바구니</h5>
    </div>
</div>

<?php
    /*
        쿼리를 두번 만들지 않고..(cart, models) 하나로 하는 법!
        
        <필요한 것>
        cart : idx, color, size, count
        models : model, photo, price

        <둘을 묶어줄 수 있는 것>
        cart : midx = models : idx
     */

    $ip = $_SERVER["REMOTE_ADDR"];
    $time = $_SESSION[$sessTime];
    echo "ip = $ip <br>";
    echo "sessTime = $_SESSION[$sessTime] <br>";

    $sql = "SELECT 
                a.idx as cidx, a.color as ccolor, a.size as csize, a.count as ccount, a.time as ctime, a.ip as cip,
                b.model as mmodel, b.price as mprice, b.color as mcolor
            FROM cart a, models b
            WHERE a.midx = b.idx
            AND a.time = '$time'
            AND a.ip = '$ip' ";

    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    ?>
    <div class="alert alert-success">
        <strong>[ Query ] </strong><br> <?php echo $sql; ?>
    </div>
    <?php
    if($data)
    {
        ?>
        <script>
            function deleteCart(pidx) // pidx : param으로 넘어온 idx
            {
                location.href='main.php?cmd=<?php echo $cmd;?>&mode=delete&idx='+pidx;
            }
        </script>

        <div class="row fw-bold mt-5" style='background-color:#DEDEDE'>
            <div class='col-1 colLine'>순서</div>
            <div class='col colLine'>제품명</div>
            <div class='col colLine'>색상</div>
            <div class='col colLine'>사이즈</div>
            <div class='col colLine'>가격</div>
            <div class='col colLine'>수량</div>
            <div class='col colLine'>합계</div>
            <div class='col colLine'>비고</div>
        </div>
        <?php

        while($data)
        {
            $sum = $data['mprice'] * $data['ccount'];

            ?>
            <div class='row'>
                <div class='col-1 colLine'><img src='./data/img/nike.jpeg' class='img-fluid'></div>
                <div class='col colLine'><span class='fw-bold'><?php echo $data['mmodel'];?></span></div> 
                <div class='col colLine'><?php echo $data['ccolor'];?></div> 
                <div class='col colLine'><?php echo $data['csize'];?></div>
                <div class='col colLine'><?php echo $data['mprice'];?></div>
                <div class='col colLine'><?php echo $data['ccount'];?></div>
                <div class='col colLine'><span class='fw-bold'><?php echo $sum; ?></span></div>
                <div class='col colLine'>
                    <button type="button" class='btn btn-outline-danger' onClick='deleteCart(<?php echo $data['cidx'];?>)'>삭제</button>
                </div>
            </div>
            <?php
            $data=mysqli_fetch_array($result);
        }
    } else
    {
        echo "장바구니가 비어있습니다.";
    }
?>