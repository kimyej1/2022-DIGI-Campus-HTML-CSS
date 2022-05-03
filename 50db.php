<div class="row">
    <div class="col">
        <h5 class="text-primary">Database 연동하기</h5>
    </div>
</div>

<div class="row">
    <div class="col">
        순서
    </div>
    <div class="col">
        아이디
    </div>
    <div class="col">
        이름
    </div>
    <div class="col">
        나이
    </div>
</div>


<?php
    $sql = "select * from kbstar";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    while($data)
    {
        // 출력...
        // 연관배열, Associative Array
        // data[0], data["name"]
        ?>
        <div class="row">
            <div class="col colLine">
                <?php echo $data["idx"] ?>
            </div>
            <div class="col colLine">
                <?php echo $data["id"] ?>
            </div>
            <div class="col colLine">
                <?php echo $data["name"] ?>
            </div>
            <div class="col colLine">
                <?php echo $data["age"] ?>
            </div>
        </div>

        <?php
        $data = mysqli_fetch_array($result);
    }
?>