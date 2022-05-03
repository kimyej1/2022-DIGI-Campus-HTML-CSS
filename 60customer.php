<div class="row">
    <div class="col">
        <h5 class="text-primary">💁🏻‍♀️ 고객관리</h5>
    </div>
</div>

<?php
    if(isset($_POST['keyword']))
        $keyword = $_POST['keyword'];
    else if(isset($_GET['keyword']))
        $keyword = $_GET['keyword'];
    else
        $keyword = "";
    
    if(isset($_GET['page']))
        $page = $_GET['page'];

    if(isset($_POST["gender"]))
    {
        $gender = $_POST["gender"];
    }
    if(isset($_POST["name"]))
    {
        $name = $_POST["name"];
    }
    if(isset($_POST["birth"]))
    {
        $birth = $_POST["birth"];
    }
    if(isset($_POST["mode"]))
    {
        $mode = $_POST["mode"];
    }
    if(isset($_GET["mode"]))
    {
        $mode = $_GET["mode"];
    }
    if(isset($_POST["job"]))
    {
        $job = $_POST["job"];
    }
    if(isset($_GET["idx"]))
    {
        $idx = $_GET["idx"];
    }
    if(isset($_POST["idx"]))
    {
        $idx = $_POST["idx"];
    }
    if(isset($_POST["disabled"]))
    {
        $disabled = $_POST["disabled"];
    }
    if(isset($_POST["local"]))
    {
        $local = $_POST["local"];
    }

    if(isset($mode) and $mode == "delete")
    {
        $sql = "DELETE FROM kb_customer WHERE idx='$idx'";
        $result = mysqli_query($conn, $sql);
        $affectedCount = mysqli_affected_rows($conn);

        if($affectedCount ==1)
            $msg = "삭제 성공";
        else
            $msg = "삭제 실패";

        echo "
        <script>
            alert('$msg');
            location.href='main.php?cmd=$cmd'; 
        </script>
        "; 
    }
    if(isset($mode) and $mode == "update")
    {
        $sql = "UPDATE kb_customer SET name='$name', gender='$gender', birth='$birth', job='$job', disabled='$disabled', local='$local' WHERE idx='$idx'";
        $result = mysqli_query($conn, $sql);
        $affectedCount = mysqli_affected_rows($conn);

        if($affectedCount ==1)
            $msg = "변경 성공";
        else
            $msg = "변경 실패";

        echo "
        <script>
            alert('$msg');
            location.href='main.php?cmd=$cmd&page=$page'; 
        </script>
        "; 
    }
    if(isset($mode) and $mode == "insert")
    {
        $sql = "INSERT INTO kb_customer (name, gender, birth, job, disabled, local) VALUES ('$name', '$gender', '$birth', '$job', '$disabled', '$local')";
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
?>

<form method='post' action='main.php?cmd=<?php echo"$cmd";?>'>
    <input type='hidden' name='mode' value='insert'>
    <div class="row">
        <div class="col">
            <input type='text' class='form-control' name='name' id='name' placeholder='이름'>
        </div>
        <div class="col">
            <select class="form-select form-control" name='gender'>
                <option value='1' selected>남성</option>
                <option value='2'>여성</option>
            </select>
        </div>
        <div class="col">
            <input type='date' class='form-control' name='birth' placeholder='생년월일'>
        </div>
        <div class="col">
            <input type='text' class='form-control' name='job' placeholder='직업'>
        </div>
        <div class="col">
            <select class="form-select form-control" name='disabled'>
                <option value='0' selected>비장애인</option>
                <option value='1'>장애인</option>
            </select>
        </div>
        <div class="col">
            <!-- <input type='text' class='form-control' name='local' placeholder='출생지역'> -->
            <select class="form-select form-control" name='local'>
                <option value='서울' selected>서울</option>
                <option value='경기'>경기</option>
                <option value='제주'>제주</option>
                <option value='부산'>부산</option>
                <option value='강원'>강원</option>
                <option value='충청'>충청</option>
                <option value='전라'>전라</option>
                <option value='인천'>인천</option>
                <option value='경상'>경상</option>
            </select>
        </div>
        <div class="col-1">
            <button type='submit' class='form-control btn btn-primary'>Insert</button>
        </div>
    </div>
    <div class="row">
        <div class="col" id="result">
            <!-- ajax 결과 여기다가 넣으려고 만듬 -->
        </div>
    </div>
</form>

<!-- 검색창 만들기 -->
<form method='post' action='main.php?cmd=<?php echo "$cmd";?>'>
    <div class='row mt-5'> 
        <div class="col"></div>
        <div class="col-3">
            <input type="text" class="form-control" name="keyword" value="<?php echo $keyword;?>" placeholder="검색어를 입력하세요.">
        </div>
        <div class="col-1"><button type='submit' class="btn btn-dark form-control"><span class="material-icons icon">search</span></button></div>
    </div>
</form>

<div class="row fw-bold mt-2" style='background-color:#DEDEDE'>
    <div class="col-1 colLine">순서</div>
    <div class="col colLine">이름</div>
    <div class="col-1 colLine">성별</div>
    <div class="col colLine">생년월일</div>
    <div class="col colLine">직업</div>
    <div class="col-1 colLine">장애여부</div>
    <div class="col-1 colLine">출생지역</div>
    <div class="col-3 colLine">비고</div>
</div>
<?php
    if($keyword)
    {
        $sql = "SELECT count(*) AS total FROM kb_customer WHERE name like '%$keyword%'";
    } else
    {
        $sql = "SELECT count(*) AS total FROM kb_customer";
    }

    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    $total = $data["total"];
    // echo "total = $total <br>";    
    $LPP = 10; // line per page
    $PPG = 5; // page per group
    $totalPage = ceil($total / $LPP);
    // echo "totalPage = $totalPage<br>";

    if(isset($_GET["page"])) 
        $page = $_GET["page"];

    if(!isset($page)) // 페이지 정보가 없으면 무조건 1페이지 보여줘~
        $page = 1;

    /*
        1p : idx 0 ~ 2
        2p : 3 ~ 5
        3p : 6 ~ 8
        np : (n-1)*3

        page 1~5 : group 1
        6~10 : 2
        11~15 : 3
    */
    $group = ceil($page / $PPG);
    $totalGroup = ceil($totalPage / $PPG);
    // echo "group = $group, totalGroup = $totalGroup <br>";

    $start = ($page -1) * $LPP;

    if($keyword)
    {
        $sql = "SELECT * FROM kb_customer WHERE name like '%$keyword%' ORDER BY idx ASC LIMIT $start, $LPP";
    } else
    {
        $sql = "SELECT * FROM kb_customer ORDER BY idx ASC LIMIT $start, $LPP";
    }

    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    while($data)
    {
        // 출력
        ?>
        <form method="POST" action="main.php?cmd=<?php echo"$cmd";?>&page=<?php echo $page;?>">
            <input type='hidden' name='mode' value='update'>
            <div class="row">
                <div class="col-1 colLine"><input type='text' name='idx' value='<?php echo $data['idx']?>' readonly class='bg-white border-0'></div>
                <div class="col colLine"><input type='text' name='name' class='form-control' value='<?php echo $data['name']?>'></div>
                <div class="col-1 colLine"><input type='text' name='gender' class='form-control' value='<?php echo $data['gender']?>'> </div>
                <div class="col colLine"><input type='date' name='birth' class='form-control' value='<?php echo $data['birth']?>'> </div>
                <div class="col colLine"><input type='text' name='job' class='form-control' value='<?php echo $data['job']?>'> </div>
                <div class="col-1 colLine"><input type='text' name='disabled' class='form-control' value='<?php echo $data['disabled']?>'> </div>
                <div class="col-1 colLine"><input type='text' name='local' class='form-control' value='<?php echo $data['local']?>'> </div>
                <div class="col-3 colLine">
                    <button type="submit" class="btn btn-outline-success">수정</button>
                    <button type="button" class="btn btn-outline-danger" onClick='confirmDelete(<?php echo $data['idx']?>)'>삭제</button>
                    <button type="button" class='btn btn-outline-secondary'>상세보기</button>
                </div>
            </div>
        </form>
        <?php
        $data = mysqli_fetch_array($result);
    }
?>
<div class="row">
    <div class="col colLine text-center">
        <!-- 
            1그룹 1 2 3 4 5 > >>
            2그룹 < 6 7 8 9 10 > >>
            3그룹 << < 11 12 13 14 15 > >>

            맨 마지막 그룹 << < 4996 4997 4998 4999 5000
        -->
        <ul class="pagination justify-content-center" style="margin:20px 0">
            <?php
                // 맨 앞으로..
                if($group >=3)
                {
                    echo "<li class='page-item'><a class='page-link' href='main.php?cmd=$cmd&page=1&keyword=$keyword'><span class='material-icons icon'>first_page</span></a></li>";
                }

                // 이전 그룹 가기
                if($group >=2)
                {
                    $prevPage = ($group -2 )* $PPG +1;
                    echo "<li class='page-item'><a class='page-link' href='main.php?cmd=$cmd&page=$prevPage&keyword=$keyword'><span class='material-icons icon'>chevron_left</span></a></li>";
                }
                // 11, 12, 13, 14, 15 (group -2) * 5 + 1

                for($i=($group-1)*$PPG+1; $i<=$group*$PPG; $i++)
                {
                    if($i<=$totalPage)
                    {
                        if($i==$page)
                            $activeMark="active";
                        else
                            $activeMark="";
                        echo "<li class='page-item $activeMark'><a class='page-link' href='main.php?cmd=$cmd&page=$i&keyword=$keyword'>$i</a></li>";
                    } else
                        break;
                }

                // 다음 그룹 가기
                if($group < $totalGroup)
                {
                    $nextPage = $group * $PPG + 1;
                    echo "<li class='page-item'><a class='page-link' href='main.php?cmd=$cmd&page=$nextPage&keyword=$keyword'><span class='material-icons icon'>chevron_right</span></a></li>";
                }

                // 맨 마지막으로..
                if($group < $totalGroup-1)
                {
                    $totalGroupPage = ($totalGroup-1) * $PPG + 1;
                    echo "<li class='page-item'><a class='page-link' href='main.php?cmd=$cmd&page=$totalGroupPage&keyword=$keyword'><span class='material-icons icon'>last_page</span></a></li>";
                }
            ?>
        </ul>

    </div>
</div>
<!-- <div class='row'>
    <div class='col text-center'>
        <?php
        for($i=1; $i<=$totalPage; $i++)
        {
            if($i == $page)
                echo "<a href='main.php?cmd=$cmd&page=$i'><span class='badge bg-dark'>$i</span></a> ";
            else
                echo "<a href='main.php?cmd=$cmd&page=$i'><span class='badge' style='background-color:#AFAFAF'>$i</span></a> ";
        }
        ?>
    </div>
</div> -->
<script>
    function confirmDelete(pidx)
    {
        if(confirm("삭제된 데이터는 복구할 수 없습니다.\n정말 삭제하시겠습니까?"))
        {
            // get방식으로 넘어가면 주소창에 이런 형식으로 나옴
            location.href='main.php?cmd=<?php echo"$cmd";?>&mode=delete&idx='+pidx;
        }
    }
</script>