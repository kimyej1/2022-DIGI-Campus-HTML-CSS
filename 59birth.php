<div class="row">
    <div class="col">
        <h5 class="text-primary">🎂 Birthday</h5>
    </div>
</div>

<?php
    if(isset($_POST["idx"]))
    {
        $idx = $_POST["idx"];
    }
    if(isset($_POST["name"]))
    {
        $name = $_POST["name"];
    }
    if(isset($_POST["birth"]))
    {
        $birth = $_POST["birth"];
    }
    if(isset($_POST["city"]))
    {
        $city = $_POST["city"];
    }
    if(isset($_POST["mode"]))
    {
        $mode = $_POST["mode"];
    }
    $flag = 1;
    
    if(isset($mode) and $mode == "delete")
    {
        $sql = "DELETE FROM birth_table WHERE idx='$idx'";
        $result = mysqli_query($conn, $sql);
        $affectedCount = mysqli_affected_rows($conn);

        if($affectedCount ==1)
            $msg = "삭제 성공";
        else
            $msg = "삭제 실패";

        echo "
        <script>
            alert('$msg');
            location.href='main.php?cmd=59birth'; 
        </script>
        "; 
    }
    if(isset($mode) and $mode == "update")
    {
        $sql = "UPDATE birth_table SET name = '$name', birth = '$birth', city = '$city' WHERE idx='$idx'";
        $result = mysqli_query($conn, $sql);
        $affectedCount = mysqli_affected_rows($conn);

        if($affectedCount ==1)
            $msg = "변경 성공";
        else
            $msg = "변경 실패";

        echo "
        <script>
            alert('$msg');
            location.href='main.php?cmd=59birth'; 
        </script>
        "; 
    }
    if(isset($mode) and $mode == "insert")
    {
        $sql = "INSERT INTO birth_table (name, birth, city) VALUES ('$name', '$birth', '$city')";
        $result = mysqli_query($conn, $sql);
        $affectedCount = mysqli_affected_rows($conn);

        if($affectedCount ==1)
            $msg = "등록 성공";
        else
            $msg = "등록 실패";

        echo "
        <script>
            alert('$msg');
            location.href='main.php?cmd=59birth'; 
        </script>
        ";
    }
?>

<form method='post' action='main.php?cmd=59birth'>
    <input type='hidden' name='mode' value='insert'>
    <div class="row">
        <div class="col">
            <input type='text' class='form-control' name='name' id='name' placeholder='이름'>
        </div>
        <div class="col">
            <input type='date' class='form-control' name='birth' placeholder='생일'>
        </div>
        <div class="col">
            <!-- <input type='text' class='form-control' name='city' placeholder='출생지역'> -->
            <select class="form-select form-control" name='city'>
                <option value='서울'>서울</option>
                <option value='경기' selected>경기</option>
                <option value='제주'>제주</option>
                <option value='기타'>기타</option>
            </select>
        </div>
        <div class="col-1">
            <button type='submit' class='form-control btn btn-primary'>Insert</button>
        </div>
    </div>
</form>
<div class='row mt-5'>
    <div class='col'></div>
    <div class='col-1'>
        <button type='button' id='displayAll' class='btn btn-outline-secondary form-control' onClick='displayAll()'>전체보기</button>
    </div>
    <div class='col-1'>
        <button type='button' id='displayPage' class='btn btn-outline-secondary form-control' onClick='displayPage()'>페이지</button>
    </div>
</div>

<!-- ?????????????????????????
    자바스크립트는 이미 다 데이터가 넘어와있는 상태에서만 가능 → AJAX로 하면 될거다!-->
<script>
    function displayAll()
    {
        <?php echo "$flag = 0";?>
    }
    function displayPage()
    {
        <?php echo "$flag = 1";?>
    }
</script>

<div class="row fw-bold mt-3" style='background-color:#DEDEDE'>
    <div class="col-1 colLine">순서</div>
    <div class="col colLine">이름</div>
    <div class="col colLine">생일</div>
    <div class="col colLine">출생지역</div>
    <div class="col colLine">비고</div>
</div>

<?php
    if($flag==0)
    {
        echo "flag0";

        $sql = "SELECT * FROM birth_table ORDER BY idx ASC"; // 인덱스 오름차순으로 정렬
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);

    } else if($flag==1)
    {
        echo "flag1";

        $sql = "SELECT count(*) AS total FROM birth_table ORDER BY idx ASC"; // 인덱스 오름차순으로 정렬
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);

        $total = $data["total"]; 
        $LPP = 4; // 한페이지에 인덱스 몇개?
        $totalPage = ceil($total / $LPP); // ceil() : 무조건 올림

        if(isset($_GET["page"])) // main.php?cmd=58insert : 1페이지 보여줘, main.php?cmd=58insert&page=3 : 3페이지 보여줘
            $page = $_GET["page"];

        if(!isset($page)) // 페이지 정보가 없으면 무조건 1페이지 보여줘~
            $page = 1;

        /*
            1p : idx 0 ~ 2
            2p : 3 ~ 5
            3p : 6 ~ 8
            np : (n-1)*3
        */

        $start = ($page -1) * $LPP;

        $sql = "SELECT * FROM birth_table ORDER BY idx ASC LIMIT $start, $LPP"; // 인덱스 오름차순으로 정렬
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);
    } else
    {
        echo "flag error";
    }

    while($data)
    {
        // 출력
        ?>
        <form method="POST" action="main.php?cmd=59birth">
            <input type='hidden' name='mode' value='update'>
            <div class="row">
                <div class="col-1 colLine"><input type='text' name='idx' value='<?php echo $data['idx']?>' readonly class='bg-white border-0'></div>
                <div class="col colLine"><input type='text' name='name' class='form-control' value='<?php echo $data['name']?>'></div>
                <div class="col colLine"><input type='text' name='birth' class='form-control' value='<?php echo $data['birth']?>'> </div>
                <div class="col colLine"><input type='text' name='city' class='form-control' value='<?php echo $data['city']?>'> </div>
                <div class="col colLine">
                    <button type="submit" class="btn btn-outline-success">수정</button>
                    <button type="button" class="btn btn-outline-danger" onClick='confirmDelete(<?php echo $data['idx']?>)'>삭제</button>
                    <button type="button" class='btn btn-outline-secondary'>상세보기</button>
                </div>
            </div>
        </form>
        <?php
        $data = mysqli_fetch_array($result);
    }

    if($flag==1)
    {
        ?>
        <div class='row'>
            <div class='col text-center'>
                <ul class="pagination justify-content-center" style="margin:20px 0">
                    <li class='page-item'><a class='page-link' href='main.php?cmd=59birth&page=<?php $intPrev = (int)$page-1; if($intPrev>0){echo "$intPrev";}else{echo"$page";} ?>'>Previous</a></li>
                    <?php
                        for($i=1; $i<=$totalPage; $i++)
                        {
                            if($i == $page)
                                $activeMark="active";
                             else
                                $activeMark="";
                            echo "<li class='page-item $activeMark'><a class='page-link' href='main.php?cmd=59birth&page=$i'>$i</a></li>";
                        }
                    ?>
                    <li class='page-item'><a class='page-link' href='main.php?cmd=59birth&page=<?php $intNext = (int)$page+1; if($intNext<=$totalPage){echo "$intNext";}else{echo"$page";} ?>'>Next</a></li>
                </ul>
            </div>
        </div>
        <?php
    } 
        ?>
<script>
    function confirmDelete(pidx)
    {
        if(confirm("삭제된 데이터는 복구할 수 없습니다.\n정말 삭제하시겠습니까?"))
        {
            // get방식으로 넘어가면 주소창에 이런 형식으로 나옴
            location.href='main.php?cmd=59birth&mode=delete&idx='+pidx;
        }
    }
</script>