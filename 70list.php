<div class="row">
    <div class="col">
        <h5 class="text-primary"><span class="material-icons icon">person_add</span> 모델 관리</h5>
    </div>
</div>

<?php
    $sql = "SELECT * FROM models order by idx asc";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    if($data)
    {
        $cnt = 0;
        while($data)
        {
            $cnt ++; // 1,2,3(줄바꿈) 4,5,6(줄바꿈)... 이렇게 하고싶음

            // 출력
            if($cnt % 3 == 1)
            {
                echo "<div class='row'>";
            }
            $data['price'] = number_format($data['price']);

            echo "
            <div class='col text-center'>
                <a href='main.php?cmd=71shopping&idx=$data[idx]'><img src='./data/img/nike.jpeg' class='img-fluid' style='width:100%'></a><br>
                <span class='fw-bold'>$data[model]</span> <br>
                <span class='text-danger'>$data[price]</span> 원
            </div>
            ";

            // 목록 보여주기
            if($cnt % 3 == 0)
            {
                echo "</div>";
            }
            $data = mysqli_fetch_array($result);
        }

        // 1번만 그린 경우, 2번의 빈칸을 그린다. (맨 마지막 줄일 때)
        if($cnt % 3 != 0)
        {
            for($i=$cnt+1; $i<=$cnt+10; $i++)
            {
                echo "<div class='col'></div>";
                
                if($i % 3 == 0)
                    break;
            }
            echo "</div>"; // 마지막 row 닫아주는 역할
        }
    } else
    {

    }
?>