<div class="heading">Создать заявку</div>

<!-- форма создания заявки -->
<form enctype="multipart/form-data" action="service/add-application.php?uid=<?php print ($_SESSION['user_id']); ?>" method="POST" onsubmit="return fn_app_add();">
	
	<!-- название заявки -->
	<p class="error" id="title"></p>
	<input type="text" placeholder="Номер автомобиля" name="title">

	<!-- описание заявки -->
	<p class="error" id="description"></p>
	<textarea name="description" placeholder="Описание нарушения"></textarea>

	<!-- кнопка отправки данных скрипту -->
	<input type="submit" value="Создать заявку">
</form>