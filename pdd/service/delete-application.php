<?php
	// старт сессии
	session_start ();
	// файл проверки авторизации
	include ("../include/auth.php");
	// подключение файла соединения с базой данной
	include ("../connect.php"); 

	// запрос на получение данных заявки для проверок и удаления изображения
	$app_sql = sprintf ("SELECT `user_id`, `status`, `path_to_image_before` FROM `applications` WHERE `application_id`='%s'",  $_GET["id"]);
	// выполнение запроса на получение
	$result = $mysqli->query ($app_sql);

	// если запрос успешен
	if ($result) {
		// получение данных запроса
		$row = $result->fetch_array ();
		// проверка пользователя желающего удалить заявку
		if ($_SESSION["user_id"] != $row["user_id"]) {
			header ("Location: ../personal-cabinet.php?uid=". $_SESSION['user_id'] ."&message=Вы не можете удалять чужие заявки");
			exit;
		}
		// проверка статуса заявки
		if ($row["status"] != "Новая") {
			header ("Location: ../personal-cabinet.php?uid=". $_SESSION['user_id'] ."&message=Удалять можно только заявки со статусом 'Новая'");
			exit;
		}

	// в случае некорректности выполнения запроса
	} else {
		header ("Location: ../personal-cabinet.php?uid=". $_SESSION['user_id'] ."&message=Ошибка получения данных");
		exit;
	}

	// gподготовка запроса на удаление записи из базы данных
	$delete_app_sql = sprintf ("DELETE FROM `applications` WHERE `application_id`='%s'", $_GET["id"]);

	// выполнение запроса на удаление заявки
	if($mysqli->query ($delete_app_sql)) {
		// удаляем изображение с сервера
		$path = "../" . $row["path_to_image_before"];
		$unlink = @unlink ($path);
		// в случае успеха выполнения запроса
		header ("Location: ../personal-cabinet.php?uid=". $_SESSION['user_id'] ."&message=Заявка удалена");
	} else
	{
		// если запрос на удаление неудачен
		header ("Location: ../personal-cabinet.php?uid=". $_SESSION['user_id'] ."&message=Ошибка удаления");
	}
	
	exit;