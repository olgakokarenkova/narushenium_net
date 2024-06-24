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
<!-- ОСНОВНАЯ ЧАСТЬ СТРАНИЦЫ -->
<div class="osn-stranica">
	

	<!-- левая часть странцы -->
	<div class="left">
		<div class="priziv">
			<span class="priziv-text">Вы можете составить заявление, указав номер автомобиля и описав нарушение</span>
			<span class="priziv-text">Заметили нарушение? </span>
			<a href="avtor.php" class="priziv-button">Оставить заявку</a>
		</div>
		<div class="o-rabote">
			<div class="o-rabote-img"></div>
			<span class="o-rabote-text">На сайте ГИБДД можно проверить штрафы, водителя перед приемом на работу и машину перед покупкой. Рассказываем, как это сделать, какие документы понадобятся для проверки и что выяснить на сайте инспекции не выйдет.</span>
		</div>			
	</div>

	<!-- правая часть страницы -->
	<div class="right">

		<!-- номера помощи -->
		<div class="help-numbers">
			<span class="help-numbers-text">+7 (495) 688-81-71</span>
			<span class="help-numbers-text">+7 (495) 688-64-10</span>
			<span class="help-numbers-text">ДЕЖУРНАЯ ЧАСТЬ:</span>
			<span class="help-numbers-text">УГИБДД ГУ МВД РОССИИ ПО МОСКОВСКОЙ ОБЛАСТИ</span>
		</div>

		<!-- статистиика -->
		<div class="statistica">
			<div class="statistica-2">
				<span class="statistica-text">АВАРИЙНОСТЬ НА ДОРОГАХ РОССИИ ЗА 22.10.2023</span>
				<div class="statistica-text-more">
					<div class="left-2">
						<span class="statistica-text">Ранено детей</span>
						<span class="statistica-text">Ранены</span>
						<span class="statistica-text">Погибло детей</span>
						<span class="statistica-text">Погибли</span>
						<span class="statistica-text">Погибли</span>
					</div>
					<div class="right-2">
						<span class="statistica-text-2">35</span>
						<span class="statistica-text-2">328</span>
						<span class="statistica-text-2">3</span>
						<span class="statistica-text-2">42</span>
						<span class="statistica-text-2">264</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<main>
	
</div>		
	<main onload="onload_page()">
		<div class="content">

			<?php 
				// подключаем формы
				if (!isset($_SESSION["user_id"] )) {
					include ("include/form_reg.php");
					include ("include/form_login.php");	
				}
			?>

		</div>
	</main>

<!-- подключение файла Футера -->
<?php include ("include/footer.php") ?>