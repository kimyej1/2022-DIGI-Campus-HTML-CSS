<?php

	session_save_path("./sess");
	session_start();

	include "config.php";
?>
<!doctype html> 
<html lang="ko"> 
	<head> 
		<meta charset="UTF-8"> 
 		<title>국민은행</title> 
 		<meta name="viewport" 
 			content="width=device-width, maximum-scale=3.0, user-scalable=yes"> 
		<link rel="icon" type="image/png" href="./data/img/kb32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="./data/img/kb16.png" sizes="16x16">
	    <link rel="icon" type="image/png" href="./data/img/kb96.png" sizes="96x96">
 		<link href="./css/Style.css" rel="stylesheet" type="text/css">  
 		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
 		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> 
              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
 		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> 
 	</head> 
<body >

	<div class="container">
		<div class="row">
			<div class="col">
				파일 업로드 확인<br>

				<?php
					$targetDir = "data/upload/";
					$file = $targetDir .basename($_FILES["upfile"]["name"]); /* 이름이 중복되든말든 덮어쓸거야 */
					echo "file = $file <br>";
					/* $file : 폴더를 포함한 파일 이름 */

					if(isset($_POST["submit"])) /* submit으로 온 데이터인지 먼저 확인(이상한 방법 차단) */
					{
						echo "XXX1<br>";
						$check = getImageSize($_FILES["upfile"]["tmp_name"]);
						/* tmp 디렉토리에 파일 tmp name으로 하나 올림(서버에 임시로 하나 복사해둠 -> 알아서 지움)
						   이미지 사이즈를 check라는 변수에 넣음(나중에 쓸 수도 있어서 만들어둠) */
						
						if(move_uploaded_file($_FILES["upfile"]["tmp_name"], $file))
						/* 임시파일을 옮겨(move) -> 'data/upload/내가 정한 파일이름' 으로 이름 바꾸면서 옮겨줘 */
						{
							$tmp_name = $_FILES["upfile"]["tmp_name"];
							echo "tmp_name = $tmp_name";

							echo "
							<img src='$file' class='img-fluid'>
							<button type='button' class='btn btn-primary' onClick=\"location.href='22Session.php'\">등록화면</button>
							";
						}
					} else
					{
						echo "XXX2<br>";
					}

					
				?>

			</div>
		</row>
	</div>
</body> 
</html> 