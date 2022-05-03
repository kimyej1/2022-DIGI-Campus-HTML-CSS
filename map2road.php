<?php
    include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>지도 생성하기</title>
    
</head>
<body>
<!-- 지도를 표시할 div 입니다 -->
<input type="button" value="+" onClick=zoomIn()>
<input type="button" value="-" onClick=zoomOut()>
<div id="map" style="width:100%;height:350px;"></div>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $kakaoKey ?>"></script>
<script>
var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = { 
        center: new kakao.maps.LatLng(37.5221809, 126.9199484), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };

// 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
var map = new kakao.maps.Map(mapContainer, mapOption); 

map.addOverlayMapTypeId(kakao.maps.MapTypeId.ROADVIEW); 

function zoomIn()
{
    let level = map.getLevel();
    // alert(level);

    if(level > 1)
        map.setLevel(level - 1);
}
function zoomOut()
{
    let level = map.getLevel();

    if(level < 14)
        map.setLevel(level + 1);
}
</script>
</body>
</html>
