<?php
    include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KBκ΅­λ―Όμν in Seoul</title>
    
</head>
<body>
    <p>
        <h1>πΊ μ λ¦μ­ μ£Όλ³ KBκ΅­λ―Όμν</h1>
    </p>
<!-- μ§λλ₯Ό νμν  div μλλ€ -->
<div id="map" style="width:100%;height:500px;"></div>
<input type="button" value="+" style="background-color:#DEDEDE;" onClick=zoomIn()>
<input type="button" value="-" style="background-color:#DEDEDE;" onClick=zoomOut()>
<a href='https://omoney.kbstar.com/quics?page=C016505&QSL=F#loading' target="_blank" style="background-color:#FFFF00">[ λ€λ₯Έμ§μ  λ κ²μνκΈ° ]</a>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $kakaoKey ?>"></script>
<script>
var mapContainer = document.getElementById('map'), // μ§λλ₯Ό νμν  div 
    mapOption = { 
        center: new kakao.maps.LatLng(37.5022938, 127.0406875), // μ§λμ μ€μ¬μ’ν
        level: 5 // μ§λμ νλ λ λ²¨
    };

// μ§λλ₯Ό νμν  divμ  μ§λ μ΅μμΌλ‘  μ§λλ₯Ό μμ±ν©λλ€
var map = new kakao.maps.Map(mapContainer, mapOption); 

// μ§λ νλ μΆμλ₯Ό μ μ΄ν  μ μλ  μ€ μ»¨νΈλ‘€μ μμ±ν©λλ€
var zoomControl = new kakao.maps.ZoomControl();
map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

// λ§μ»€λ₯Ό νμν  μμΉμ title κ°μ²΄ λ°°μ΄μλλ€ 
var positions = [
    {
        content: '<div style="padding:5px;">π¦ λμ­μΌμ§μ <br>π 02-567-5503<br><br><img src="./data/img/kbbranch.jpeg" width="300px"></div>', 
        latlng: new kakao.maps.LatLng(37.5022938, 127.0406875)
    },
    {
        content: '<div style="padding:5px;">π¦ μΌμ±λμ§μ <br>π 02-538-0421<br><br><img src="./data/img/kbbranch2.jpeg" width="300px"></div>', 
        latlng: new kakao.maps.LatLng(37.5073423, 127.0572734)
    },
    {
        content: '<div style="padding:5px;">π¦ κ°λ¨μ€μμ§μ <br>π 02-557-4932<br><br><img src="./data/img/kbbranch3.jpeg" width="300px"></div>', 
        latlng: new kakao.maps.LatLng(37.4987372, 127.0277663)
    }
];

// λ§μ»€ μ΄λ―Έμ§μ μ΄λ―Έμ§ μ£Όμμλλ€
var imageSrc = "./data/img/kbmark.png"; 
    
for (var i = 0; i < positions.length; i ++) 
{    
    // λ§μ»€ μ΄λ―Έμ§μ μ΄λ―Έμ§ ν¬κΈ° μλλ€
    var imageSize = new kakao.maps.Size(60, 70); 
    
    // λ§μ»€ μ΄λ―Έμ§λ₯Ό μμ±ν©λλ€    
    var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize); 
    
    // λ§μ»€λ₯Ό μμ±ν©λλ€
    var marker = new kakao.maps.Marker({
        map: map, // λ§μ»€λ₯Ό νμν  μ§λ
        position: positions[i].latlng, // λ§μ»€λ₯Ό νμν  μμΉ
        title : positions[i].title, // λ§μ»€μ νμ΄ν, λ§μ»€μ λ§μ°μ€λ₯Ό μ¬λ¦¬λ©΄ νμ΄νμ΄ νμλ©λλ€
        image : markerImage, // λ§μ»€ μ΄λ―Έμ§ 
        clickable : true
    });

    // λ§μ»€μ νμν  μΈν¬μλμ°λ₯Ό μμ±ν©λλ€ 
    var infowindow = new kakao.maps.InfoWindow({
        content: positions[i].content, // μΈν¬μλμ°μ νμν  λ΄μ©
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

// μ μ κ΅¬μ±νλ μ’ν λ°°μ΄μλλ€. μ΄ μ’νλ€μ μ΄μ΄μ μ μ νμν©λλ€
var linePath1 = [
    new kakao.maps.LatLng(37.4987372, 127.0277663),
    new kakao.maps.LatLng(37.5022938, 127.0406875)
];
var linePath2 = [
    new kakao.maps.LatLng(37.5022938, 127.0406875),
    new kakao.maps.LatLng(37.5073423, 127.0572734) 
];

// μ§λμ νμν  μ μ μμ±ν©λλ€
var polyline1 = new kakao.maps.Polyline({
    path: linePath1, // μ μ κ΅¬μ±νλ μ’νλ°°μ΄ μλλ€
    strokeWeight: 10, // μ μ λκ» μλλ€
    strokeColor: 'green', // μ μ μκΉμλλ€
    strokeOpacity: 0.7, // μ μ λΆν¬λͺλ μλλ€ 1μμ 0 μ¬μ΄μ κ°μ΄λ©° 0μ κ°κΉμΈμλ‘ ν¬λͺν©λλ€
    strokeStyle: 'solid' // μ μ μ€νμΌμλλ€
});
var polyline2 = new kakao.maps.Polyline({
    path: linePath2, // μ μ κ΅¬μ±νλ μ’νλ°°μ΄ μλλ€
    strokeWeight: 10, // μ μ λκ» μλλ€
    strokeColor: '#0000FF', // μ μ μκΉμλλ€
    strokeOpacity: 0.7, // μ μ λΆν¬λͺλ μλλ€ 1μμ 0 μ¬μ΄μ κ°μ΄λ©° 0μ κ°κΉμΈμλ‘ ν¬λͺν©λλ€
    strokeStyle: 'solid' // μ μ μ€νμΌμλλ€
});

// μ§λμ μ μ νμν©λλ€ 
polyline1.setMap(map);  
polyline2.setMap(map);  



// μ§λμ νμν  μμ μμ±ν©λλ€
var circles = [
    new kakao.maps.Circle({
        center : new kakao.maps.LatLng(37.4987372, 127.0277663),
        radius: 50, // λ―Έν° λ¨μμ μμ λ°μ§λ¦μλλ€ 
        strokeColor: '#FF0000'
    }), 
    new kakao.maps.Circle({
        center : new kakao.maps.LatLng(37.5022938, 127.0406875),
        radius: 50, // λ―Έν° λ¨μμ μμ λ°μ§λ¦μλλ€ 
        strokeColor: '#FF0000'
    }), 
    new kakao.maps.Circle({
        center : new kakao.maps.LatLng(37.5073423, 127.0572734),
        radius: 50, // λ―Έν° λ¨μμ μμ λ°μ§λ¦μλλ€ 
        strokeColor: '#FF0000'
    })
]; 

// μ§λμ μμ νμν©λλ€ 
circles[0].setMap(map); 
circles[1].setMap(map); 
circles[2].setMap(map); 


// κ±°λ¦¬ κ΅¬νκΈ°
var distance1 = Math.round(polyline1.getLength()); // μ μ μ΄ κ±°λ¦¬λ₯Ό κ³μ°ν©λλ€
var display1 = '<div class="dotOverlay distanceInfo" style="background-color:black; color:white; padding:5px;">κ±°λ¦¬ :  <span class="number">' + distance1 + '</span>m</div>'; // μ»€μ€νμ€λ²λ μ΄μ μΆκ°λ  λ΄μ©μλλ€

// κ±°λ¦¬ κ΅¬νκΈ°
var distance2 = Math.round(polyline2.getLength()); // μ μ μ΄ κ±°λ¦¬λ₯Ό κ³μ°ν©λλ€
var display2 = '<div class="dotOverlay distanceInfo" style="background-color:black; color:white; padding:5px;">κ±°λ¦¬ :  <span class="number">' + distance2 + '</span>m</div>'; // μ»€μ€νμ€λ²λ μ΄μ μΆκ°λ  λ΄μ©μλλ€

// κ±°λ¦¬μ λ³΄λ₯Ό μ§λμ νμν©λλ€
showDistance1(display1);   
showDistance2(display2);

// λ§μ°μ€ λλκ·Έλ‘ κ·Έλ €μ§κ³  μλ μ μ μ΄κ±°λ¦¬ μ λ³΄λ₯Ό νμνκ±°
// λ§μ°μ€ μ€λ₯Έμͺ½ ν΄λ¦­μΌλ‘ μ  κ·Έλ¦¬κ° μ’λ£λμ λ μ μ μ λ³΄λ₯Ό νμνλ μ»€μ€ν μ€λ²λ μ΄λ₯Ό μμ±νκ³  μ§λμ νμνλ ν¨μμλλ€
function showDistance1(content) {
    
    var distanceOverlay = new kakao.maps.CustomOverlay({
        map: map, // μ»€μ€νμ€λ²λ μ΄λ₯Ό νμν  μ§λμλλ€
        content: content,  // μ»€μ€νμ€λ²λ μ΄μ νμν  λ΄μ©μλλ€
        position: new kakao.maps.LatLng(37.500455, 127.035460), // μ»€μ€νμ€λ²λ μ΄λ₯Ό νμν  μμΉμλλ€.
        xAnchor: 0,
        yAnchor: 0,
        zIndex: 3  
    });      
}
function showDistance2(content) {
    
    var distanceOverlay = new kakao.maps.CustomOverlay({
        map: map, // μ»€μ€νμ€λ²λ μ΄λ₯Ό νμν  μ§λμλλ€
        content: content,  // μ»€μ€νμ€λ²λ μ΄μ νμν  λ΄μ©μλλ€
        position: new kakao.maps.LatLng(37.504809, 127.050195), // μ»€μ€νμ€λ²λ μ΄λ₯Ό νμν  μμΉμλλ€.
        xAnchor: 0,
        yAnchor: 0,
        zIndex: 3  
    });      
}

// λ§μ»€κ° μ§λ μμ νμλλλ‘ μ€μ ν©λλ€
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
