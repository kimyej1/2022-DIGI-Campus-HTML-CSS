<?php
    include "db.php";
    $conn = connectDB();

    $searchKey = $_POST['searchKey'];
    
    $sql = "SELECT * FROM kbstar WHERE name like '%$searchKey%'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result); 
    
    // echo "$searchKey...<br>sql= $sql";
?>

<ul class="list-unstyled preview_ul bg-warning border border-3 rounded">
<?php
    // data 있으면, li 출력
    while($data)
    {
        echo "<li class='preview_li'> $data[name] </li>"; // preview_li 라는 클래스 하나 만들자(55.php 맨위 style)
        // 오른쪽으로 창 넘어갈정도로 길면 -> 다음줄로 내려감(default) -> 필요시 ellipsis(말줄임표)를 활용하자
        $data = mysqli_fetch_array($result);
    }
?>
</ul>

<?php
    closeDB($conn);
?>