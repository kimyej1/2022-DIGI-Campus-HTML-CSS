<div class="row">
    <div class="col">
        <h5 class="text-primary">๐งฉ Insert</h5>
    </div>
</div>

<?php
    if(isset($_POST["major"]))
    {
        $major = $_POST["major"];
    }
    if(isset($_POST["name"]))
    {
        $name = $_POST["name"];
    }
    if(isset($_POST["age"]))
    {
        $age = $_POST["age"];
    }
    if(isset($_POST["mode"])) // ์์  ๋ฒํผ์ post๋ฐฉ์
    {
        $mode = $_POST["mode"];
    }
    if(isset($_GET["mode"])) // ์ญ์  ๋ฒํผ์ get๋ฐฉ์
    {
        $mode = $_GET["mode"];
    }
    if(isset($_POST["idx"]))
    {
        $idx = $_POST["idx"];
    }
    if(isset($_GET["idx"]))
    {
        $idx = $_GET["idx"];
    }

    if(isset($mode) and $mode == "delete")
    {
        $sql = "DELETE FROM dept WHERE idx='$idx'";
        $result = mysqli_query($conn, $sql);
        $affectedCount = mysqli_affected_rows($conn);

        if($affectedCount ==1)
            $msg = "์ญ์  ์ฑ๊ณต";
        else
            $msg = "์ญ์  ์คํจ";

        echo "
        <script>
            alert('$msg');
            location.href='main.php?cmd=58insert'; 
        </script>
        "; 
    }
    if(isset($mode) and $mode == "update")
    {
        $sql = "UPDATE dept SET name = '$name', major = '$major', age = '$age' WHERE idx='$idx'";
        $result = mysqli_query($conn, $sql);
        $affectedCount = mysqli_affected_rows($conn);

        if($affectedCount ==1)
            $msg = "๋ณ๊ฒฝ ์ฑ๊ณต";
        else
            $msg = "๋ณ๊ฒฝ ์คํจ";

        echo "
        <script>
            alert('$msg');
            location.href='main.php?cmd=58insert'; 
        </script>
        "; 
    }
    if(isset($mode) and $mode == "insert")
    {
        $sql = "INSERT INTO dept (name, major, age) VALUES ('$name', '$major', '$age')";
        $result = mysqli_query($conn, $sql);
        // ์ํฅ์ ๋ฐ์ ๋ฐ์ดํฐ๊ฐ ์๋๊ฐ? (์๋ฅผ๋ค์ด ๋์ด 1000์ด ์ด์ ์ด๋ฆ ๋ฐ๊ฟ~ ํ๋ฉด ๋ฌธ๋ฒ์ด ๋ง๋๋ผ๋ ํด๋นํ๋ ๋ฐ์ดํฐ๊ฐ ์์์๋..)
        $affectedCount = mysqli_affected_rows($conn);

        if($affectedCount ==1) // ์ธ์ํธ๊ฐ ์ ์์ ์ผ๋ก ๋์๋ค๋ฉด 1๊ฐ๊ฐ ์ํฅ ๋ฐ์์ ๊ฒ(์๋ก ์๊ธด 1์ค)
            $msg = "๋ฑ๋ก ์ฑ๊ณต";
        else
            $msg = "๋ฑ๋ก ์คํจ";

        echo "
        <script>
            alert('$msg');
            location.href='main.php?cmd=58insert'; 
        </script>
        "; // ์๋ฟ ํ ์๋ก๊ณ ์นจ ํ๋ฒ ํด์ฃผ๊ธฐ(๊ฐ์ ๊ฐ์ด ๋ ๋ ๋ผ๊ฐ์ ์คํจ(์ค๋ณต)์ฒ๋ฆฌ ๋ ๊น๋ด..)
    }
?>

<form method='post' action='main.php?cmd=58insert'>
    <input type='hidden' name='mode' value='insert'>
    <div class="row">
        <div class="col">
            <input type='text' class='form-control' name='name' id='name' placeholder='์ด๋ฆ'>
        </div>
        <div class="col">
            <input type='text' class='form-control' name='major' placeholder='์ ๊ณต'>
        </div>
        <div class="col">
            <input type='text' class='form-control' name='age' placeholder='๋์ด'>
        </div>
        <div class="col-1">
            <button type='submit' class='form-control btn btn-primary'>Insert</button>
        </div>
    </div>
    <div class="row">
        <div class="col" id="result">
            <!-- ajax ๊ฒฐ๊ณผ ์ฌ๊ธฐ๋ค๊ฐ ๋ฃ์ผ๋ ค๊ณ  ๋ง๋ฌ -->
        </div>
    </div>
</form>

<div class="row fw-bold mt-5" style='background-color:#DEDEDE'>
    <div class="col-1 colLine">์์</div>
    <div class="col colLine">์ด๋ฆ</div>
    <div class="col colLine">์ ๊ณต</div>
    <div class="col colLine">๋์ด</div>
    <div class="col colLine">๋น๊ณ </div>
</div>
<?php
    $sql = "SELECT count(*) AS total FROM dept ORDER BY idx ASC"; // ์ธ๋ฑ์ค ์ค๋ฆ์ฐจ์์ผ๋ก ์ ๋ ฌ
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    $total = $data["total"];
    echo "total = $total <br>";    
    $LPP = 3; // ํํ์ด์ง์ ์ธ๋ฑ์ค ๋ช๊ฐ?
    $totalPage = ceil($total / $LPP); // ceil() : ๋ฌด์กฐ๊ฑด ์ฌ๋ฆผ
    echo "totalPage = $totalPage<br>";

    if(isset($_GET["page"])) // main.php?cmd=58insert : 1ํ์ด์ง ๋ณด์ฌ์ค, main.php?cmd=58insert&page=3 : 3ํ์ด์ง ๋ณด์ฌ์ค
        $page = $_GET["page"];

    if(!isset($page)) // ํ์ด์ง ์ ๋ณด๊ฐ ์์ผ๋ฉด ๋ฌด์กฐ๊ฑด 1ํ์ด์ง ๋ณด์ฌ์ค~
        $page = 1;

    /*
        1p : idx 0 ~ 2
        2p : 3 ~ 5
        3p : 6 ~ 8
        np : (n-1)*3
    */

    $start = ($page -1) * $LPP;

    $sql = "SELECT * FROM dept ORDER BY idx ASC LIMIT $start, $LPP"; // ์ธ๋ฑ์ค ์ค๋ฆ์ฐจ์์ผ๋ก ์ ๋ ฌ
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    while($data)
    {
        // ์ถ๋ ฅ
        ?>
        <form method="POST" action="main.php?cmd=58insert">
            <input type='hidden' name='mode' value='update'>
            <div class="row">
                <div class="col-1 colLine"><input type='text' name='idx' value='<?php echo $data['idx']?>' readonly class='bg-white border-0'></div>
                <div class="col colLine"><input type='text' name='name' class='form-control' value='<?php echo $data['name']?>'></div>
                <div class="col colLine"><input type='text' name='major' class='form-control' value='<?php echo $data['major']?>'> </div>
                <div class="col colLine"><input type='text' name='age' class='form-control' value='<?php echo $data['age']?>'> </div>
                <div class="col colLine">
                    <button type="submit" class="btn btn-outline-success">์์ </button>
                    <button type="button" class="btn btn-outline-danger" onClick='confirmDelete(<?php echo $data['idx']?>)'>์ญ์ </button>
                    <button type="button" class='btn btn-outline-secondary'>์์ธ๋ณด๊ธฐ</button>
                </div>
            </div>
        </form>
        <?php
        $data = mysqli_fetch_array($result);
    }
?>

<div class='row'>
    <div class='col text-center'>
        <?php
        for($i=1; $i<=$totalPage; $i++)
        {
            if($i == $page)
                echo "<a href='main.php?cmd=58insert&page=$i'><span class='badge bg-dark'>$i</span></a> ";
            else
                echo "<a href='main.php?cmd=58insert&page=$i'><span class='badge' style='background-color:#AFAFAF'>$i</span></a> ";
        }
        ?>
    </div>
</div>
<script>
    function confirmDelete(pidx)
    {
        if(confirm("์ญ์ ๋ ๋ฐ์ดํฐ๋ ๋ณต๊ตฌํ  ์ ์์ต๋๋ค.\n์ ๋ง ์ญ์ ํ์๊ฒ ์ต๋๊น?"))
        {
            // get๋ฐฉ์์ผ๋ก ๋์ด๊ฐ๋ฉด ์ฃผ์์ฐฝ์ ์ด๋ฐ ํ์์ผ๋ก ๋์ด
            location.href='main.php?cmd=58insert&mode=delete&idx='+pidx;
        }
    }
</script>