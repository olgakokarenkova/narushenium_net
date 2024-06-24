<!DOCTYPE html>
<html lang=ru>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Demo 2021</title>
		<!-- подключение файла стилей -->
		<link rel="stylesheet" href="./css/style.css">
		<!-- подключение файлов скриптов -->
		<!-- для удобства скрипты вынесены в отдельные файлы -->
		<!-- скрипт носит имя файла в котором используется -->
		<script src="./script/index.js"></script>
		<script src="./script/personal-cabinet.js"></script>
		<script src="./script/admin.js"></script>
	</head>
	<body>
	<header class="header">
	<a class="header-text-left" href="index.php">
			<span class="header-txt-left">НАРУШЕНИЯМ.НЕТ</span>
			<span class="header-txt-left">Безопасность Уважение Надежность</span>
		</a>
		<div class="logo1"></div>
		<div class="header-text-right">
			<div class="header-img-right"></div>
			<span class="header-txt-right">всегда на связи</span>
		</div>
	</header>


	

		<!-- logo сайта -->
		
		<header>
			<div class="content">
				<!-- подключение файла меню -->
				<?php include ("menu.php"); ?>
			</div>
		</header>
		<div class="message">
			<!-- вывод сообщений о действиях пользователя (в случае его наличия) -->
			<?php if (isset ($_GET["message"])) print ($_GET["message"]); ?>
		</div>