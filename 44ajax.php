<div class='row'>
    <div class='col'>
        <input type='text' name='key' id='key' class='form-control' onKeyUp='instanceSearch()'>
    </div>
</div>

<div class='row'>
    <div class='col'>
        <div id='result'></div>
    </div>
</div>

<script>
    function instanceSearch()
    {
        // 입력할 때마다 서버와 통신하며 (중복아이디 여부는 서버에 물어봐야만 알 수 있음..)
        // 4-10글자이면 '가능한 아이디입니다.' 아니면, '4-10글자를 입력하세요.' 출력

        let key = document.querySelector('#key').value;
        let result = document.querySelector('#result');

        let param = 'key=' + key;
        $.ajax({ // {}을 쓴다 = 여러줄을 쓰겠다
            url : '45ajaxServer.php',
            data : param,
            type : 'POST',
            cache : false,
            success : function(data){
                // alert(data);
                $('#result').html(data);
            }
        });

        // 45ajaxServer.php?key=키보드입력 -> 이렇게 서버에 물어보고 중복아이디 체크하고싶어


        /*
        let regex = /^[a-zA-Z0-9]{4,10}$/;
        if(!regex.test(key))
        {
            result.className = 'text-danger';
            result.innerHTML = '4-10글자 사이의 영문,숫자만 가능합니다.';
        } else
        {
            result.className = 'text-success';
            result.innerHTML = '가능한 아이디입니다.';
        }
        */
        /*
            if(key.length >= 4 && key.length <= 10)
            {
                result.className = 'text-success';
                result.innerHTML = '가능한 아이디입니다.';
            } else
            {
                result.className = 'text-danger';
                result.innerHTML = '4-10글자를 입력하세요.';
            }
        */
    }
</script>