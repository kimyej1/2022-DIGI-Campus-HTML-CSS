<?php

    function getFileExt($file)
    {
        $file = strtolower($file);   // strtolower : string to lower 소문자로 바꾸기
        $fileInfo = pathinfo($file);

        return $fileInfo["extension"];
    }

    if(isset($_GET["mode"]) and $_GET["mode"]=="up")
    {
        // file upload..
        if(isset($_FILES["upfile"]) and $_FILES["upfile"]["error"]==0)
        {
            echo "Yes File!<br>";
            echo "name = "  . $_FILES["upfile"]["name"]. "<br>";
            echo "size = "  . $_FILES["upfile"]["size"]. "<br>";

            $fileName = $_FILES["upfile"]["name"];  // 매번 쓰기 귀찮으니까 변수로 만들기
            $ext = getFileExt($fileName);           // 확장자 찾는 함수_ 맨 위에 만들어둠
            echo "ext = $ext <br>";
        } else
        {
            echo "No File..<br>";
        }
    }
?>

<div class="row">
    <div class="col colLine">파일업로드</div>
</div>

<form method="post" enctype="multipart/form-data" action="main.php?cmd=<?php echo $cmd?>&mode=up">
    <div class="row">
        <div class="col colLine">
            <input type="file" name="upfile">
        </div>
        <div class="col colLine">
            <button type="submit" class="btn btn-primary">업로드</button>
        </div>
    </div>
</form>