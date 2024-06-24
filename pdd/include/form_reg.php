<div class="heading" id="register">Регистрация</div>

<!-- форма регистрации, метод POST -->
<form action="service/register.php" method="POST" onsubmit="return fn_register();" id="reg">

	<!-- ФИО -->
	<p class="error" id="fio"></p>
	<input type="text" placeholder="ФИО" name="fio">

	<!-- логин -->
	<p class="error" id="login"></p>
	<input type="text" placeholder="Логин" name="login">

	<!-- email -->
	<p class="error" id="email"></p>
	<input type="text" placeholder="Email" name="email">

	<!-- пароль -->
	<p class="error" id="password_match"></p>
	<p class="error" id="password"></p>
	<input type="password" placeholder="Пароль" name="password">

	<!-- подтверждение пароля -->
	<p class="error" id="password_check"></p>
	<input type="password" placeholder="Повтор пароля" name="password_check">

	<!-- согласие на обработку персональных данных -->
	<div class="left">
		<p class="error" id="privacy"></p>
		<input type="checkbox" name="privacy"> Согласие на обработку персональных данных
	</div>

	<!-- отправка данных файлу регистрации -->
	<input type="submit" value="Зарегистрироваться">
</form>