<?php
    if(isset($_GET["mode"]) and $_GET["mode"] == "insert")
    {
        $title = $_POST["title"];
        $content = $_POST["content"];

        /*
            CREATE TABLE bbs (
                idx     int(10) auto_increment,
                title   char(100),
                content text,               -- text로 하면 기본 4,000자

                primary key(idx)
            )
        */

        $sql = "INSERT INTO bbs (title, content) VALUES ('$title', '$content')";    
        // $title, $content에 ', "가 들어가면 어떻게 동작하는지 확인! ==> ********** 크로스사이트 스크립팅 **********
        $result = mysqli_query($conn, $sql);

        // xmp : 태그소스를 그대로 출력
        echo "<xmp>$sql</xmp>   
            <script>
                alert('글 등록 완료');
                location.href='main.php?cmd=$cmd';
            </script>
        ";
    }
?>

<div class="row">
    <div class="col">
        XSS 테스트 게시판
    </div>
</div>

<form method="post" action="main.php?cmd=<?php echo $cmd;?>&mode=insert">
    <div class="row">
        <div class="col-2">
            제목
        </div>
        <div class="col">
            <input type="text" class="form-control" name="title">
        </div>
    </div>

    <div class="row">
        <div class="col-2">
            내용
        </div>
        <div class="col">
            <textarea class="form-control" name="content" rows="5"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary">등록</button>
        </div>
    </div>
</form>

<div class="row">
    <table class="table">
        <tr>
            <td>순서</td>
            <td>제목</td>
            <td>내용</td>
        </tr>

        <?php
            $sql = "SELECT * FROM bbs ORDER BY idx DESC";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_array($result);

            while($data)
            {
                ?>
                    <tr>
                        <td><?php echo $data["idx"];?></td>
                        <td><?php echo $data["title"];?></td>
                        <td><?php echo $data["content"];?></td>
                    </tr>
                <?php
                $data = mysqli_fetch_array($result);
            }
        ?>
        
    </table>
</div>
