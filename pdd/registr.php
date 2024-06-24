<?php
	// cтарт сессии
	session_start();	
	// подключение файла соединения с базой данной
	include ("connect.php"); 
	// подключаем сервисные функции
	include ("service/func.php");
?>
<!-- подключение файла Хедера --> 
<?php include ("include/header.php"); ?>
<main onload="onload_page()">
		<div class="content">

			<?php 
				// подключаем формы
				if (!isset($_SESSION["user_id"] )) {
					include ("include/form_reg.php");
				}
			?>

		</div>
	</main>

<!-- подключение файла Футера -->
<?php include ("include/footer.php") ?>