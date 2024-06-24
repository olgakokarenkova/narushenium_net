<?php 
	// старт сессии
	session_start ();
	// подключаем файл проверки прав пользователя 
	include ("include/auth.php"); 
	// подключаем файл соединения с базой данной
	include ("connect.php"); 
	// подключаем сервисные функции
	include ("service/func.php");	
?>
<!-- файл хедера -->
<?php	include ("include/header.php"); ?>

	<main>
		<div class="content">
			
			<div class="heading">Ваши заявки</div>
			<!-- вызов фильтрации заявок по статусу -->
			<nav class="filtration">
				<!-- подпишем на onclick js-функцию fn_app_filtration  для управления отображением заявок -->
				<a onclick="fn_app_filtration ('Новая')">Новые</a> |
				<a onclick="fn_app_filtration ('Решена')">Решённые</a> |
				<a onclick="fn_app_filtration ('Отклонена')">Отклонённые</a> |
				<a onclick="fn_app_filtration ()">Все</a>
			</nav>
			<!-- заявки пользователя -->
			<div class="container">
				<!-- вывод заявок пользователя -->
				<!-- вызываем функцию из файла service/func.php -->
				<?php print (fnGetApplicationsUser ($_GET["uid"])); ?>
				<!-- блок вывода сообщения об отсутствии заявок фильтрации -->
				<div id="mess"></div>
			</div>
				<!-- подключаем форму подачи заявки -->
				<?php include ("include/form_app.php"); ?>
		</div>
	</main>

<!-- подключение файла футера -->
<?php include ("include/footer.php"); ?>