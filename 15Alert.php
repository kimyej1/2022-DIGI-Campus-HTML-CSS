<script>
    alert('JS alert');
</script>

<div class="container"> <!--Container-->
    <div class="row">
        <div class="col">
            <h4 class="text-primary">
                <span class="material-icons icon">alarm_on</span>Alert</h4> 

                alert : '확인'만 있는 알림창<br>
                confirm : '확인'과 '취소'가 있는 알림창
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="alert alert-danger">
                <strong>Error : </strong> 데이터가 존재하지 않습니다.<br>
                대분류를 먼저 선택하세요. <!--alert 은 디폴트가 좌우 꽉채운 형태, 그게 아니면 col 조정 따로 필요!-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="alert alert-primary">
                <strong>Error : </strong> 데이터가 존재하지 않습니다.<br>
                대분류를 먼저 선택하세요.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="alert bg-danger text-white"> 
                <!--alert 은 색에 기본 알파값(투명도)가 있는데, bg로 하면 완전 불투명-->
                <strong>Error : </strong> 데이터가 존재하지 않습니다.<br>
                대분류를 먼저 선택하세요.
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="btn-group">
                <button type="button" class="btn btn-secondary">Apple</button>
                <button type="button" class="btn btn-secondary">Samsung</button>
                <div class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Sony</button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Tablet</a>
                    <a class="dropdown-item" href="#">Smartphone</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
    
</div> <!--Container-->