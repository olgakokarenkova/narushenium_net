<?php
	// старт сессии
	session_start ();
	// подключение файла соединения с базой данной
	require ("../connect.php");

	// если пользователь не авторизован
	if($_SESSION["auth"] != true) {
		// построение sql запроса на получение данных пользователя
		$user_sql = sprintf("SELECT `user_id`, `role` FROM `users` WHERE `login` = '%s' AND `password` = '%s'",
			$mysqli->real_escape_string (strip_tags ($_POST["login"])), 
			$mysqli->real_escape_string (strip_tags ($_POST["password"]))
		);

		// выполнение запроса
		$result = $mysqli->query ($user_sql);

		// если пользователь найден
		if($result->num_rows == 1) {
			// получение данных из запроса
			$row = $result->fetch_array ();

			// запись данных в сессии
			$_SESSION["user_id"] = $row["user_id"];
			$_SESSION["role"] = $row["role"];
			$_SESSION["auth"] = true;

			// перенаправление пользователя в личный кабинет
			header("Location: ../personal-cabinet.php?uid=". $row["user_id"]);
			exit;

		// если пользователь не найден
		} else {
			// перенаправление пользователя на страницу авторизации с сообщением об ошибке
			header ("Location: ../index.php?message=Ошибка логина или пароля");
			exit;
		}
	// если пользователь авторизован
	} else {
		// перенаправление пользователя в личный кабинет с сообщением об ошибке
		header("Location: ../personal-cabinet.php?uid=". $_SESSION["user_id"] ."&message=Вы уже авторизованы");
		exit;
	}