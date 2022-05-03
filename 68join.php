<div class="row">
    <div class="col">
        <h5 class="text-primary"><span class="material-icons icon">person_add</span> 회원가입</h5>
    </div>
</div>

<?php
    if(isset($_POST["id"]))
    {
        $id = $_POST["id"];
    }
    if(isset($_POST["name"]))
    {
        $name = $_POST["name"];
    }
    if(isset($_POST["pass"]))
    {
        $pass = $_POST["pass"];
    }
    if(isset($_POST["age"]))
    {
        $age = $_POST["age"];
    }
    if(isset($_POST["mode"]))
    {
        $mode = $_POST["mode"];
    }
    if(isset($mode) and $mode == "join")
    {
        $sql = "INSERT INTO members (id, name, pass, age, level) VALUES ('$id', '$name', password('$pass'), '$age', '1')";
        $result = mysqli_query($conn, $sql);
        // 영향을 받은 데이터가 있는가? (예를들어 나이 1000살 이상 이름 바꿔~ 하면 문법이 맞더라도 해당하는 데이터가 없을수도..)
        $affectedCount = mysqli_affected_rows($conn);

        if($affectedCount ==1) // 인서트가 정상적으로 되었다면 1개가 영향 받았을 것(새로 생긴 1줄)
            $msg = "가입 성공";
        else
            $msg = "가입 실패";

        echo "
        <script>
            alert('$msg');
            location.href='main.php?cmd=68join'; 
        </script>
        "; // 알럿 후 새로고침 한번 해주기(같은 값이 또 날라가서 실패(중복)처리 될까봐..)
    }
?>

<form method='post' action='main.php?cmd=68join'>
    <input type='hidden' name='mode' value='join'>
    <div class="row">
        <div class="col">
            <input type='text' class='form-control' name='id' id='id' onKeyUp='checkID()' placeholder='ID'>
        </div>
        <div class="col">
            <input type='text' class='form-control' name='pass' placeholder='Password'>
        </div>
        <div class="col">
            <input type='text' class='form-control' name='name' placeholder='실명'>
        </div>
        <div class="col">
            <input type='text' class='form-control' name='age' placeholder='나이'>
        </div>
        <div class="col-1">
            <button type='submit' class='form-control btn btn-primary'>가입</button>
        </div>
    </div>
    <div class="row">
        <div class="col" id="result">
            <!-- ajax 결과 여기다가 넣으려고 만듬 -->
        </div>
    </div>
</form>

<!-- 머릿말이 필요함
    순서    아이디      이름      비번      비고
-->
<div class="row fw-bold mt-5" style='background-color:#DEDEDE'>
    <div class="col-1 colLine">순서</div>
    <div class="col colLine">아이디</div>
    <div class="col colLine">이름</div>
    <div class="col colLine">나이</div>
    <div class="col-5 colLine">비밀번호</div>
    <div class="col colLine">비고</div>
</div>
<?php
    $sql = "SELECT * FROM members ORDER BY idx ASC"; // 인덱스 오름차순으로 정렬
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    while($data)
    {
        // 출력
        ?>
        <div class="row">
            <div class="col-1 colLine"><?php echo $data['idx'] ?></div>
            <div class="col colLine"><?php echo $data['id'] ?></div>
            <div class="col colLine"><?php echo $data['name'] ?> </div>
            <div class="col colLine"><?php echo $data['age'] ?> </div>
            <div class="col-5 colLine"><?php echo $data['pass'] ?></div>
            <div class="col colLine"><button class='btn btn-outline-secondary btn-sm' onClick='getUserInfo(<?php echo $data['idx']?>)'>상세보기</button></div>
        </div>
        <?php
        $data = mysqli_fetch_array($result);
    }
?>

<script>
    function getUserInfo(pidx)
    {
        let result = document.querySelector('#result');
        // let param = "idx="+pidx;

        // JSON : JavaScript Object Notation
        //          Dictionary type으로 집어넣어라
        let jsonData = {
            "idx" : pidx,
            "test" : "Hello"
        };
        $.ajax({
            url : '54ajaxUserInfo.php',
            data : jsonData,
            type : 'POST',
            // dataType : "json", // 따로 안쓰고 그냥 json 형태로 주면 알아서 처리해준다(원래 default는 text)
            cache : false, // 매번 새로 실행해
            success : function(rcvData){ // receive Data
                $('#result').html(rcvData);
            }
        })
    }

    function checkID()
    {
        let id = document.querySelector('#id').value;
        let result = document.querySelector('#result');
        // let param = 'id='+id;

        if(id.length > 0)
        {
            $.ajax({ 
                url : '54ajaxServer.php',
                data : 'id='+id,    // param이 GET방식으로 넘어갈 때 주소창에 id='' 이런 형식으로 넘어가니까..
                type : 'POST',
                cache : false,
                success : function(data){   // data는 무슨 새로운 변수라기보단, 'url에서 화면에 뿌려주는 값 전체'라고 이해하는게 좋을듯
                    //alert('..');
                    $("#result").html(data);
                }
            });
        } else
            $("#result").html(""); // 입력된거 없으면 아무 문구도 나오지 않도록!
        
    }
</script>