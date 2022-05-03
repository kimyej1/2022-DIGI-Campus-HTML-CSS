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
        $.ajax({ 
            url : '52ajaxServer.php',
            data : param,
            type : 'POST',
            cache : false,
            success : function(data){
                // alert(data);
                $('#result').html(data);
            }
        });
    }
</script>