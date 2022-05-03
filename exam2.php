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
		<link rel="icon" type="image/png" href="./images/kblogo.png" sizes="96x96">
 		<link href="./css/Style.css" rel="stylesheet" type="text/css">  
 		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
 		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> 
              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
 		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> 
 	</head> 
<body>
    <?php

        if(isset($_SESSION[$sessName]))
        {
            ?>
            <div class="row text-center mt-5">
                <div class="col">
                    <?php echo "$_SESSION[$sessName]" ?>님, 반갑습니다.
                    <button type="button" class="btn btn-danger" OnClick="location.href='examLogout.php'">Logout</button>
                </div>
            </div>
            <?php
        } else
        {
            ?>
            <form method="post" action="examLogin.php">
                <div class="row text-center mt-5">
                     <div class="col">
                        <input type="text" name="id" placeholder="ID를 입력하세요.">
                        <input type="password" name="pw" placeholder="비밀번호를 입력하세요.">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </form>
            <?php
        }
    ?>
</body>
</html>