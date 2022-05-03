<div class="row">
    <div class="col">
        <h5 class="text-primary">🧩 Insert</h5>
    </div>
</div>

<?php
    if(isset($_POST["major"]))
    {
        $major = $_POST["major"];
    }
    if(isset($_POST["name"]))
    {
        $name = $_POST["name"];
    }
    if(isset($_POST["age"]))
    {
        $age = $_POST["age"];
    }
    if(isset($_POST["mode"])) // 수정 버튼은 post방식
    {
        $mode = $_POST["mode"];
    }
    if(isset($_GET["mode"])) // 삭제 버튼은 get방식
    {
        $mode = $_GET["mode"];
    }
    if(isset($_POST["idx"]))
    {
        $idx = $_POST["idx"];
    }
    if(isset($_GET["idx"]))
    {
        $idx = $_GET["idx"];
    }

    if(isset($mode) and $mode == "delete")
    {
        $sql = "DELETE FROM dept WHERE idx='$idx'";
        $result = mysqli_query($conn, $sql);
        $affectedCount = mysqli_affected_rows($conn);

        if($affectedCount ==1)
            $msg = "삭제 성공";
        else
            $msg = "삭제 실패";

        echo "
        <script>
            alert('$msg');
            location.href='main.php?cmd=58insert'; 
        </script>
        "; 
    }
    if(isset($mode) and $mode == "update")
    {
        $sql = "UPDATE dept SET name = '$name', major = '$major', age = '$age' WHERE idx='$idx'";
        $result = mysqli_query($conn, $sql);
        $affectedCount = mysqli_affected_rows($conn);

        if($affectedCount ==1)
            $msg = "변경 성공";
        else
            $msg = "변경 실패";

        echo "
        <script>
            alert('$msg');
            location.href='main.php?cmd=58insert'; 
        </script>
        "; 
    }
    if(isset($mode) and $mode == "insert")
    {
        $sql = "INSERT INTO dept (name, major, age) VALUES ('$name', '$major', '$age')";
        $result = mysqli_query($conn, $sql);
        // 영향을 받은 데이터가 있는가? (예를들어 나이 1000살 이상 이름 바꿔~ 하면 문법이 맞더라도 해당하는 데이터가 없을수도..)
        $affectedCount = mysqli_affected_rows($conn);

        if($affectedCount ==1) // 인서트가 정상적으로 되었다면 1개가 영향 받았을 것(새로 생긴 1줄)
            $msg = "등록 성공";
        else
            $msg = "등록 실패";

        echo "
        <script>
            alert('$msg');
            location.href='main.php?cmd=58insert'; 
        </script>
        "; // 알럿 후 새로고침 한번 해주기(같은 값이 또 날라가서 실패(중복)처리 될까봐..)
    }
?>

<form method='post' action='main.php?cmd=58insert'>
    <input type='hidden' name='mode' value='insert'>
    <div class="row">
        <div class="col">
            <input type='text' class='form-control' name='name' id='name' placeholder='이름'>
        </div>
        <div class="col">
            <input type='text' class='form-control' name='major' placeholder='전공'>
        </div>
        <div class="col">
            <input type='text' class='form-control' name='age' placeholder='나이'>
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

<div class="row fw-bold mt-5" style='background-color:#DEDEDE'>
    <div class="col-1 colLine">순서</div>
    <div class="col colLine">이름</div>
    <div class="col colLine">전공</div>
    <div class="col colLine">나이</div>
    <div class="col colLine">비고</div>
</div>
<?php
    $sql = "SELECT count(*) AS total FROM dept ORDER BY idx ASC"; // 인덱스 오름차순으로 정렬
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    $total = $data["total"];
    echo "total = $total <br>";    
    $LPP = 3; // 한페이지에 인덱스 몇개?
    $totalPage = ceil($total / $LPP); // ceil() : 무조건 올림
    echo "totalPage = $totalPage<br>";

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

    $sql = "SELECT * FROM dept ORDER BY idx ASC LIMIT $start, $LPP"; // 인덱스 오름차순으로 정렬
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    while($data)
    {
        // 출력
        ?>
        <form method="POST" action="main.php?cmd=58insert">
            <input type='hidden' name='mode' value='update'>
            <div class="row">
                <div class="col-1 colLine"><input type='text' name='idx' value='<?php echo $data['idx']?>' readonly class='bg-white border-0'></div>
                <div class="col colLine"><input type='text' name='name' class='form-control' value='<?php echo $data['name']?>'></div>
                <div class="col colLine"><input type='text' name='major' class='form-control' value='<?php echo $data['major']?>'> </div>
                <div class="col colLine"><input type='text' name='age' class='form-control' value='<?php echo $data['age']?>'> </div>
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
?>

<div class='row'>
    <div class='col text-center'>
        <?php
        for($i=1; $i<=$totalPage; $i++)
        {
            if($i == $page)
                echo "<a href='main.php?cmd=58insert&page=$i'><span class='badge bg-dark'>$i</span></a> ";
            else
                echo "<a href='main.php?cmd=58insert&page=$i'><span class='badge' style='background-color:#AFAFAF'>$i</span></a> ";
        }
        ?>
    </div>
</div>
<script>
    function confirmDelete(pidx)
    {
        if(confirm("삭제된 데이터는 복구할 수 없습니다.\n정말 삭제하시겠습니까?"))
        {
            // get방식으로 넘어가면 주소창에 이런 형식으로 나옴
            location.href='main.php?cmd=58insert&mode=delete&idx='+pidx;
        }
    }
</script>