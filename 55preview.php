<style>
    .preview_ul {
        margin-top: 0px; /* margin에는 (-) 마이너스 픽셀도 넣을 수 있음 */
        background-color:#FFFFFF;
        max-height:300px;
        overflow-y:auto; /* max-height 넘어가면 자동으로 스크롤 생기게 */
    }
    .preview_li {
        padding-left: 10px;
        /* 손가락 모양 커서 만들기 : hand(X), pointer(O) - pointer를 써야 모든 브라우저에 호환된다. */
        cursor: pointer;
        color: #FFFFFF;
    }
</style>

<div class="row">
    <div class="col">
        <h5 class="text-primary"><span class="material-icons icon">search</span> 검색어 미리보기</h5>
    </div>
</div>

<div class="row">
    <div class="col-2 colLine">검색어</div>
    <div class="col colLine">
        <div class="form-group">
            <input type="text" id="keyword" class="form-control" placeholder="검색어를 입력하세요">
            <div id="keylist" style="width:50%; z-index:1000; background-color:#DFDFDF;"></div> <!--결과값 뿌려줄 자리 만들기-->
            <!-- z-index : (1~1000) 1000일수록 화면 가장 앞에 표시(창을 가장 위로)-->
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){ // 이 문서가 준비가 되면(로딩이 길수도 있으니까)
        // 함수 1
        $("#keyword").on("keyup", function(e){
            let key = $("#keyword").val();
            //alert(key);
            
            if(key !== "")
            {
                $.ajax({
                    url: "56ajaxPreview.php",
                    type: "POST",
                    cache: false,
                    data: {
                        searchKey : key
                    },
                    success: function(rsvData) {
                        $('#keylist').html(rsvData);
                        $('#keylist').fadeIn();
                    }
                })
            }
        });

        // 함수 2
        $(document).on('click', '.preview_li', function(e){
            let selectedKeyword = $(this).text();
            $("#keyword").val(selectedKeyword);
            // val() : 값 읽어오는거
            // val(script) : script를 값에 쓰는거
            $("#keylist").fadeOut("fast");
        });
    });
</script>