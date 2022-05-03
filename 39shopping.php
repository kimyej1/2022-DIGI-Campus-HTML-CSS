<div class="row mt-5 border">
    <div class="col-4 m-5">
        <div class="row">
            <img src="data/img/ham1.jpeg" id='img' class="img-fluid">
        </div>
        <div class="row">
            <div class="col"> <img src="data/img/ham1.jpeg" class="img-thumbnail" onMouseOver="changeImg(this)"> </div>
            <div class="col"> <img src="data/img/ham2.jpeg" class="img-thumbnail" onMouseOver="changeImg(this)"> </div>
            <div class="col"> <img src="data/img/ham3.jpeg" class="img-thumbnail" onMouseOver="changeImg(this)"> </div>
        </div>
    </div>
    <div class="col m-5">
        <div class="row fw-bold pb-3">
            <div class="col"><h4>제품 상세 정보</h4></div>
            <div class="col-2" id="bag"><span class="material-icons icon">shopping_bag</span></div>
        </div>
        <div class="row">
            <div class="col-3 colLine fw-bold">제품명</div>
            <div class="col colLine fw-bold">
                천하장사 오리지널 <span class="badge bg-danger rounded-pill">new</span>
            </div>
        </div>
        <div class="row">
            <div class="col-3 colLine fw-bold">제조사</div>
            <div class="col colLine">(주)국민은행</div>
        </div>
        <div class="row">
            <div class="col-3 colLine fw-bold">가격</div>
            <div class="col colLine"><input type="hidden" id="price" value="1000">1,000 원</div>
        </div>
        <div class="row">
            <div class="col-3 colLine fw-bold">구매 수량</div>
            <div class="col colLine">
                <input type="number" class="form-control" value="1" id="num" onchange="priceSum(); checkVal()">
            </div>
        </div>
        <div class="row">
            <div class="col-3 colLine fw-bold">구매 금액</div>
            <div class="col colLine" id='sum'><span class='fw-bold'>1,000 원</span></div>
        </div>
        <div class="row mt-5">
            <div class="col-6">
                <button type="button" class="btn btn-secondary form-control" onClick="putBag()">장바구니 담기</button>
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-primary form-control" onClick="submit()">주문하기</button>
            </div>
        </div>
    </div>
</div>
<?php
    if(isset($_SESSION[$sessName]))
    {
        $printName = $_SESSION[$sessName];
        $printTel = $_SESSION[$sessTel];
        $printEmail = $_SESSION[$sessEmail];
        $printAddress = $_SESSION[$sessAddress];
    } else
    {
        $printName = "";
        $printTel = '';
        $printEmail = '';
        $printAddress = '';
    }
?>
<div class="row m-5 container" id="order" style="display:none">
    <div class='row'><h4>구매 정보</h4></div>
    <div class="row">
        <div class="col-3 colLine">제품명</div>
        <div class="col colLine">천하장사 오리지널</div>
    </div>
    <div class="row">
        <div class="col-3 colLine">구매 수량</div>
        <div class="col colLine" id='fixedNum'></div>
    </div>
    <div class="row">
        <div class="col-3 colLine">구매 금액</div>
        <div class="col colLine" id='fixedPrice'></div>
    </div>
    <div class='row mt-5'><h4>주문자 정보</h4></div>
    <div class="row">
        <div class="col-3 colLine">주문자</div>
        <div class="col colLine">
            <input type="text" class="form-control" id="buyer" value= '<?php echo "$printName"; ?>'>
        </div>
    </div>
    <div class="row">
        <div class="col-3 colLine">전화번호</div>
        <div class="col colLine">
            <input type="text" class="form-control" id="tel" value= '<?php echo "$printTel"; ?>'>
        </div>
    </div>
    <div class="row">
        <div class="col-3 colLine">이메일</div>
        <div class="col colLine">
            <input type="text" class="form-control" id="email" value= '<?php echo "$printEmail"; ?>'>
        </div>
    </div>
    <div class="row">
        <div class="col-3 colLine">주소</div>
        <div class="col colLine">
            <input type="text" class="form-control" id="address" value= '<?php echo "$printAddress"; ?>'>
        </div>
    </div>
    <div class='row mt-5'><h4>배송지 정보</h4></div>
    <div class="row m-3">
        <input type="checkbox" class="form-check-input" onClick="clone(this)"> 주문자 정보와 동일
    </div>
    <div class="row">
        <div class="col-3 colLine">수령인</div>
        <div class="col colLine">
            <input type="text" class="form-control" id="buyerC">
        </div>
    </div>
    <div class="row">
        <div class="col-3 colLine">전화번호</div>
        <div class="col colLine">
            <input type="text" class="form-control" id="telC">
        </div>
    </div>
    <div class="row">
        <div class="col-3 colLine">이메일</div>
        <div class="col colLine">
            <input type="text" class="form-control" id="emailC">
        </div>
    </div>
    <div class="row">
        <div class="col-3 colLine">주소</div>
        <div class="col colLine">
            <input type="text" class="form-control" id="addressC">
        </div>
    </div>
    <div class='row mt-5'><h4>결제 정보</h4></div>
    <div class='row'>
        <div class='col'>
            <button type='button' class='btn btn-outline-secondary form-control'><span class='material-icons icon'>payment</span><br>신용카드</button>
        </div>
        <div class='col'>
            <button type='button' class='btn btn-outline-secondary form-control'><span class='material-icons icon'>local_atm</span><br>무통장입금</button>
        </div>
        <div class='col'>
            <button type='button' class='btn btn-outline-secondary form-control' onClick='notReady()'>
            <img src='data/img/naver.png' class='img-fluid' style='width:40px'><br>네이버페이</button>
        </div>
        <div class='col'>
            <button type='button' class='btn btn-outline-secondary form-control' onClick='notReady()'>
            <img src='data/img/kakao.png' class='img-fluid' style='width:40px'><br>카카오페이</button>
        </div>
        <div class='col'>
            <button type='button' class='btn btn-outline-secondary form-control'><span class='material-icons icon'>phone_iphone</span><br>휴대폰결제</button>
        </div>
    </div>

</div>

<!-- 여기 하다 말았음 -->
<div class="row m-5 container" id="order" style="display:none">
    <div class='row'>
        <div class='col-3 colLine'>카드번호</div>
        <div class='col colLine'>
            <input type='text' class='form-control'>
        </div>
        <div class='col colLine'>
            <input type='text' class='form-control'> 
        </div>
        <div class='col colLine'>
            <input type='text' class='form-control'>
        </div>
        <div class='col colLine'>
            <input type='text' class='form-control'>
        </div>
    </div>
    <div class='row'>
        <div class='col-3 colLine'>유효기간</div>
        <div class='col colLine'>
            <input type='text' class='form-control'>
        </div>
        <div class='col colLine'>
            <input type='text' class='form-control'> 
        </div>
        <div class='col-3 colLine'>CVC</div>
        <div class='col colLine'>
            <input type='text' class='form-control'>
        </div>
    </div>
</div>

<script>
    function notReady()
    {
        alert('3월 중 오픈 예정입니다!');
    }

    function clone(obj)
    {
        let buyer = document.querySelector('#buyer')
        let tel = document.querySelector('#tel');
        let email = document.querySelector('#email');
        let address = document.querySelector('#address');

        let buyerC = document.querySelector('#buyerC')
        let telC = document.querySelector('#telC');
        let emailC = document.querySelector('#emailC');
        let addressC = document.querySelector('#addressC');

        if(obj.checked == true)
        {
            buyerC.value = buyer.value;
            telC.value = tel.value;
            emailC.value = email.value;
            addressC.value = address.value;
        } else
        {
            buyerC.value = '';
            telC.value = '';
            emailC.value = '';
            addressC.value = '';
        }        
    }

    function submit()
    {
        let price = document.querySelector('#price');
        let num = document.querySelector('#num');
        let sum = document.querySelector('#sum');
        let koNum = (Number(price.value) * Number(num.value)).toLocaleString("ko-KO");
        console.log(koNum);
        console.log(typeof(Number(koNum)));
        console.log(koNum);
        sum.value = koNum;

        let submit = confirm(num.value + "개, 총 " + sum.value + '원 주문이 맞으신가요?');
        if (submit)
        {
            document.querySelector('#order').style.display='';
            document.querySelector('#buyer').focus();
        } else
        {
            document.querySelector('#order').style.display='none';
        }

        let fixedNum = document.querySelector('#fixedNum');
        fixedNum.innerHTML = num.value + ' 개';
        let fixedPrice = document.querySelector('#fixedPrice');
        fixedPrice.innerHTML = '<span class="fw-bold">' + koNum + '</span> 원';

        document.querySelector('#badge').innerHTML="";
    }

    function checkVal()
    {
        let num = document.querySelector('#num');

        if(num.value < 1)
        {
            alert("1보다 큰 수량을 입력하세요.");
            num.value = "1";
        }
    }

    function putBag()
    {
        let bag = document.querySelector('#bag');
        let num = document.querySelector('#num');
        
        bag.innerHTML = '<span class="material-icons icon">shopping_bag</span>'
        bag.innerHTML += '<span class="badge bg-danger rounded-circle" id="badge">' + num.value + '</span>';
    }

    function changeImg(obj)
    {
        let img = document.querySelector('#img')
        img.src = obj.src;
        console.log('change img..');
    }

    function priceSum()
    {
        let price = document.querySelector('#price');
        let num = document.querySelector('#num');
        let sum = document.querySelector('#sum');

        console.log(typeof(price.value));
        console.log(typeof(num.value));
        
        let koNum = (Number(price.value) * Number(num.value)).toLocaleString("ko-KO");
        console.log(koNum);
        console.log(typeof(Number(koNum)));
        console.log(koNum);

        sum.innerHTML = '<span class="fw-bold">' + koNum + '</span> 원';
        
    }

</script>