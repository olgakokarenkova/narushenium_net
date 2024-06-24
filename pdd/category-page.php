<?php 
	// cтарт сессии
	session_start ();
	// подключаем файл проверки прав пользователя 
	include ("include/auth.php"); 
	// подключаем файл соединения с базой данной
	include ("connect.php"); 
	// подключаем сервисные функции
	include ("service/func.php");	

 	// так как action форм из файла form_cat указывает на самого себя
 	// то и ловим формы в этом же файле 
 	if (isset ($_POST["category"])) {
 		// вызываем функции из файла service/func.php
 		fnAddCategoryApplications ();
 	};

 	if (isset($_POST["cat_id"])) {
 		fnDeleteCategoryApplications ();
 	};

?>

<!-- подключение файла Хедера -->
<?php include ("include/header.php"); ?>

<main>
	<!-- вывод форм управления категориями -->
	<div class="content"> <?php include ("include/form_cat.php"); ?></div>
</main>

<!-- подключение файла Футера -->
<?php include ("include/footer.php") ?>