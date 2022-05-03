<script>

    var flag = 0;
    var cal = "";
    var prevNum = 0;
    var display = 0;

    function doNum(num)
    {
        console.log(num); // 번호 잘 눌리는지 확인
        display = document.querySelector("#display");
    
        if(display.value == 0)
        {
            display.value = num;
        } else
        {
            if(flag == 1)
            {
                display.value = num;
                flag = 0;
            } else
            {
                display.value = display.value + num;
            }
        }  
    }

    function doPlus()
    {
        if(cal == '+' || cal == "")
        {
            prevNum += Number(display.value);
        } else if(cal == '-')
        {
            prevNum = Number(prevNum) - Number(display.value);
        } else if(cal == 'x')
        {
            prevNum = Number(prevNum) * Number(display.value);
        } else if(cal == '/')
        {
            prevNum = Number(prevNum) / Number(display.value);
        }

        flag = 1;
        cal = '+';
        
        console.log("+ : flag = 1, cal = '+' ");
        console.log("prevNum = " + prevNum);
    }

    function doMinus()
    {
        if(cal == '+' || cal == "")
        {
            prevNum += Number(display.value);
        } else if(cal == '-')
        {
            prevNum = Number(prevNum) - Number(display.value);
        } else if(cal == 'x')
        {
            prevNum = Number(prevNum) * Number(display.value);
        } else if(cal == '/')
        {
            prevNum = Number(prevNum) / Number(display.value);
        }

        flag = 1;
        cal = '-';

        console.log("- : flag = 1, cal = '-' ");
        console.log("prevNum = " + prevNum);
    }

    function doProduct()
    {
        if(cal == '+' || cal == "")
        {
            prevNum += Number(display.value);
        } else if(cal == '-')
        {
            prevNum = Number(prevNum) - Number(display.value);
        } else if(cal == 'x')
        {
            prevNum = Number(prevNum) * Number(display.value);
        } else if(cal == '/')
        {
            prevNum = Number(prevNum) / Number(display.value);
        }

        flag = 1;
        cal = 'x';

        console.log("x : flag = 1, cal = 'x'");
        console.log("prevNum = " + prevNum);
    }

    function doDivide()
    {
        if(cal == '+' || cal == "")
        {
            prevNum += Number(display.value);
        } else if(cal == '-')
        {
            prevNum = Number(prevNum) - Number(display.value);
        } else if(cal == 'x')
        {
            prevNum = Number(prevNum) * Number(display.value);
        } else if(cal == '/')
        {
            prevNum = Number(prevNum) / Number(display.value);
        }

        flag = 1;
        cal = '/';

        console.log("/ : flag = 1, cal = '/'");
        console.log("prevNum = " + prevNum);
    }

    function doEqual()
    {
        var result;

        if(cal == '+')
        {
            result = Number(prevNum) + Number(display.value);
            console.log("result = " + prevNum + " + " + display.value + " = " + result);
        } else if(cal == '-')
        {
            result = Number(prevNum) - Number(display.value);
            console.log("result = " + prevNum + " - " + display.value + " = " + result);
        } else if(cal == 'x')
        {
            result = Number(prevNum) * Number(display.value);
            console.log("result = " + prevNum + " * " + display.value + " = " + result);
        } else if(cal == '/')
        {
            result = Number(prevNum) / Number(display.value);
            console.log("result = " + prevNum + " / " + display.value + " = " + result);
        }
        display.value = result;
        
    }

    function doCE()
    {
        display.value = 0;
        flag = 0;
        prevNum = 0;
        cal = "";
        console.log("CE : all set 0")
    }
</script>

<div class="row mt-5">
    <div class="col-8">
        <input type="text" class="form-control text-end fw-bold" id="display" value="0" readonly>
    </div>
    <div class="col"></div>
</div>

<div class="row">
    <div class="col-2">
        <button type="button" class="btn btn-secondary form-control" id="btn1" onClick="doNum(1)">1</button>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-secondary form-control" id="btn2" onClick="doNum(2)">2</button>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-secondary form-control" id="btn3" onClick="doNum(3)">3</button>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-dark form-control" id="btnPlus" onClick="doPlus()">+</button>
    </div>
    <div class="col"></div>
</div>

<div class="row">
    <div class="col-2">
        <button type="button" class="btn btn-secondary form-control" id="btn4" onClick="doNum(4)">4</button>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-secondary form-control" id="btn5" onClick="doNum(5)">5</button>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-secondary form-control" id="btn6" onClick="doNum(6)">6</button>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-dark form-control" id="btnMinus" onClick="doMinus()">-</button>
    </div>
    <div class="col"></div>
</div>

<div class="row">
    <div class="col-2">
        <button type="button" class="btn btn-secondary form-control" id="btn7" onClick="doNum(7)">7</button>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-secondary form-control" id="btn8" onClick="doNum(8)">8</button>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-secondary form-control" id="btn9" onClick="doNum(9)">9</button>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-dark form-control" id="btnProduct" onClick="doProduct()">x</button>
    </div>
    <div class="col"></div>
</div>

<div class="row">
    <div class="col-2">
        <button type="button" class="btn btn-secondary form-control" id="btn0" onClick="doNum(0)">0</button>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-dark form-control" id="btnDivide" onClick="doDivide()">/</button>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-dark form-control" id="btnEqual" onClick="doEqual()">=</button>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-dark form-control" id="btnCE" onClick="doCE()">CE</button>
    </div>
    <div class="col"></div>
</div>