<?php
    if(isset($_GET['idx']))
        $idx = $_GET['idx']; // 70list에서 get방식으로 인덱스가 오니까(주소창에 써있음)
    else
        echo "
        <script>
            alert('잘못된 경로입니다.');
            location.href='main.php?cmd=70list';
        </script>
        ";
    
    $sql = "SELECT * FROM models WHERE idx='$idx'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    if(!$data) // 없는 인덱스를 직접 치고 들어오면?
    {
        echo "
        <script>
            alert('삭제된 제품입니다.');
            location.href='main.php?cmd=70list';
        </script>
        ";
    }
    echo $_SESSION[$sessTime];

    if(isset($_POST['mode']))
    {
        $mode = $_POST['mode'];
    }
    if(isset($mode) and $mode == 'putcart')
    {
        // midx, size, color, count
        $size = $_POST['size'];
        $color = $_POST['color'];
        $count = $_POST['num'];
        $price = $_POST['price'];
        $ip = $_SERVER["REMOTE_ADDR"];

        if(isset($_SESSION[$sessId]))
            $id = $_SESSION[$sessId];
        else
            $id = "";

        $cartSql = "INSERT into cart (id, midx, size, color, count, price, time, ip) values ('$id', '$idx', '$size', '$color', '$count', '$price', '$_SESSION[$sessTime]', '$ip')";
        $cartResult = mysqli_query($conn, $cartSql);
    
        echo"
        <script>
            alert('장바구니에 담았습니다.');
            location.href='main.php?cmd=$cmd&idx=$idx';
        </script>
        ";
    }
?>
<form method="post" action='main.php?cmd=<?php echo $cmd; ?>&idx=<?php echo $idx; ?>'>
    <input type='hidden' name='mode' value='putcart'>

<div class="row mt-5 border">
    <div class="col-4 m-5">
        <div class="row">
            <img src="data/img/nike.jpeg" id='img' class="img-fluid">
        </div>
        <div class="row">
            <div class="col"> <img src="data/img/nike.jpeg" class="img-thumbnail" onMouseOver="changeImg(this)"> </div>
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
            <div class="col colLine fw-bold"><?php echo $data['model']; ?></div>
        </div>
        <div class="row">
            <div class="col-3 colLine fw-bold">제조사</div>
            <div class="col colLine">Nike Korea</div>
        </div>
        <div class="row">
            <div class="col-3 colLine fw-bold">가격</div>
            <div class="col colLine"><input id="price" name='price' value="<?php echo $data['price']; ?>" readonly></div>
        </div>
        <div class="row">
            <div class="col-3 colLine fw-bold">사이즈</div>
            <div class="col colLine">
                <select id='size' name='size' class='form-control'>
                    <option value="">== 사이즈 선택 ==</option>
                    <?php
                        $sizeList = explode(",", $data["size"]);
                        // 220, 230, 240, 250
                        // [0], [1], [2], [3]
                        $cnt = 0;

                        while($sizeList[$cnt]) // sizeList[0]이 있으면 ~~ 이걸 하고
                        {
                            echo "<option value='$sizeList[$cnt]'>$sizeList[$cnt]</option>";
                            $cnt++;
                        } // sizeList[4]는 없으니까 빠져나감
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-3 colLine fw-bold">색상</div>
            <div class="col colLine">
                <select id='color' name='color' class='form-control'>
                    <option value="">== 색상 선택 ==</option>
                    <?php
                        $colorList = explode(",", $data["color"]);
                        $cnt = 0;

                        while($colorList[$cnt])
                        {
                            echo "<option value='$colorList[$cnt]'>$colorList[$cnt]</option>";
                            $cnt++;
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-3 colLine fw-bold">구매 수량</div>
            <div class="col colLine">
                <input type="number" class="form-control" value="1" id="num" name='num' min='1' onchange="priceSum()">
            </div>
        </div>
        <div class="row">
            <div class="col-3 colLine fw-bold">구매 금액</div>
            <div class="col colLine">
                <input type='text' id='sum' value="<?php echo $data['price'];?>" class='border-0 bg-white fw-bold'>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-4">
                <button type="submit" class="btn btn-outline-secondary form-control">장바구니(Form)</button>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-outline-secondary form-control" onClick="putBag()">장바구니(Ajax)</button>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary form-control" onClick="submit()">주문하기</button>
            </div>
        </div>
    </div>
</div>
</form>
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
        let price = $('#price').val();
        let num = document.querySelector('#num').value;
        let sum = price * num;
        $('#sum').val(sum);        
    }

</script>