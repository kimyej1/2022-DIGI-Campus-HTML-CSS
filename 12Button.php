<!doctype html> 
<html lang="ko"> 
	<head> 
		<meta charset="UTF-8"> 
 		<title>국민은행</title> 
 		<meta name="viewport" 
 			content="width=device-width, maximum-scale=3.0, user-scalable=yes"> 
 		<link href="./css/Style.css" rel="stylesheet" type="text/css">  
 		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
 		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> 
              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
 		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> 
 	</head> 
<body>

<div class="container"> <!--Container-->
    <div class="row">
        <div class="col">
            <h4 class="text-primary">
                <span class="material-icons icon">photo</span>Button</h4> 
        </div>
    </div>
   
    <div class="row">
        <div class="col">
            Button의 핵심 : btn<br>
            해야할 일 : 색상, 사이즈<br>
            종류(type) : submit(다음 화면으로 data 전달), button(단순 모양)
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary">KBSTAR</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-outline-primary">KBSTAR</button>
            <!--outline : outline에만 색 있다가, 마우스오버 하면 색 채워짐-->
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary btn-sm">KBSTAR</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary btn-sm">
                <span class="material-icons icon">settings</span>
                KBSTAR</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary btn-sm form-control"> <!-- form control : 가로영역 꽉 채우기-->
                <span class="material-icons icon">settings</span>
                KBSTAR</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="https://kbstar.com" class="btn btn-primary text-white">KB국민은행</a>
            <!-- a href 링크로 클래스 이용해서 버튼모양 만들수도 있는데, type btn이 아니어서 텍스트 색상이 자동으로 안바뀜, 따로 바꿔줘야함-->
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary btn-sm form-control">
                <span class="material-icons icon">settings</span>
                <span class="d-none d-md-inline-block">KBSTAR</span></button> <!--화면 작을 땐 아이콘만 보이고, md부터는 글자도 보임-->
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary btn-sm form-control" disabled>
                <span class="material-icons icon">settings</span>
                KBSTAR</button>
        </div>
    </div>
</div> <!--Container-->
</body> 
</html> 