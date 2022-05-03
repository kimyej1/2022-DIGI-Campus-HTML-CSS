<div class="row">
    <div class="col">
        <h5 class="text-primary"><span class="material-icons icon">person_add</span> 모델 관리</h5>
    </div>
</div>

<?php
    if(isset($_POST["model"]))
    {
        $model = $_POST["model"];
    }
    if(isset($_POST["size"]))
    {
        $size = $_POST["size"];
    }
    if(isset($_POST["color"]))
    {
        $color = $_POST["color"];
    }
    if(isset($_POST["price"]))
    {
        $price = $_POST["price"];
        $price = str_replace(",", "", $price); // price에 ','가 있으면 빈값으로 바꿔서 다시 price에 넣어(고객이 ',' 입력해도 무시)
    }
    if(isset($_POST["mode"]))
    {
        $mode = $_POST["mode"];
    }
    
    if(isset($mode) and $mode == "insert")
    {
        $sql = "INSERT INTO models (model, size, color, price) VALUES ('$model', '$size', '$color', '$price')";
        $result = mysqli_query($conn, $sql);
        $affectedCount = mysqli_affected_rows($conn);

        if($affectedCount ==1) 
            $msg = "등록 성공";
        else
            $msg = "등록 실패";

        echo "
        <script>
            alert('$msg');
            location.href='main.php?cmd=$cmd'; 
        </script>
        "; 
    }
    if(isset($mode) and $mode == "update")
    {
        if(isset($_POST['idx']))
        {
            $idx = $_POST['idx'];
        }
        $sql = "UPDATE models SET model='$model', size='$size', color='$color', price='$price' WHERE idx='$idx'";
        $result = mysqli_query($conn, $sql);
        $affectedCount = mysqli_affected_rows($conn);

        if($affectedCount ==1) 
            $msg = "수정 성공";
        else
            $msg = "수정 실패";

        echo "
        <script>
            alert('$msg');
            location.href='main.php?cmd=$cmd'; 
        </script>
        "; 
    }
?>

<form method='post' action='main.php?cmd=<?php echo $cmd; ?>'>
    <input type='hidden' name='mode' value='insert'>
    <div class="row">
        <div class="col">
            <input type='text' class='form-control' name='model' placeholder='모델명'>
        </div>
        <div class="col">
            <input type='text' class='form-control' name='size' placeholder='사이즈(,로 나열)'>
        </div>
        <div class="col">
            <input type='text' class='form-control' name='color' placeholder='색상(,로 나열)'>
        </div>
        <div class="col">
            <input type='text' class='form-control' name='price' placeholder='제품가격'>
        </div>
        <div class="col-1">
            <button type='submit' class='form-control btn btn-primary'>등록</button>
        </div>
    </div>
</form>

<!-- 머릿말이 필요함
    순서    모델명      사이즈      색상      제품가격      비고
-->
<div class="row fw-bold mt-5" style='background-color:#DEDEDE'>
    <div class="col-1 colLine">순서</div>
    <div class="col colLine">모델명</div>
    <div class="col colLine">사이즈</div>
    <div class="col colLine">색상</div>
    <div class="col colLine">제품가격</div>
    <div class="col colLine">비고</div>
</div>
<?php
    $sql = "SELECT * FROM models ORDER BY idx ASC"; // 인덱스 오름차순으로 정렬
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    while($data)
    {
        // 출력
        ?>
        <form method='post' action='main.php?cmd=<?php echo $cmd; ?>'>
            <input type='hidden' name='idx' value="<?php echo $data['idx'] ?>">
            <input type='hidden' name='mode' value="update">
            <div class="row">
                <div class="col-1 colLine"><?php echo $data['idx'] ?></div>
                <div class="col colLine"><input type='text' name='model' class='form-control' value="<?php echo $data['model'] ?>"></div>
                <div class="col colLine"><input type='text' name='size' class='form-control' value="<?php echo $data['size'] ?>"> </div>
                <div class="col colLine"><input type='text' name='color' class='form-control' value="<?php echo $data['color'] ?>"> </div>
                <div class="col colLine"><input type='text' name='price' class='form-control' value="<?php echo $data['price'] ?>"></div>
                <div class="col colLine">
                    <button type='submit' class='btn btn-outline-secondary btn-sm'>수정하기</button>
                </div>
            </div>
        </form>
        <?php
        $data = mysqli_fetch_array($result);
    }
?>