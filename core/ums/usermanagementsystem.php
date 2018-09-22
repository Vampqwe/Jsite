<?php
	require_once('../config.php');
	require_once('../'.CLASSES.'/autoLoadClass.php');
	$UMS = new JUserManagementSystem();
	$UMS->startSession();
	if ($UMS->getSessUserAcces() == 0) {
		$logAccesDenied = new JFileManagementSystem("logUms.txt", "a");
		$logAccesDenied->fwrite("DATE:".JHelper::getDate().
				" TIME:".JHelper::getTime().
				" Попытка войти не авторизованым!!! "."\n".
				" На страницу:*".JServer::getSelfPage()."*".
				" URL запрос:*".JServer::getQueryStr()."*"."\n");
		unset($logAccesDenied);
	echo "<script> window.location.href='http://site/index.php'; </script>";
	}
	$error = new JErrorManagementSystem();
	$route = new JRoute();
	$route->setPathLink(["UMS" => "usermanagementsystem.php",
	"Сайт" => "http://site/index.php",
	"Выход" => "http://site/index.php?action=exit",
	"Сменить логин" => "usermanagementsystem.php?action=changeLogin",
	"Создать страницу" => "usermanagementsystem.php?action=createMyPage"]);
?>
<!Doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <link href="ums.css" rel="stylesheet">
    <title></title>
    </head>
<body>
	<div id="layotUms">
<?php
	$userRsltUms = $UMS->getSession();
?>
		<div id="headerMenuUms"><?php $route->getLinc("Сайт"); ?></div>
		<div id="headerUms"></div>
		<div id="userPanelUms">
			<table>
				<tr>
					<td colspan="2"><h4>Добро пожаловать!</h4></td>
				</tr>
				<tr>
					<td>Ваш Логин:</td>
					<td><?php echo $userRsltUms['login']; ?></td>
				</tr>
				<tr>
					<td>Ваши монеты:</td>
					<td><?php echo $userRsltUms['coin']; ?></td>
				</tr>
				<tr>
					<td>Ваше звание:</td>
					<td><?php echo $UMS->getSessAccesName(); ?></td>
				</tr>
				<tr>
					<td>Ваша почта:</td>
					<td><?php echo $userRsltUms['mail']; ?></td>
				</tr>
				<tr>
					<td>Ваш IP:</td>
					<td><?php echo $userRsltUms['ip']; ?></td>
				</tr>
				<tr>
					<td>Выйти:</td>
					<td><?php $route->getLinc("Выход"); ?></td>
				</tr>
			</table>
			
		</div>
		<div id="miniPanelUms"></div>
		<div id="leftBlockUms">
			<ul>
				<li><?php $route->getLinc("UMS"); ?></li>
				<li><?php $route->getLinc("Сменить логин"); ?></li>
				<li><?php $route->getLinc("Создать страницу"); ?></li>
			</ul>
		</div>
		<div id="contentUms">
			<?php
			switch (JServer::inputGet('action')) {
				default:
				
				$FMS = new JFileManagementSystem();
				$FMS->setPathNameFile("test.php", "");
				$FMS->createDir();
				$FMS->openFile("a");
				$FMS->writeToFile("<?php echo 'WORK!!!!' ?>");
				echo $FMS->getMimeType()."\n";
				echo $FMS->getModifiedMimeType();
				
				
				echo "<h3>User Management System</h3>
				<h5>Добро пожаловать в систему управления аккаунтом!!!</h5>
				<p>Здесь вы можете сменить данные аккаунта, посмотреть историю ваших коментариев				, посмотреть и отредактировать ваши публикации</p>
				<p>За публикации и другие действия на сайте начисляется опыт
				Регистрация = 100Cn
				Публикация*Зависит от кол-ва голосов* = 1-1500Cn 
				формула: Gprice = 1Cn, Gval = кол-во голосов, Cn/reward == Gprice * Gval
				Комментарий = 50Cn</p>";
				break;
				
				case 'createMyPage';
				echo "<form action = 'usermanagementsystem.php?action=createMyPage' method = 'POST'>
					PageName:<input name = 'pageName' type = 'text'>
					<input name = 'pageNameSub' type = 'submit'>
				</form>";
				$FMS_cmp = new JFileManagementSystem();
				$sessLoginCmp = $UMS->getSession();
				$arrPostCmp = JServer::getPostArr(["pageName" =>"", "pageNameSub" => ""]);
				if (JServer::getMethod() == 'POST' and !empty($arrPostCmp['pageNameSub'])) {
					$FMS_cmp->setPathNameFile($arrPostCmp['pageName'].".php", 
									"user/".$sessLoginCmp['login']."/");
					$FMS_cmp->createDir();
					$FMS_cmp->openFile("w");
					$FMS_cmp->writeToFile("<!Doctype html>
								<html>
    							<head>
    							<meta charset='utf-8'>
    							<link href='mycss.css' rel='stylesheet'>
    							<title></title>
    							</head>
								<body>
								</body>
								</html>
								");
				}	
									
				break;
				
				case "changeLogin":
				$sessLogin = $UMS->getSession();
				$UMS->setUserDt(["login" => $sessLogin['login']]);
				$user = $UMS->getUser();
				echo "<form action = 'usermanagementsystem.php?action=changeLogin' method = 'POST'>
				<table>
				<tr>
					<td>Ваш ник:".$user[0]['login']."</td>
					<td>Сменить на: <input name = 'login' type = 'text'></td>
				</tr>
				<tr>
					<td>Ваiа почта:".$user[0]['mail']."</td>
					<td>Сменить на: <input name = 'mail' type = 'text'></td>
				</tr>
				<tr>
					<td><input name = 'newDtSub' type = 'submit'></td>
				</tr>
				</table>
				</form>";
				$r = JServer::getPostArr(["login" => "", "mail" => "", "newDtSub" => ""]);
				if (JServer::getMethod() == 'POST' and !empty(JServer::inputPost('newDtSub'))) {
					$sql = "UPDATE `user` 
							SET `login` = '".$r['login']."' 
							WHERE `id` = '".$user['id']."'";
					$db = new JDb();
					$db->dbExec($sql);
				}
				break;
			}
			?>
		</div>
	</div>
</body>
</html>