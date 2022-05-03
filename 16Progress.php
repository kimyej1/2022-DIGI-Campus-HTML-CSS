<div class="container"> <!--Container-->
    <div class="row">
        <div class="col">
            <h4 class="text-primary">
                <span class="material-icons icon">alarm_on</span>Progressive Bar</h4> 

                상태 진행 막대기
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="progress">
                <div class="progress-bar" style="width:40%;">40%</div>
                <!--그때그때 진행상황이 달라지니 css로 몇 %인지를 고정하기 어려움-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:70%;">70%</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="progress border"> <!--아웃라인-->
                <div class="progress-bar bg-light text-primary" style="width:40%;">40%</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="progress">
                <div class="progress-bar progress-bar-striped" style="width:40%;">40%</div> <!--사선-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                style="width:40%;">40%</div> <!--움직이는 사선!-->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="spinner-border text-danger"></div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <ul class="pagination justify-content-center"> <!--중앙정렬-->
                <li class="page-item"><a class="page-link" href="#">
                    <span class="material-icons icon">skip_previous</span></a></li>
                    <li class="page-item"><a class="page-link" href="#">
                        <span class="material-icons icon">chevron_left</span></a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                <!--active : 선택된 상태로! -->
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">
                    <span class="material-icons icon">chevron_right</span></a></li>
                <li class="page-item"><a class="page-link" href="#">
                    <span class="material-icons icon">skip_next</span></a></li>
              </ul>
        </div>
    </div>
    
</div> <!--Container-->