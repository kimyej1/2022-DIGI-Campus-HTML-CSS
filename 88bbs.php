<?php
    if(isset($_GET["mode"]) and $_GET["mode"] == "insert")
    {
        $title = $_POST["title"];
        $content = $_POST["content"];

        // < : &lt; 이런걸로 바꾸기
        $title = str_replace("<", "&lt;", $title);
        $title = str_replace(">", "&gt;", $title);
        $content = str_replace("<", "&lt;", $content);
        $content = str_replace(">", "&gt;", $content);

        // 슬래쉬를 자동으로 넣어주는 함수
        $title = addslashes($title);
        $content = addslashes($content);

        $sql = "INSERT INTO bbs (title, content) VALUES ('$title', '$content')";    
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
                        <td><textarea class="form-control" rows="5"><?php echo $data["content"];?></textarea></td>
                    </tr>
                <?php
                $data = mysqli_fetch_array($result);
            }
        ?>
        
    </table>
</div>
