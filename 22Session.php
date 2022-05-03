<?php
	session_save_path("./sess"); /* sess 폴더에 session을 다 저장해줘 */
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
		<link rel="icon" type="image/png" href="./images/kblogo.png" sizes="96x96"> <!--웹 탭에 이미지 넣기-->
 		<link href="./css/Style.css" rel="stylesheet" type="text/css">  
 		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
 		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> 
              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
 		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> 
 	</head> 
<body>

	<div class="container">
		<div class="row">
			<?php
				if(isset($_SESSION[$sessId])) /* session파일에 session id가 있어?(로그인 됐어?) 있으면~ */
				{
					?> <!--프로그램 잠시 닫아-->
					<script> /* php안에서 하면 echo안처럼 키워드가 시각적으로 보이지 않아서.. 잠깐 닫아둠 */
						function goLogout()
						{
							location.href="logout.php"
						}
					</script>
					<?php

					echo "
					<div class=\"col text-end\">
						<span class='text-primary fw-bold'>$_SESSION[$sessName]</span> 님 반갑습니다.
						<button type='button' class='btn btn-primary' onClick=goLogout()>Logout</button>
					</div>
					"; /* 큰따옴표는 에코의 짝이 아니야 -> \"로 표기, 또는 작은따옴표로 표기*/

				} else /* 로그인 안되어있으면~ */
				{
					?>

					<form method="post" action="login.php">
						<div class="col text-end">
							<input type="text" name="id" placeholder="ID">
							<input type="password" name="pw" placeholder="비밀번호">
							<button type="submit" class="btn btn-primary">로그인</button>
						</div>
					</form>

					<?php
				}
			?>
		</div>

		<div class="row">
			<div class="col-2">지역선택</div>
			<div class="col">
				<select name="area" class="form-control">
					<?php
						$areaList = "서울,경기,인천,충남,충북,전남,전북,경남,경북,강원,제주,부산,울산";
						$splitArea = explode(",", $areaList);
						/*
							하나씩 option value 지정하기 귀찮으니까..split으로....
							$splitArea[0] = 서울
								      [1] = 경기 ... 이렇게 쪼개짐
						*/

						$cnt=0;

						while(isset($splitArea[$cnt])) /* cnt번째 splitArea가 있냐? -> 없으면 빠져나감 */
						{
							if($cnt == 5)
								$mark = "selected"; /* splitArea[5]인 6번째값이 selected */
							else
								$mark = "";
							echo "<option value'$cnt' $mark>$splitArea[$cnt]</option>";
							$cnt++;
						}
					?>
				</select>
			</div>
		</div>

		<form method="post" enctype="multipart/form-data" action="23File.php">
		<!-- enctype = "multipart/form-data"가 있어야 파일 이름뿐만 아니라 파일도 같이 전달됨 (★외우기★) -->
			<div class="row">
				<div class="col-2">파일</div>
				<div class="col">
					<input type="file" name="upfile" class="form-control">
				</div>
				<div class="col-2">
					<button type="submit" name="submit" class="btn btn-primary">업로드</button>
				</div>
			</div>
		</form>

		회원가입form : 아이디, 이름<br>
		ㅇ 로그인 되어있으면.. 값을 써주고, 맨 마지막 버튼을 빨간색으로 '수정'<br>
		ㅇ 로그인 안되어있으면.. 빈값으로 보여주고, 파란색으로 '등록'<br><br>
		<!-- if/else로 변수를 만들어 사용하면, 나중에 코드 수정이 쉽다!! -->
		
		<!-- 연습 1 --> 
		<?php
				if(isset($_SESSION[$sessName]))
				{
					$btnValue = "수정";
					$color = "danger";
					$joinName = $_SESSION[$sessName];
					$joinId = $_SESSION[$sessId];
				}else
				{
					$btnValue = "등록";
					$color = "primary";
					$joinName = "";
					$joinId = "";

				}
		?>

				<div class="row">
					<div class='col'>
						<h5 class="text-dark fw-bold">정보 <?php echo "$btnValue";?></h5>
						<input type="text" name="name" placeholder="<?php echo "$btnValue";?>할 이름" value="<?php echo "$joinName";?>">
						<input type="text" name="id" placeholder="<?php echo "$btnValue";?>할 ID" value="<?php echo "$joinId";?>">
						<button type="button" class='btn btn-<?php echo "$color";?>'><?php echo "$btnValue";?></button>
					</div>
				</div>

		<!-- 연습 2 --> 
		<?php
			if (isset($_SESSION[$sessId]))
			{
				$btnValue="수정";
				$joinName=$_SESSION[$sessName];
				$joinId = $_SESSION[$sessId];
				$btnColor = "danger";
			} else
			{
				$btnValue="등록";
				$joinName="";
				$joinId="";
				$btnColor="primary";
			}

		?>

		<div class="row">
			<div class="col">
				<h5 class="fw-bold"> 정보 <?php echo $btnValue; ?></h5>
				<input type="text" name="name" placeholder="<?php echo "$btnValue"."할 이름";?>" value="<?php echo $joinName;?>">
				<input type="text" name="id" placeholder="<?php echo "$btnValue"."할 ID";?>" value="<?php echo $joinId;?>">
				<button type="button" class="btn btn-<?php echo $btnColor; ?>"><?php echo $btnValue;?></button>
			</div>
		</div>


		HTML 영역입니다.<br><br>

		<?php /* php 쓰면 프로그래밍 가능(100번 반복 등) */
			echo "PHP 영역입니다.<br>"; /* echo : print 함수 */
			
			for($i=1; $i<=10; $i++) /* java와 문법 같음. $ : 변수 앞에 붙여주면 type 알아서 지정 */
			{
				echo "$i 번째 <br>";
			}

			echo "confTest = $confTest<br>";
			/* confTest는 config.php에 있는 변수지만, include 했기 때문에 불러올 수 있음! */
		?>

	</div>
</body> 
</html> 