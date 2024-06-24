<?php
	// cтарт сессии
	session_start ();
	// файл проверки авторизации
	//require ("./auth.php");
	// очищение сессий
	unset ($_SESSION["user_id"]);
	unset ($_SESSION["auth"]);
	unset ($_SESSION["role"]);
	// перенаправление на главную страницу
	header ("Location: ../");
	exit;