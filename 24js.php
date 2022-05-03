<script>
    function calcAge()
    {
        var age = Number(prompt("Insert Age"));
        age = age + 1; // number 형변환 없이 하면 입력을 문자로 받았기 때문에 31 -> 311 됨

        var currentYear = 2022;
        var birthYear = 1992;
        var age2 = currentYear - birthYear + 1;
        // alert("당신의 나이는 " + age + "살 입니다.\n\rage2 = " + age2);

        console.log("age type = " + typeof age);
        console.log("age2 type = " + typeof age2);

        // 엔터(Enter) : 줄을 하나 아래로 내리고 + 커서를 맨 앞으로 이동한다.
        // \r : carrage return 줄 하나 아래로 내리기
        // \f : 커서를 맨 앞으로 이동하기
        // \n : \r + \f

        document.querySelector("#kbinfo").innerHTML = "당신의 나이는 <span class='text-danger'>" + age + "</span> 세 입니다."; 
        // 문서에서 kbinfo라는 id를 찾아 -> 그 id 안쪽의 HTML은 이거야 (kbinfo 자리에 "당신의~" 넣어줘)
        // ****** span 쓸때는 변수자리 말고 "" 안에다가 넣어야 함!!!! ******

        var seasons = ["spring", "summer", "가을", "겨울"]; // array(배열)은 이름을 '복수형'으로
        console.log(seasons + "[1] = " + seasons[1]);

        // Dictionary, Map --> (key, value) 쌍
        // cf. JSON : Javascript Object Notation
        var kim = { firstName : "Kildong", familyName : "Kim", age : 12 };
        console.log("성씨 = " + kim['familyName']); // familyName은 key값

        var familyName = "age";
        console.log("성씨 = " + kim[familyName]); // 따옴표 안쓰면 familyName을 변수로 판단함
    }
</script>

<div class="row">
    <div class="col">
        <button type="button" class="btn btn-primary" onClick="calcAge()">나이 계산하기</button>
    </div>
</div>

<div class="row">
    <div class="col text-primary" id="kbinfo">
        
    </div>
</div>

<!--
    <<변수의 종류>>

    자바 : 기초 자료형, 참조형 자료형
    자바스크립트 JS : 기본형, 복합형
        기본형 : number, string, boolean, undefined, null
        복합형 : array, object(class,객체)

    ㅇ 숫자형 : 정수(integer), 소수(float)
    ㅇ 문자형 : 큰따옴표, 작은따옴표 허용
    ㅇ 논리형 : TRUE, FALSE
    ㅇ null : (할당된 값이) 없다.(= \0)

    ㅇ 연산자 : %(모듈러), ++, --, ... 
-->

<script>
    function calculateRate()
    {
        // var orgPrice = document.querySelector("#org").value; // id "org"를 찾아서 그 value를 가져와
        var orgPrice = Number(document.getElementById("org").value); // id는 유일하므로 getElement, name은 여러개일 수 있으므로 getElements

        console.log("orgPrice = " + orgPrice); // console을 통해 값 잘 들어왔는지 확인
        var rate = parseInt(document.querySelector("#rate").value); // parseInt : 숫자로 파싱해라 (Number()과 동일)
        console.log("rate = " + rate);

        var result = orgPrice / 100 * rate;
        document.querySelector("#result").innerHTML = "result = " + result + "입니다."
    }
</script>

<!--
    if(a === b) : =이 세개면 값 뿐만 아니라 type...까지 완전히 다 똑같은지
    if(a !== b)

    && : 둘 다 True일때만 True
    || : 둘 다 False일때만 False
    ++, <=
    연산자의 순서는 바꿀 수 없다 -> 바꾸려면 ( )를 사용해야한다.
-->

<div class="row">
    <div class="col-2">
        원금
    </div>
    <div class="col-8">
        <input type="text" name="org" id="org">
    </div>
</div>
<div class="row">
    <div class="col-2">
        이자(%)
    </div>
    <div class="col-8">
        <input type="text" name="rate" id="rate">
    </div>
    <div class="col">
        <button type="button" class="btn btn-primary" onClick="calculateRate()">계산</button>
    </div>
</div>
<div class="row">
    <div class="col text-primary" id="result">

    </div>
</div>