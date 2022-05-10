<script>
    function checkCookieMd5()
    {
        // saveid, savepass 체크되어있는지 확인 -> 체크되어있으면 kbstarid, kbstarpass 어딘가에 저장해두기
        let kbstarid = $("#kbstarid").val();
        // let kbstarid2 = document.querySelector("#kbstarid").value();
        // let kbstarid3 = document.getElementById('kbstarid').value();    // 세개 다 똑같은거

        let kbstarpass = $('#kbstarpass').val();
        let saveid = $("#saveid").is(':checked');
        let savepass = $("#savepass").is(':checked');

        if(saveid == true)
        {
            setCookie('kbstarid', kbstarid, 31);    // 유효기간 31일
        } else
        {
            setCookie('kbstarid', kbstarid, 0);     // 유효기간 0일 -> 바로 삭제 (+ 두번째 param은 빈값으로 해도됨)
        }

        if(savepass == true)
        {
            alert("비밀번호를 저장하고 있습니다.\n개인 PC가 아닌 경우 반드시 확인하세요!")
            setCookie('kbstarpass', kbstarpass, 31);
        } else
        {
            setCookie('kbstarpass', kbstarpass, 0);
        }

        let md5pass = kbmd5(kbstarpass);    // kbmd5() : main에서 암호화해주는 함수 만듬
        $("#kbstarpass").val("");           // submit 전에 kbstarpass는 비워놓고, kbstarpassmd5 값을 암호화해서 날릴거임
        $("#kbstarpassmd5").val(md5pass);

        // return false;   // return false : 여기서 멈춤, 다음 진행 안함
    }

    function setCookie(cookieName, value, expireDay)
    {
        let todayDate = new Date();
        todayDate.setDate(todayDate.getDate() + expireDay);

        let key = CryptoJS.enc.Utf8.parse(value);
        let base64 = CryptoJS.enc.Base64.stringify(key);

        document.cookie = cookieName + '=' + base64 + ';path=/; expires=' + todayDate.toGMTString() + ";";  // path=/ : 현재 디렉토리에서만 사용
    }

    function setCookieIfSaved()
    {
        // kbstarid, kbstarpass 저장된 것이 있으면, 가져와서 값 셋팅해주기
        if(getCookie('kbstarid'))
        {
            var thisId = getCookie('kbstarid');
            // alert(thisId);  // 암호화된 id

            var decrypto = CryptoJS.enc.Base64.parse(thisId);
            $("#kbstarid").val(decrypto.toString(CryptoJS.enc.Utf8));   // 저장된 id 복호화해서 id 란에 넣어주기
            $("#saveid").prop("checked", true);                         // 그리고 id저장 체크박스에 체크된 상태로 만들기
        }

        if(getCookie('kbstarpass'))
        {
            var thisPass = getCookie('kbstarpass');

            var decrypto = CryptoJS.enc.Base64.parse(thisPass);
            $("#kbstarpass").val(decrypto.toString(CryptoJS.enc.Utf8));
            $("#savepass").prop("checked", true);                       // 여기까지 하고 저장된거 불러올때 '페이지 소스보기'에서 안보이는지도 확인!
        }
    }

    function getCookie(cookieName)
    {
        let cookie = cookieName + '=';
        if(document.cookie.length > 0) // 저장된 쿠키가 있으면,
        {
            var offset = document.cookie.indexOf(cookie);

            if(offset != -1) // -1 : end of file => 파일이 아직 안끝났으면,
            {
                offset += cookie.length;
                end = document.cookie.indexOf(';', offset);

                if(end == -1)
                {
                    end = document.cookie.length;
                }

                var returnValue = unescape(document.cookie.substring(offset, end));
                return returnValue;
            }
        }
    }
</script>

<?php
    if(isset($_GET["mode"]) and $_GET["mode"] == "login")
    {
        $myid = $_POST["kbstarid"];
        $mypass = $_POST["kbstarpass"];
        $mypass2 = $_POST["kbstarpassmd5"];     // 암호화된 비밀번호
        
        echo "id = $myid, pass = $mypass, pass2 = $mypass2<br>";
    }
    /*
        create table member2(
            idx     int(10) auto_increment,
            id      char(20) unique,
            pass    char(255),
            name    char(20),
            level   int(3) default '1',

            primary key(idx)
        )

        insert into member2 (id, pass, name, level) 
            values ('admin', 'b59c67bf196a4758191e42f76670ceba', '관리자', '9');

        insert into member2 (id, pass, name, level) 
            values ('test', 'b59c67bf196a4758191e42f76670ceba', '테스터', '1');  
    */
?>

<div class="row">
    <div class="col">Cookie</div>
</div>
<!-- 90xss에서 button, onClick => submit, onSubmit 으로 바꿈 -->
<form method="post" action="main.php?cmd=<?php echo $cmd;?>&mode=login" onSubmit="return checkCookieMd5()">
    <div class="row">
        <div class="col-2">
            <input type="text" name="kbstarid" id="kbstarid" class="form-control"> 
            <!-- id/pw 미리 셋팅해줄 때 'value=' 해서 넣으면, 페이지 소스보기 했을때 다 보임 => 페이지 로딩 끝나고 스크립트로 처리해줘야함! (setCookieIfSaved())--> 
        </div>
        <div class="col-2">
            <!-- submit 전에 kbstarpass는 비워놓고, kbstarpassmd5로 옮긴담에 옮긴 값을 암호화해서 날릴거임 -->
            <input type="password" name="kbstarpass" id="kbstarpass" class="form-control"> 
            <input type="hidden" name="kbstarpassmd5" id="kbstarpassmd5" class="form-control"> <!-- hidden -> text로 바꿔보면 암호화되어서 들어가는거 볼 수 있음 -->
        </div>
        <div class="col-2">
            <input type="checkbox" name="saveid" id="saveid"> ID 저장
        </div>
        <div class="col-2">
            <input type="checkbox" name="savepass" id="savepass"> PW 저장
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary">로그인</button>
        </div>
    </div>
</form>

<script>
    setCookieIfSaved();
</script>

<?php
    if(isset($_GET["mode"]) and $_GET["mode"] == "insert")
    {
        $title = $_POST["title"];
        $content = $_POST["content"];

        /*
            CREATE TABLE bbs (
                idx     int(10) auto_increment,
                title   char(100),
                content text,               -- text로 하면 기본 4,000자

                primary key(idx)
            )
        */

        $sql = "INSERT INTO bbs (title, content) VALUES ('$title', '$content')";    
        // $title, $content에 ', "가 들어가면 어떻게 동작하는지 확인! ==> ********** 크로스사이트 스크립팅 **********
        $result = mysqli_query($conn, $sql);

        // xmp : 태그소스를 그대로 출력
        echo "<xmp>$sql</xmp>   
            <script>
                alert('글 등록 완료');
                location.href='main.php?cmd=$cmd';
            </script>
        ";
    }
?>

<div class="row">
    <div class="col">
        XSS 테스트 게시판
    </div>
</div>

<form method="post" action="main.php?cmd=<?php echo $cmd;?>&mode=insert">
    <div class="row">
        <div class="col-2">
            제목
        </div>
        <div class="col">
            <input type="text" class="form-control" name="title">
        </div>
    </div>

    <div class="row">
        <div class="col-2">
            내용
        </div>
        <div class="col">
            <textarea class="form-control" name="content" rows="5"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary">등록</button>
        </div>
    </div>
</form>

<div class="row">
    <table class="table">
        <tr>
            <td>순서</td>
            <td>제목</td>
            <td>내용</td>
        </tr>

        <?php
            $sql = "SELECT * FROM bbs ORDER BY idx DESC";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_array($result);

            while($data)
            {
                ?>
                    <tr>
                        <td><?php echo $data["idx"];?></td>
                        <td><?php echo $data["title"];?></td>
                        <td><?php echo $data["content"];?></td>
                    </tr>
                <?php
                $data = mysqli_fetch_array($result);
            }
        ?>
        
    </table>
</div>
