JS 연습<br>
ID 입력 안했을 때 에러처리하기

<script> // script : 자바스크립트 영역이다~

    alert("Javascript Alert");  // 알럿은 확인
    confirm("Javascript Confirm"); // 컨펌은 취소/확인
    prompt("Javascript Prompt"); // 프롬프트는 입력을 받음 + 취소/확인

    var name=prompt("Name : ");
    alert("HI," + name); // 프롬프트에서 입력받은 이름 넣어서 알럿 띄워주기

// 브라우저 내에서 자체적으로 검사를 먼저 하고, 통과 하면 서버에 보내라(그 코드를 서버가 만들어서 줬음 : "이거 안되면 보내지도 마!")
    function checkError()
    {
        var f = document.loginForm; // var : 변수 정의

        if(f.id.value == "")
        {
            alert("아이디를 입력하세요 1");
            f.id.focus(); // 알럿 띄운 후 아이디창에 포커싱
            return false;
        }

        // 이렇게 변수 사용 없이 하면 코드가 길어짐..
        if(document.loginForm.id.value == "")
        {
            alert("아이디를 입력하세요 2");
            document.loginForm.id.focus();
            return false;
        }
    }
</script>

<form name="loginForm" method="post" onSubmit="return checkError()" action="test.php">
    <!-- 클릭하면 반응 : onClick, 서브밋할때 반응 : onSubmit -->
    <input type="text" name="id">
    <button type="submit" class="btn btn-primary">Login</button>
</form>