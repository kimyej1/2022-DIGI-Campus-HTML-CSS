<?php
    function getDirs($path)
    {
        $dirHandler = opendir($path);

        while( ($filename = readdir($dirHandler)) != false )    // 현재 디렉토리 돌면서(ls) 파일/디렉토리가 존재하는 한 계속 실행
        {
            if(is_dir("$path/$filename"))   // 파일인지 디렉토리인지 구분
            {
                // directories
                // echo "[+] $filename<br>";
                $files[] = $filename;       // 배열로 만들기  
            } else
            {
                // files
            }
        }
        return $files;
    }

    function getFiles($path)
    {
        $dirHandler = opendir($path);

        while( ($filename = readdir($dirHandler)) != false )    // 현재 디렉토리 돌면서(ls) 파일/디렉토리가 존재하는 한 계속 실행
        {
            if(is_dir("$path/$filename"))   // 파일인지 디렉토리인지 구분
            {
                // directories
            } else
            {
                // files
                // echo "[-] $filename<br>";
                $files[] = $filename;
            }
        }
        return $files;
    }

    function readFileKB($path)
    {
        // error
        if( !$handler = fopen($path, 'r'))  // 파일 'read'모드로 여는데(fopen) false 반환 (= 실패)
        {
            return "File Open Error";
        }

        $fileContent = file_get_contents($path, true);
        return $fileContent;
    }

    $sess_dir = "sess_dir";

    if(!isset($_SESSION[$sess_dir]) or $_SESSION[$sess_dir]== "")
        $_SESSION[$sess_dir] = "./";    // 세션으로 안들어오면, 그냥 디폴트는 현재 디렉토리로 세팅

    if(isset($_GET["pdir"]))
        $_SESSION[$sess_dir] = $_GET["pdir"];

    $path = $_SESSION[$sess_dir];

    $dir = getDirs($path);
    $files = getFiles($path);
    
    if($dir)           // 매뉴얼에서, sort()는 t/f 리턴하는 boolean이라서, $dir = sort($dir) 이렇게 받으면 안됨
        sort($dir);
    if($files)
        sort($files);

    echo "sess dir = ". $_SESSION[$sess_dir]."<br>";

    if(isset($_GET["rfile"]))
    {
        $memo = readFileKB($_SESSION[$sess_dir]."/".$_GET["rfile"]);
    } else
    {
        $memo = "파일 읽기 아님";
    }

    if(isset($_POST["fname"]) and $_POST["fname"] != "")    // != "" 대신에 strlen($_POST["fname"] >= 1) 이렇게 길이로 해도됨
    {
        echo "fname = " . $_POST["fname"] . "<br>";
        $fname = $_POST["fname"];
        $pathFile = $_SESSION[$sess_dir]."/".$fname;

        if(file_exists($pathFile))
        {
            // 현재 세션 디렉토리 밑에 파일이 이미 있으면, 적힌 내용으로 덮어쓰기

        } else
        {
            // 그런 파일 없으면, 새로 만들기
            if(!$handler = fopen($pathFile, 'w'))   // w: 쓰기 모드
            {
                // fail
                echo "open error<br>";
            }

            // success
            if(fwrite($handler, $_POST["content"]) == false)
                echo "fwrite error<br>";

            echo "
            <script>
                alert('성공');
                // 
            </script>
            ";
        }
    } else
    {
        echo "no fname <br>";
    }
    ?>

    <script>
        function jsTest()
        {
            let msg = prompt('Insert Message');
            alert("your msg = " + msg);
        }
        jsTest();

    </script>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>?cmd=<?php echo $cmd?>">
            <div class="row">
                <div class="col">
                    <textarea class="form-control" name="content" rows="10"><?php echo $memo?></textarea>   <!-- 여기 있는 내용 갖다쓰려고 이름 만듬 -->
                </div>
            </div>
            <div class="row m-4">
                <div class="col-2 fw-bold">
                    파일명
                </div>
                <div class="col">
                    <input type="text" name="fname" class="form-control">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-warning form-control">등록/수정</button>
                </div>
            </div>
        </form>
    <?php

    // 디렉토리 넣을 좌측 테이블 만들기
    echo "
        <table class='table'>
            <tr>
                <td>
                    <table class='table'>
    ";

    $dirCnt = 0;
    while(isset($dir[$dirCnt]))
    {
        $nextDir = $_SESSION[$sess_dir] ."/".$dir[$dirCnt];     // . = + (문장 이어붙이기)
        $nextDir = str_replace("//", "/", $nextDir);            // ./ 일때는 //두개 생길 수 있어서..
        ?>
            <tr>
                <td>
                    <a href='main.php?cmd=<?php echo $cmd?>&pdir=<?php echo $nextDir?>'>
                        <span class="material-icons">folder</span> <?php echo $dir[$dirCnt]?>
                    </a>
                </td>
            </tr>
        <?php
        $dirCnt ++;
    }

    // 파일 넣을 우측 테이블 만들기
    echo "
                    </table>
                </td>
                <td>
                    <table class='table'>
    ";

    $fileCnt = 0;
    while(isset($files[$fileCnt]))
    {
        ?>
            <tr>
                <td>
                    <a href='<?php echo $_SERVER["PHP_SELF"]?>?cmd=<?php echo $cmd?>&rfile=<?php echo $files[$fileCnt]?>'>
                        <span class="material-icons">description</span> <?php echo $files[$fileCnt]?>
                    </a>
                </td>
            </tr>
        <?php
        $fileCnt ++;
    }

    echo "
                    </table>
                </td>
            </tr>
        </table>
    ";
?>