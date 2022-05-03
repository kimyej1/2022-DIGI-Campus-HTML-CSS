<!--include해서 쓸거라서 body 윗쪽 불필요 -->

1. HTML은 enter를 무시한다.<br> <!--br은 흔치 않은 단독태그-->
2. space bar는 1개만 인정한다.        이렇게 해도 의미없다.
    a &nbsp; &nbsp; &nbsp; b <br><br> <!--스페이스 여러개 하려면 &nbsp; 사용-->

    A. 글씨 관련 태그 <br> <!-- 태그는 대소문자를 구분하지 않는다. -->
<h1> h1 </h1><br> <!-- h : head 머릿글 -->
<h2> h2 </h2><br>
<h6> h6 </h6><br>
<h7> h7 </h7><br><br>

두껍게 Bold <b> BOLD </b> &nbsp;&nbsp;&nbsp; Strong <strong> STRONG </strong> <br>
기울기 Italic <i> ITALIC </i> &nbsp;&nbsp;&nbsp; Underline <u> UNDERLINE </u><br><br>

동해물과 <b>백두산</b>이 <i>마르고</i> 닳도록<br>
<b><u>하나님</u></b>이 보우하사 <b><i>우리나라</i></b> 만세.<br><br>

<font color = "red"> 빨강 </font><br>
<font color = "#FF0000"> 빨강 </font><br>
<font color = #FF0000> 빨강 </font><br>
<font color = "#00FF00"><h3> H3 Green </h3></font><br><br>

<p> <!-- P : Paragraph -->
    동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록
    동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록
    동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록
    동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록
    동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록
</p>
<p> <!-- 문단 단위 자동으로 띄어써줌 -->
    동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록
    동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록
    동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록
    동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록
    동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록동해물과 백두산이 마르고 닳도록
</p>

<hr>
<h3>list</h3>

<ul> <!-- UL : Unordered list 순서가 없는 리스트 -->
    <li> first </li>
    <li> second </li>
    <li> third </li>
</ul>

<ol> <!-- OL : Ordered list 순서가 있는 리스트 -->
    <li> first </li>
    <li> second </li>
    <li> third </li>
</ol>

B. 이미지, 링크 태그 <br> source <br>
<img src = "./data/img/images.jpg"><br><br> <!-- image source, "./"는 "현재 디렉토리" -->
<img src = "./data/img/images.jpg" width = "100", height = "80"><br><br> <!-- w/h중 하나만 쓰면 비율 살아있음 -->
<img src = "./data/img/images.jpg" alt = '이미지테스트' title = '이미지 타이틀'><br><br>
<!--alt : 이미지 불러오기 실패했을때, 또는 시각장애인(웹접근성)이 들을 수 있는 이미지 설명
    title : 이미지에 마우스오버 했을 때 툴팁으로 뜨는 이미지 제목 -->

<a href = "https://kbstar.com" target = "_blank"> KB* </a> <br><br>
<!--href : hyper reference, target = _blank : 새로운 빈 창에다가 띄워줘 
    target 빼고 쓰면 그 창을 덮어써서 링크로 이동함-->

C. 테이블(Table) 관련 태그 <br>
<table border = "1">
    <tr> <!-- TR : table row 테이블의 가로 한줄 만듬 -->
        <td rowspan = "2" width = "100" bgcolor="#ABCEDF"> 1 </td> <!-- rowspan : 행 합치기 -->
        <td width = "300"> 2 </td>
        <td width = "200"> 3 </td>
    </tr>

    <tr>
        <td colspan = "2" bgcolor=#ABFCAB> 22 </td>
        <!-- colspan : 열 합치기 -->
    </tr>

    <tr height = "100">
        <td> 111 </td>
        <td> 222 </td>
        <td> 333 </td>
    </tr>
</table>
