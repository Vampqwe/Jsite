<?php
require_once("../core/config.php");
require_once("../core/classes/autoLoadClass.php");
$errorFile = new JErrorManagementSystem();
$category = [
		"bp" => "upload/book/programming/",
		"bf" => "upload/book/fantastic/",
		"bd" => "upload/book/detective/",
		"ia" => "upload/image/apocalipse/",
		"in" => "upload/image/nature/",
		"ic" => "upload/image/cosmos/",
		];

$str = " pathinfo — Возвращает информацию о пути к файлу
readfile — Выводит файл
rename — Переименовывает файл или директорию
rmdir — Удаляет директорию
stat — Возвращает информацию о файле
unlink — Удаляет файл ";
$Ums = new JUserManagementSystem();

JdBug::dmp();
new JdBug($category,0);

//errorFile->dmp("");
$errorFile = new JErrorManagementSystem();
echo ("<a href = 'file.php?id=bp&filename=Andy_Harris_-_PHP_mysql(RUS).rar'>link</a>\n");
$getQuery = JServer::getGetArr(["id" =>"", "filename" => ""]);
$category = [
		"bp" => "upload/book/programming/",
		"bf" => "upload/book/fantastic/",
		"bd" => "upload/book/detective/",
		"ia" => "upload/image/apocalipse/",
		"in" => "upload/image/nature/",
		"ic" => "upload/image/cosmos/",
		];
		
		$FMS_upload = new JFileManagementSystem();
		$countArr = count($category);
		$count = 0;
		foreach ($category as $key => $val) {
			$FMS_upload->setPathNameFile("", $category[$key]=$val);
			if($FMS_upload->existPathFile() == 'ERROR_PATH') {
				$FMS_upload->createDir();
			}
			$count++;
			if ($count == $countArr) {
				return FALSE;
			}
		}
		
		$FMS_upload = new JFileManagementSystem();
		$FMS_upload->setPathNameFile("", "test/");
		if($FMS_upload->existPathFile() == 'ERROR_PATH') {
			$FMS_upload->createDir();
		}else if ($FMS_upload->existPathFile() == 'ERROR_FILE') {
			$FMS_upload->openFile("w");
			echo $FMS_upload->getContentDir();
			$FMS_upload->writeToFile("work!");
		}
		
		echo "0";
		var_dump(gettype(1));
		
		
		
		$errorFile->dmp();
?>
<!Doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet">
    <title></title>
    </head>
<body>
	<div id="layotFile">
		
		<?php
		?>
	</div>
</body>
</html>
<?php
?>