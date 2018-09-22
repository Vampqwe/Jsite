<?php
	require_once('../config.php');
	require_once('../'.CLASSES.'/autoLoadClass.php');
	$UMS = new JUserManagementSystem();
	$UMS->startSession();
	if ($UMS->getSessUserAcces() > 0) {
	echo "<script> window.location.href='http://site/index.php'; </script>";
	}
	$pageError = new JErrorManagementSystem();
	$pageError->dmp($UMS->getPregRepDt());
?>
<!Doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <link href="ums.css" rel="stylesheet">
    <script src="../js/compressed jQuery 3.3.1.js"></script>
    <title></title>
    </head>
<body>
<div id="layotAuthUms">
	<div id="registration">
		<div id="regImg">
		<h2>Регистрация!</h2></div>
		<form name="regForm" action="authums.php" method="POST">
			<ul>
				<li><label>Логин:<input name="login" type="text"></label></li>
				 <li><label>Пароль:<input name="password" type="password"></label></li>
				 <li><label>Повтор:<input name="passRpt" type="password"></label></li>
				 <li><label>Почта:<input name="mail" type="text"></label></li>
				 <li><input name="regSub" type="submit"/></li>
			</ul>
		</form>
<?php
		
if (JServer::getMethod() == 'POST' and !empty(JServer::inputPost('regSub'))) {
	$regUserDt = JServer::getPostArr(["login" => "", 
								"password" => "", 
								"passRpt" => "", 
								"mail" => FILTER_VALIDATE_EMAIL ]);
	$UMS->setUserDt($regUserDt);
	if (empty($regUserDt['login']) or strlen($regUserDt['login']) < MIN_SIZE_LOGIN) {
		$pageError->setNumberError("!_REGx0L_",MIN_SIZE_LOGIN);
	}elseif (empty($regUserDt['password']) or strlen($regUserDt['password']) < MIN_SIZE_PASS) {
		$pageError->setNumberError("!_REGx0P_",MIN_SIZE_PASS);
	}elseif (!$UMS->passCompare()){
		$pageError->setNumberError("!_REGx1P_");
	}elseif ($UMS->userExist()) {
		$pageError->setNumberError("!_REGDBx0_");
	}elseif (!$regUserDt['mail']) {
		$pageError->setNumberError("!_REGx0M_");
	}else{
		$UMS->getHashUserPass();
		$UMS->regUser();
	}
	$pageError->getErrorMsg();		
}
?>
	</div>
	
	<div id="authorization">
		<img src="img/icons8-пароль-50.png">
        <form name="authorization" class="formAuth" action="authums.php" method="POST">
        <h4>Войти на сайт!</h4>
        	<ul>
            	<li><label>Логин:<input name="login" type="text" value="Введите Логин"></label></li>
           		<li><label>Пароль:<input name="password" type="password" value="Введите Пароль"></label></li>
            	<li><input name="authSub" type="submit"></li>
            </ul>
        	</form>
        <ul class="ulLincReg">
            <li><a href="">Забыли_пароль?</a></li>
        </ul>
        
<?php
	if (JServer::getMethod() == 'POST' and !empty(JServer::inputPost('authSub'))) {
        $authUserDt = JServer::getPostArr(["login" => "", "password" => "" ]);
        $UMS->setUserDt($authUserDt);
        if (!$UMS->userExist()) {
			$pageError->setNumberError("!_AUTHx0L_");
		}elseif (!$UMS->verifyUserPass()) {
			$pageError->setNumberError("!_AUTHx1P_");
		}else{
			$UMS->authUser();
			echo "<script> window.location.href='http://site/index.php'; </script>";
		}
			$pageError->getErrorMsg();
	}
?>
    </div>
    <?php $pageError->dmp(); ?>
</div>
</body>
</html>