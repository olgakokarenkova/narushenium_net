<?php
	// cтарт сессии
	session_start ();
	// подключаем файл проверки прав пользователя 
	include ("include/auth.php"); 
	// подключаем файл соединения с базой данной
	include ("connect.php"); 
	// подключаем сервисные функции
	include ("service/func.php");	
?>
<!-- файл Хедера -->
<?php	include ("include/header.php"); ?>

	<main>
		<div class="content">
			
			<div class="heading">Новые заявки</div>
			<!-- Меню для перехода на страницу создания и удаления категорий -->
			<nav class="category"> <a href="./category-page.php?uid=<?= $_SESSION['user_id']; ?>">Категории</a> </nav>
			
			<!-- блок вывода -Новые заявки -->
			<div class="container">
				<!-- вызываем функцию из файла service/func.php -->
				<!-- передаваемый параметр определяет выводимые заявки -->
				<?php print (fnGetAdminApplications ('new')); ?>
			</div>

			<div class="heading">Решённые заявки</div>
			<!-- блок вывода -Решённые заявки -->
			<div class="container">
				<?php print (fnGetAdminApplications ('resolved')); ?>
			</div>

			<div class="heading">Отклонённые заявки</div>
			<!-- блок вывода -Отклонённые заявки -->
			<div class="container">
				<?php print (fnGetAdminApplications ('rejected')); ?>
			</div>

		</div>
	</main>

	<!--пользователю понадобится его uid из сессии когда он будет генерировать формы -Решить / -Отклонить
	чтобы не поднимать Cookie передадим uid через скрипт
	этот костыль работает ))-->	
	<?php printf ("<script>var id=%d</script>", $_SESSION["user_id"]); ?>

<!-- подключаем файла Футера -->
<?php require ("include/footer.php"); ?>