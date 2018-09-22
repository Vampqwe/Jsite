<?php
	require_once('core/config.php');
	require_once(CORE_CLASS.'/autoLoadClass.php');
	include("core/lib/dBug-master/dBug.php");
	$UMS = new JUserManagementSystem();
	$UMS->startSession();
	$category = [
		"bp" => "upload/book/programming/",
		"bf" => "upload/book/fantastic/",
		"bd" => "upload/book/detective/",
		"ia" => "upload/image/apocalipse/",
		"in" => "upload/image/nature/",
		"ic" => "upload/image/cosmos/",
		];
	$d = new dBug($category, "string");
	//$d->makeTableHeader("xcvcgfdg", "header", "5");
	$d->initJSandCSS();
	if (JServer::getMethod() == 'GET' and JServer::inputGet('action') == 'exit') {
		$UMS->stopSession();
		echo "<script> window.location.href='http://site/index.php'; </script>";
	}
	$pageError = new JErrorManagementSystem();
?>
<!Doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet">
    <title></title>
    </head>
<body>
<!--I am body!-->
    <div id="mainLayot">
    <!--<a href = 'index.php?action=exit'>Выйти</a>-->
    <!--I am mainLayot!-->
        <div id="menuHeader">
            <a class="lincMain" title="Главная страница!" href="index.php"><img src="img/icons8-главная-50.png"></a>
            <ul class="ulMenuHeader">
                <li><a href="">Книги</a></li>
                <li><a href="">Фильмы</a></li>
                 <li><a href="">Игры</a></li>
                 <li><a href="">Картинки</a></li>
                <li><a href="">Дневники</a></li>
            </ul>
            <?php
        	if ($UMS->getSessUserAcces() <= 0) {
				echo "<table class='tableUserPanel'>
  					<tr>
    					<td><a href = 'core/ums/authums.php'>Вход-Регистрация</a></td>
  					</tr>
					</table>";
			}else{
				$sessRslt = $UMS->getSession();
				echo ("<table class='tableUserPanel'>
  					<tr>
    					<td>Добро пожаловать!:</td>
    					<td><a href = 'core/ums/usermanagementsystem.php'> '".$sessRslt['login']."'</a></td>
    					<td>".$UMS->getSessAccesName()."</td>
    					<td><a href = 'index.php?action=exit'>Выйти</a></td>
  					</tr>
					</table>");
			}
        	?>
            <!--<form class="formSearch" action="" method="">
            	<label>Поиск:<input name="inputSearch" type="text" size="40px"></label>
            	<input name="subSearch" type="submit">
            </form>-->
        </div>
        <div id="systemPanel">	
		</div>
        <div id="category"></div>
        <div id="content"><?php 
        
         ?></div>
        <div id="footer"></div>
                
	</div>
</body>
</html>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			