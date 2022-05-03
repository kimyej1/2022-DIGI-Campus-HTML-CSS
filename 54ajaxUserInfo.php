<?php
    include "db.php";
    $conn = connectDB();

    $idx = $_POST['idx'];
    $test = $_POST['test'];
    $sql = "SELECT * FROM members WHERE idx = '$idx'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result); // 제일 위 한줄만 가져오는 것 : fetch

    // 얘는 같은게 있어도 한개밖에 없을거니까 while문 돌 필요 없고, fetch를 여러번 할 필요도 없음(있냐/없냐가 중요)..
    if($data)
    {
        /*
            이름 누르면 그 사람 인덱스의 네이버뉴스 페이지 보여주기 (예) 1번째 이름 누르면 네이버 국민은행 뉴스의 1페이지 이동
            1 : 1, 2 : 11, 3 : 21, ... n : (n-1)*10 + 1
            https://search.naver.com/search.naver?where=news&sm=tab_jum&query=국민은행&start=
        */
        $start=($idx - 1) * 10 + 1;

        ?>
        <div class="row mt-5">
            <div class="col colLine"> <!-- Client에 정의된 Style 불러와서 쓸 수 있음 -->
                <h5 class="text-primary"><span class="material-icons icon">account_circle</span> 사용자 정보</h5>
            </div> 
        </div>
        <div class="row">
            <div class="col-2 colLine">이름</div>
            <div class="col colLine">
                <a href="https://search.naver.com/search.naver?where=news&sm=tab_jum&query=국민은행&start=<?php echo $start ?>"><?php echo $data["name"]?></a>
            </div> 
        </div>
        <div class="row">
            <div class="col-2 colLine">아이디</div>
            <div class="col colLine"><?php echo $data["id"]?></div> 
        </div>
        <div class="row">
            <div class="col-2 colLine">나이</div>
            <div class="col colLine"><?php echo $data["age"]?></div> 
        </div>
        <div class="row">
            <div class="col colLine"> 
            </div> 
        </div>
        <?php
    } else    
    {
        ?>
        <div class="alert alert-danger">
            <strong>Error : </strong><br>데이터가 삭제되었습니다.
        </div>
        <?php
    }
   
    closeDB($conn);
?>