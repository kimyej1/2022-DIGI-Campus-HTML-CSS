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
    $sql = "SELECT * FROM cart WHERE time='$_SESSION[$sessTime]' order by idx asc"; // 내가 담은것만 가져오기
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

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
            $mSql = "SELECT * FROM models WHERE idx='$data[midx]'"; // cart에는 제품명, 사진 이런거 없어서 models에서 찾아봄
            $mResult = mysqli_query($conn, $mSql);
            $mData = mysqli_fetch_array($mResult);
            
            $sum = $data['price'] * $data['count'];

            ?>
            <div class='row'>
                <div class='col-1 colLine'><img src='./data/img/nike.jpeg' class='img-fluid'></div>
                <div class='col colLine'><span class='fw-bold'><?php echo $mData['model'];?></span></div> <!-- mData는 models에서 가져오는거 --> 
                <div class='col colLine'><?php echo $data['color'];?></div> <!-- data는 cart에서 가져오는거 --> 
                <div class='col colLine'><?php echo $data['size'];?></div>
                <div class='col colLine'><?php echo $data['price'];?></div>
                <div class='col colLine'><?php echo $data['count'];?></div>
                <div class='col colLine'><span class='fw-bold'><?php echo $sum; ?></span></div>
                <div class='col colLine'>
                    <button type="button" class='btn btn-outline-danger' onClick='deleteCart(<?php echo $data['idx'];?>)'>삭제</button>
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