<?php
	// cтарт сессии
	session_start ();	
	// подключение файла соединения с базой данной
	include ("../connect.php");
	if ($_SESSION["auth"] == true) {
		// перенаправление пользователя в личный кабинет с сообщением об ошибке
		header ("Location: ../personal-cabinet.php?uid=". $_SESSION["user_id"] ."&message=Вы уже авторизованы");
		exit;
	};		
	
	// запись полученных данных в переменные с обработкой
	$fio = $mysqli->real_escape_string (trim ($_REQUEST["fio"]));
	$login = $mysqli->real_escape_string (trim ($_REQUEST["login"]));
	$email = $mysqli->real_escape_string (trim ($_REQUEST["email"]));
	$password = $mysqli->real_escape_string (trim ($_REQUEST["password"]));
	$password_check = $mysqli->real_escape_string (trim ($_REQUEST["password_check"]));
	$privacy = $mysqli->real_escape_string (trim ($_REQUEST["privacy"]));	

	// проверка наличия логина в базе
	$register_sql = sprintf ("SELECT * FROM `users` WHERE `login`= '%s'", $login);
	// 
	$result = $mysqli->query ($register_sql);
	// если логин есть
	if ($result->num_rows != 0) {
		header("location: ../index.php?message=Логин занят");
		exit;
	}

	// запрос на добавление данных в базу
	$insert_sql = sprintf ("
		INSERT INTO `users`(`fio`, `login`, `email`, `password`, `role`) VALUES ('%s', '%s', '%s', '%s', '%s')",
		$fio, 
		$login, 
		$email, 
		$password, 
		"user"
	);

	// выполнение запроса, в случае неудачи вывод сообщения об ошибке
	if(!$mysqli->query ($insert_sql)) {
		header ("Location: ../index.php?message=Ошибка вставки данных");
	} else {
		// перенаправление на страницу входа в случае успеха
		header ("Location: ../index.php?message=Вы успешно зарегистрировались");
	}
	exit;