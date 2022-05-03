<script>
    function cloneData()
    {
        var input = document.querySelector("#input").value; // #input의 값을 저장
        var len = input.length; // document.querySelector("#input").value.length; 와 동일

        if(input) // input에 값이 있으면
        {
            console.log("TRUE : " + input);
        } else // input값이 없으면 (len == 0)
        {
            console.log("FALSE : " + input);
        }

        if(len > 10)
        {
            console.log("10보다 큽니다.");
        } else
        {
            console.log("10보다 같거나 작습니다.");
        }

        // a > b? true : false 삼항연산자
        len > 5 ? alert('Large') : console.log("Small");

        var objClone = document.querySelector("#clone"); // clone의 값이 아니라 clone 자체('객체')를 저장
        objClone.value = input; // document.querySelector("#clone").value = input; 와 동일
        document.querySelector("#cloneLength").value = len;
    }

    function checkNull()
    {
        var name = prompt("이름을 입력하세요");
        if(name != null) // prompt에서 '확인'을 누른 경우
        {
            if(name)
            {
                console.log("값이 있음.");
            } else
            {
                console.log("확인은 눌렀는데, 값이 없음.");
            }
        } else // prompt에서 '취소'를 누른 경우
        {
            console.log("취소 누름.")
        }
    }
</script>

<div class="row">
    <div class="col text-primary">
        <button type="button" class="btn btn-primary" onClick="checkNull()">Null 검사</button>
    </div>
</div>

<div class="row">
    <div class="col text-primary">
        <input type="text" id="input" class="form-control" onKeyUp="cloneData()">
        <!-- onKeyUp : 사용자가 키보드를 눌렀다가(입력) 뗐을 때 발생하는 이벤트 (누르고있는 동안은 일어나지 않음) -->
    </div>
</div>

<div class="row">
    <div class="col text-primary">
        <input type="text" id="clone" class="form-control">
    </div>
</div>

<div class="row">
    <div class="col text-primary">
        <input type="text" id="cloneLength" class="form-control">
    </div>
</div>