<div class="container"> <!--Container-->
    <div class="row">
        <div class="col">
            <h4 class="text-primary">
                <span class="material-icons icon">photo</span>Image</h4> <!--class 두개 적용(material icons, icon)-->
        </div>
    </div>
   
    <div class="row">
        <div class="col">
            Image 핵심 : img-fluid 반응형으로 된다.<br>
            1. 이미지가 내가 사용할 수 있는 공간보다 클 때, 자동으로 줄여준다.<br>
            2. 이미지가 공간보다 작을 때, 원본을 보여준다.<br>
            3. rounded 클래스를 함께 쓰면, 각지지 않고 둥근 모양으로 끝 처리를 해준다.<br>
        </div>
    </div>
    <div class="row">
        <div class="col-1">
            <img src="./images/paris.jpeg">
        </div>
    </div>
    <div class="row">
        <div class="col-1">
            <img src="./images/paris.jpeg" class="img-fluid">
        </div>
        <div class="col-1">
            <img src="./images/paris.jpeg" class="img-fluid rounded">
        </div>
        <div class="col-1">
            <img src="./images/paris.jpeg" class="img-fluid rounded-circle">
        </div>
        <div class="col-1">
            <img src="./images/paris.jpeg" class="img-thumbnail">
        </div>
        <div class="col-2">
            <img src="./images/paris.jpeg" class="img-fluid rounded">
        </div>
    </div>

    <div class="row">
        <div class="col">
            <img src="./images/paris.jpeg" class="img-fluid rounded float-start"> <!--이미지 좌측정렬-->
            <img src="./images/paris.jpeg" class="img-fluid rounded float-end"> <!--이미지 우측정렬-->
        </div>
    </div>
</div> <!--Container-->