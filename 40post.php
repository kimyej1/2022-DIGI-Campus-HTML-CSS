<!--<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
-->

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $kakaoKey?>&libraries=services"> </script>

<script>

    //daum객체는 위에서 설정한 라이브러리 안쪽에 들어있다.
    function kakaoZipCode() {
        new daum.Postcode({
            oncomplete: function(data) {
                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                if (data.userSelectedType === 'R') {  //R은 도로명 주소이다.
                    fullAddr = data.roadAddress;

                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    //fullAddr = data.jibunAddress; //도로명 주소가 아니라면.. 지번주소.
                    fullAddr = data.roadAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                if(data.userSelectedType === 'R' || data.userSelectedType==='J'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                } //도로명 주소일때는 법에 맞춰서 '동' 이름을 추가해야 한다.

                // 건물명이 있을 경우 추가한다.
                if(data.buildingName !== ''){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }

                // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                fullAddr += (extraAddr !== '' ?
                    ' ('+ extraAddr +')' : '');
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                //5자리 새우편번호 사용

                document.querySelector('#zipcode').value = data.zonecode;
                document.querySelector('#road').value = fullAddr; //addr1에 확정된 주소값의 풀네임이 들어간다.

                // 커서를 상세주소 필드로 이동한다.
                // 커서를 이동시켜서 깜빡이게끔 한다.
                var geocoder = new daum.maps.services.Geocoder();
                var callback = function(result, status) {
                    var f = document.zipForm;

                    if(status == daum.maps.services.Status.OK)
                    {
                        document.querySelector("#lon").value = result[0].x;
                        document.querySelector("#lat").value = result[0].y;
                    }else
                    {
                        alert('Error Kakao Map API ...');
                    }
                };    


                var thisAddr = document.querySelector('#road').value;
                geocoder.addressSearch(thisAddr, callback);


                document.getElementById('address').focus();


            }
        }).open();
    }
</script>

<div class="row">
    <div class="col">
        <button type="button" class="btn btn-primary" onClick="kakaoZipCode()">주소검색</button>
    </div>
    <div class="col">
        <input type="text" name="zipcode" id="zipcode" class="form-control" readonly>
    </div>
</div>
<div class="row">
    <div class="col-2">주소</div>
    <div class="col">
        <input type="text" name="road" id="road" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-2">상세</div>
    <div class="col">
        <input type="text" name="address" id="address" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-2">경도</div>
    <div class="col">
        <input type="text" name="lon" id="lon" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-2">위도</div>
    <div class="col">
        <input type="text" name="lat" id="lat" class="form-control">
    </div>
</div>

<div class="row">
    <div class="col">Hidden</div>
    <div class="col"> 
        <input type="hidden" id="test" class="form-control">
    </div>
</div>