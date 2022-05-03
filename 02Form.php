<form method="post" action="01.html"> <!-- 여기있는 정보를 01.html로 전달해줘 -->
<!--method를 "get"으로 하면 01.html 넘어가면서 입력값이 주소창에 다 남음 → "post" 사용! -->

    아이디 <input type="text" name="id" id="myid" placeholder="회색글씨" required><br>
    비밀번호 <input type="password"><br>
    <div class="holiday">전화번호</div> <input type="tel" value="010-1234-1234"><br> <!-- "tel" 써야 폰에서 숫자키패드 호출 -->
    나이 <input type="number"><br> 
    <!--num/number 차이: number은 문자 입력 아예 안됨, 옆에 화살표로 하나 위/하나 아래 조정 가능-->
    <div class="holiday">HOME</div> <input type="url"><br>
    이메일 <input type="email"><br>
    생일 <input type="date"><br> <!-- date chooser -->
    색깔 <input type="color"><br><br> <!-- color chooser -->

    <b>SELECT</b><br> 
    <select name="area"> <!--공간을 효율적으로 사용할 수 있음!-->
        <option value="0"> == 선택 == </option>
        <option value="1" selected> 서울 </option> <!--'서울' 선택하면 '1'로 정보 날아감-->
        <option value="2"> 경기 </option> <!-- value와 일치시켜도 되고 다르게 해도되고..-->
        <option value="3"> 기타 </option>
    </select><br><br> 

    <b>RADIO</b> : 하나만 선택 <br> 
    <input type="radio" name="gender" value="1" checked> M
    <input type="radio" name="gender" value="2"> F
    <input type="radio" name="gender" value="3"> ETC <br>

    <input type="radio" name="lang" value="1"> Python
    <input type="radio" name="lang" value="2" checked> Java
    <input type="radio" name="lang" value="3"> HTML <br><br> 
    <!-- lang과 gender은 이름이 달라서 각각 한개씩 선택 가능-->

    <b>CHECKBOX</b> : 여러개 선택<br> 
    <input type="checkbox" name="baseball" checked> Baseball
    <input type="checkbox" name="running" checked disabled> Running
    <input type="checkbox" name="swimming"> Swimming <br><br>

    <b>FILE</b><br>
    <input type="file"><br><br>

    <b>TEXTAREA</b> : 멀티라인 입력 (게시판 등)<br>
    <!--html은 유연하지만 textarea에서 뭔가 짝이 안맞으면 그 뒷 태그를 다 textarea안에 넣어버림-->
    <textarea name="memo" rows="10" style="width:500px"> "value: " 이렇게 해서 값을 쓰지 않고
    "textarea /textarea" 이 사이 공간에 내용을 작성한다.
    근데 줄맞춤하려고 엔터/스페이스 쓴것까지 그대로 반영되어서
여기부터 줄바꿈 없이 써야 첫칸부터 입력된다.
그래서 textarea는 조심! 꼭 확인! </textarea>
    
    <input type="submit" value="GO!" style="width: 300px; background-color:#BBBBBB">
</form>