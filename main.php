<?php

	session_save_path("./sess");
	session_start();

	include "config.php";
	include "db.php";

	date_default_timezone_set("Asia/Seoul"); // 한국 시간대!
	$conn = connectDB();

	function getNow()
	{
		return date("YmdHis");
	}

	if(!isset($_SESSION[$sessTime])) // 처음 접속했을 땐 sessTime이 없다
	{
		$_SESSION[$sessTime] = getNow(); // 현재시간을 넣어줘~
	}

	//phpinfo();


	$ip = $_SERVER["REMOTE_ADDR"];
	if(!isset($_GET["cmd"]))
		$pcmd = "";		// param cmd (cmd 이름 겹칠까봐)
	else
		$pcmd = $_GET["cmd"];

	$uri = $_SERVER["REQUEST_URI"];

	// 85log.php
	// 1분전~지금 사이에 일정 횟수 이상 접속 시도한 IP 걸러내기
	$sql = "SELECT ADDDATE(now(), INTERVAL -1 MINUTE) AS checktime";
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_array($result);
	$checktime = $data["checktime"];

	$sql = "SELECT count(*) AS ipcount FROM log_table WHERE time>'$checktime' and ip='$ip'";
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_array($result);

	echo "1분 내 클릭 횟수 : ".$data["ipcount"]."<br>";

	// if($data["ipcount"] > 10)
	// {
	// 	// brute force attack 막기
	// 	echo "
	// 		<script>
	// 			location.href='http://warning.or.kr';
	// 		</script>
	// 	";
	// }

	$sql = "INSERT INTO log_table (ip, cmd, uri, time) VALUES ('$ip', '$pcmd', '$uri', now() )";
	$result = mysqli_query($conn, $sql);

?>

<!doctype html> 
<html lang="ko"> 
	<head> 
		<meta charset="UTF-8"> 
 		<title>🌱 국민은행</title> 
 		<meta name="viewport" 
 			content="width=device-width, maximum-scale=3.0, user-scalable=yes"> 
		<link rel="icon" type="image/png" href="./images/kblogo.png" sizes="96x96"> <!--웹 탭에 이미지 넣기-->
 		<link href="./css/Style.css" rel="stylesheet" type="text/css">  
 		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
 		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> 
              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
 		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> 

		 <!-- 여기서 script 작업해도됨! (js끼리 폴더 모아두면 나중에 편함) -->
		<script src="js/kbstar.js"></script>

		<script> // jQuery : p태그 클릭하면 hide해라
			$(document).ready(function(){
				$("p").click(function(){
					$(this).hide();
				});
			});
		</script>

 	</head> 
<body>

	<script>
		// helloKbstar();
		
		var i=3;
		console.log("Hello World : " + i); // 개발자모드(소스보기) 콘솔창에서 확인할 수 있음
		// 중간중간 오류 체크할때 화면에 뿌릴 수 없으니, 콘솔창에 출력해서 확인!
	</script>

	<div class="container">
		<div class="row">
			<div class="col">
				<img src="./data/img/wallpaper2.png" class="img-fluid">
			</div>
		</div>
		<div class="row">
			<div class="col">
				<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
					<div class="container">
						<a class="navbar-brand" href="main.php">
							<span class="material-icons icon">home</span>
						</a>
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuBar">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="menuBar">
							<ul class="navbar-nav">
								<li class="nav-item dropdown ms-3"> <!--ms-3 : left margin을 줘서 왼쪽 메뉴(홈)이랑 좀 간격 떨어지게-->
									<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">HTML</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="./main.php?cmd=01">HTML 기초</a></li>
										<!--첫번째 경로는 '?'로, 두번째부터는 '&'로 경로/정보(=쿼리Query) 제공-->
										<li><a class="dropdown-item" href="./main.php?cmd=02Form">Form</a></li>
										<li><a class="dropdown-item" href="./main.php?cmd=03Style">Stylesheet</a></li>
									</ul>
								</li>

								<li class="nav-item dropdown ms-3">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Bootstrap 5</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="./main.php?cmd=07Grid">Grid</a></li>
										<li><a class="dropdown-item" href="./main.php?cmd=10Color">Color</a></li>
										<li><a class="dropdown-item" href="./main.php?cmd=11Img">Image</a></li>
										<li><a class="dropdown-item" href="./main.php?cmd=13Badge">Badge</a></li>
										<li><a class="dropdown-item" href="./main.php?cmd=15Alert">Alert</a></li>
										<li><a class="dropdown-item" href="./main.php?cmd=16Progress">Progress</a></li>
										<li><a class="dropdown-item" href="./main.php?cmd=20Modal">Modal</a></li>
										<li><a class="dropdown-item" href="./main.php?cmd=21Slide">Slide</a></li>
									</ul>
								</li>

								<li class="nav-item dropdown ms-3">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">JavaScript</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="main.php?cmd=23js">Javascript</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=24js">Variable</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=25if">If</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=26calculator">Calculator</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=27if">If 2</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=28for">For</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=29function">Function</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=30es6">ES6</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=31event">Event</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=32object">Object</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=33constructor">Constructor</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=34array">Array</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=35chart">Google Chart</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=36event">Event(Listener)</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=37editor">WYSIWYG</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=39shopping">Shopping</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=40post">우편번호</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=41browser">Browser</a></li>
									</ul>
								</li>

								<li class="nav-item dropdown ms-3">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">jQuery</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="main.php?cmd=43jquery">jQuery Basic</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=44ajax">Ajax</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=46search">Search</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=48method">Method</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=49crawling">Crawling</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=50db">Database</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=51search">Search</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=53join">Join</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=55preview">Preview</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=57table">Table</a></li>
									</ul>
								</li>

								<li class="nav-item dropdown ms-3">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Database</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="main.php?cmd=58insert">Insert</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=59birth">Birthday</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=60customer">Customer</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=61pi">Pie Chart</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=62donut">Donut Chart</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=63statistics">Statistics</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=64generator">Generator</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=65graph">Graph</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=66generator">Branch</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=68join">Join</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=69model">Model(나이키 쇼핑몰)</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=70list">list(나이키 쇼핑몰)</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=71shopping">shopping(나이키 쇼핑몰)</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=72cart">Cart(나이키 쇼핑몰)</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=73cart">Cart(join1)(나이키 쇼핑몰)</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=74cart">Cart(join2)(나이키 쇼핑몰)</a></li>
									</ul>
								</li>
								<li class="nav-item dropdown ms-3">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Secure</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="main.php?cmd=80upload">File Upload</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=82ftp">FTP</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=83brute">무차별대입(brute forse)</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=84brute">무차별대입 2</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=85log">로그 관리</a></li>
										<li><a class="dropdown-item" href="main.php?cmd=86log">로그 그래프</a></li>
									</ul>
								</li>

								<?php
									if(isset($_SESSION[$sessId]) and $_SESSION[$sessLevel] == $adminLevel)
									{
										?>
											<li class="nav-item dropdown ms-3">
												<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">관리자메뉴</a>
												<ul class="dropdown-menu">
													<li><a class="dropdown-item" href="main.php?cmd=manuser">사용자 관리</a></li>
													<li><a class="dropdown-item" href="#">관리자1</a></li>
													<li><a class="dropdown-item" href="#">관리자2</a></li>
												</ul>
											</li>
										<?php
									}
								?>

							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col text-end">
				<?php

					if(isset($_SESSION[$sessId]))
					{
						?>
						<script>
							function goLogout()
							{
								location.href='main.php?cmd=logout';
							}
						</script>
						<div class="col text-end">
							<span class='text-primary fw-bold'><?php echo "$_SESSION[$sessName]" ?></span> 님 반갑습니다.
							<button type='button' class='btn btn-danger' onClick=goLogout()>Logout</button>
							<button type='button' class='btn btn-outline-danger'>Modify</button>
						</div>	
						<?php
					}else
					{
						?>
						<form method="post" action="main.php?cmd=login"> 
						<div class="col text-end">
							<input type="text" name="id" placeholder="ID를 입력하세요">
							<input type="password" name="pass" placeholder="비밀번호를 입력하세요">
							<button type="submit" class="btn btn-primary">Login</button>
							<button type="button" class="btn btn-outline-primary">Join</button>
						</div>
						</form>

						<?php
					}
				?>
			</div>
		</div>
	</div> <!--container 1-->
	<div class="container" style="min-height:500px;"> <!--내용이 얼마 없어도 영역을 잡아두기 위해 별도 컨테이너로!-->
		<?php
			if(isset($_GET["cmd"])) /* get방식으로 받은 cmd값 있어없어? 처음꺼 타고 들어오면 cmd 없음 -> 무조건 else걸림 */
			{
				$cmd = $_GET["cmd"];

				/* if~else로 하면 경우의 수가 많아질수록 코드가 늘어남 (100개면 100번써야됨)

				if($cmd == "01")
					include "01.html";
				else if($cmd == "02Form")
					include "02Form.html";

				*/	

				if(file_exists("$cmd.php"))
					include "$cmd.php";
				else if(file_exists("admin/$cmd.php")) /* admin(관리자폴더)에만 있는 파일? -> 관리자 파일 모아두면 편함(나중에 파일 너무 많아져서)*/
					include "admin/$cmd.php";
				else if(file_exists("$cmd.html"))
					include "$cmd.html";
				else
					include "error404.php";

			} else 
			{
				include "init.php";
			}
		?>
	</div> <!--container 2-->
	<div class="container-fluid mt-5 mb-5">
		<div class="row border bg-light">
			<div class="col mx-5">
				Copyleft <span class='fw-bold'>김예지</span> | yejikim@kbfg.com<br>서울특별시 영등포구 여의대로 전경련회관 32층 KB국민은행 스타뱅킹부(P)(스뱅2부(고객경험))
			</div>
		</div>
	</div> <!--container 3-->
	
</body> 
</html> 