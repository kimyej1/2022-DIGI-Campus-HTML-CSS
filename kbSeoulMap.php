<?php
    include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KB국민은행 in Seoul</title>
    
</head>
<body>
    <p>
        <h1>🗺 선릉역 주변 KB국민은행</h1>
    </p>
<!-- 지도를 표시할 div 입니다 -->
<div id="map" style="width:100%;height:500px;"></div>
<input type="button" value="+" style="background-color:#DEDEDE;" onClick=zoomIn()>
<input type="button" value="-" style="background-color:#DEDEDE;" onClick=zoomOut()>
<a href='https://omoney.kbstar.com/quics?page=C016505&QSL=F#loading' target="_blank" style="background-color:#FFFF00">[ 다른지점 더 검색하기 ]</a>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $kakaoKey ?>"></script>
<script>
var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = { 
        center: new kakao.maps.LatLng(37.5022938, 127.0406875), // 지도의 중심좌표
        level: 5 // 지도의 확대 레벨
    };

// 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
var map = new kakao.maps.Map(mapContainer, mapOption); 

// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
var zoomControl = new kakao.maps.ZoomControl();
map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

// 마커를 표시할 위치와 title 객체 배열입니다 
var positions = [
    {
        content: '<div style="padding:5px;">🏦 동역삼지점<br>📞 02-567-5503<br><br><img src="./data/img/kbbranch.jpeg" width="300px"></div>', 
        latlng: new kakao.maps.LatLng(37.5022938, 127.0406875)
    },
    {
        content: '<div style="padding:5px;">🏦 삼성동지점<br>📞 02-538-0421<br><br><img src="./data/img/kbbranch2.jpeg" width="300px"></div>', 
        latlng: new kakao.maps.LatLng(37.5073423, 127.0572734)
    },
    {
        content: '<div style="padding:5px;">🏦 강남중앙지점<br>📞 02-557-4932<br><br><img src="./data/img/kbbranch3.jpeg" width="300px"></div>', 
        latlng: new kakao.maps.LatLng(37.4987372, 127.0277663)
    }
];

// 마커 이미지의 이미지 주소입니다
var imageSrc = "./data/img/kbmark.png"; 
    
for (var i = 0; i < positions.length; i ++) 
{    
    // 마커 이미지의 이미지 크기 입니다
    var imageSize = new kakao.maps.Size(60, 70); 
    
    // 마커 이미지를 생성합니다    
    var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize); 
    
    // 마커를 생성합니다
    var marker = new kakao.maps.Marker({
        map: map, // 마커를 표시할 지도
        position: positions[i].latlng, // 마커를 표시할 위치
        title : positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
        image : markerImage, // 마커 이미지 
        clickable : true
    });

    // 마커에 표시할 인포윈도우를 생성합니다 
    var infowindow = new kakao.maps.InfoWindow({
        content: positions[i].content, // 인포윈도우에 표시할 내용
        removable : true
    });

    kakao.maps.event.addListener(marker, 'click', makeOverListener(map, marker, infowindow));
    // kakao.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
}

function makeOverListener(map, marker, infowindow) {
    return function() {
        infowindow.open(map, marker);
    };
}

// 선을 구성하는 좌표 배열입니다. 이 좌표들을 이어서 선을 표시합니다
var linePath1 = [
    new kakao.maps.LatLng(37.4987372, 127.0277663),
    new kakao.maps.LatLng(37.5022938, 127.0406875)
];
var linePath2 = [
    new kakao.maps.LatLng(37.5022938, 127.0406875),
    new kakao.maps.LatLng(37.5073423, 127.0572734) 
];

// 지도에 표시할 선을 생성합니다
var polyline1 = new kakao.maps.Polyline({
    path: linePath1, // 선을 구성하는 좌표배열 입니다
    strokeWeight: 10, // 선의 두께 입니다
    strokeColor: 'green', // 선의 색깔입니다
    strokeOpacity: 0.7, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
    strokeStyle: 'solid' // 선의 스타일입니다
});
var polyline2 = new kakao.maps.Polyline({
    path: linePath2, // 선을 구성하는 좌표배열 입니다
    strokeWeight: 10, // 선의 두께 입니다
    strokeColor: '#0000FF', // 선의 색깔입니다
    strokeOpacity: 0.7, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
    strokeStyle: 'solid' // 선의 스타일입니다
});

// 지도에 선을 표시합니다 
polyline1.setMap(map);  
polyline2.setMap(map);  



// 지도에 표시할 원을 생성합니다
var circles = [
    new kakao.maps.Circle({
        center : new kakao.maps.LatLng(37.4987372, 127.0277663),
        radius: 50, // 미터 단위의 원의 반지름입니다 
        strokeColor: '#FF0000'
    }), 
    new kakao.maps.Circle({
        center : new kakao.maps.LatLng(37.5022938, 127.0406875),
        radius: 50, // 미터 단위의 원의 반지름입니다 
        strokeColor: '#FF0000'
    }), 
    new kakao.maps.Circle({
        center : new kakao.maps.LatLng(37.5073423, 127.0572734),
        radius: 50, // 미터 단위의 원의 반지름입니다 
        strokeColor: '#FF0000'
    })
]; 

// 지도에 원을 표시합니다 
circles[0].setMap(map); 
circles[1].setMap(map); 
circles[2].setMap(map); 


// 거리 구하기
var distance1 = Math.round(polyline1.getLength()); // 선의 총 거리를 계산합니다
var display1 = '<div class="dotOverlay distanceInfo" style="background-color:black; color:white; padding:5px;">거리 :  <span class="number">' + distance1 + '</span>m</div>'; // 커스텀오버레이에 추가될 내용입니다

// 거리 구하기
var distance2 = Math.round(polyline2.getLength()); // 선의 총 거리를 계산합니다
var display2 = '<div class="dotOverlay distanceInfo" style="background-color:black; color:white; padding:5px;">거리 :  <span class="number">' + distance2 + '</span>m</div>'; // 커스텀오버레이에 추가될 내용입니다

// 거리정보를 지도에 표시합니다
showDistance1(display1);   
showDistance2(display2);

// 마우스 드래그로 그려지고 있는 선의 총거리 정보를 표시하거
// 마우스 오른쪽 클릭으로 선 그리가 종료됐을 때 선의 정보를 표시하는 커스텀 오버레이를 생성하고 지도에 표시하는 함수입니다
function showDistance1(content) {
    
    var distanceOverlay = new kakao.maps.CustomOverlay({
        map: map, // 커스텀오버레이를 표시할 지도입니다
        content: content,  // 커스텀오버레이에 표시할 내용입니다
        position: new kakao.maps.LatLng(37.500455, 127.035460), // 커스텀오버레이를 표시할 위치입니다.
        xAnchor: 0,
        yAnchor: 0,
        zIndex: 3  
    });      
}
function showDistance2(content) {
    
    var distanceOverlay = new kakao.maps.CustomOverlay({
        map: map, // 커스텀오버레이를 표시할 지도입니다
        content: content,  // 커스텀오버레이에 표시할 내용입니다
        position: new kakao.maps.LatLng(37.504809, 127.050195), // 커스텀오버레이를 표시할 위치입니다.
        xAnchor: 0,
        yAnchor: 0,
        zIndex: 3  
    });      
}

// 마커가 지도 위에 표시되도록 설정합니다
marker.setMap(map);

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
