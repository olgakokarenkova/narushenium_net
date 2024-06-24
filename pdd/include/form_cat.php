<div class="heading">Добавить категорию</div>

<!-- добавление категории -->
<form action="?uid= <?php print ($_SESSION['user_id']); ?>" method="POST">
	<!-- название категории -->
	<input type="text" placeholder="Название категории" name="category">
	<!-- кнопка отправления данных формы серверу -->
	<input type="submit" value="Добавить категорию">
</form>

<div class="heading">Удалить категорию</div>
<!-- удаление категории -->
<form action="?uid= <?php print ($_SESSION['user_id']); ?>" method="POST">
	<!-- список существующих категорий -->
	<select name="cat_id">
		<!-- вывод пунктов списка категорий -->
		<!-- вызываем функцию из файла service/func.php -->
		<?php print (fnGetCategoryApplications ()); ?>
	</select>
	<!-- кнопка отправления данных формы серверу -->
	<input type="submit" value="Удалить категорию">
</form>