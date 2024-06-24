<?php
	// старт сессии
	session_start ();
	// файл проверки авторизации
	include ("../include/auth.php");
	// подключение файла соединения с базой данной
	include ("../connect.php"); 	

	// проверяем является ли файл изображением
	if (!getimagesize ($_FILES["image"]["tmp_name"])) {
		header ("Location: ../personal-cabinet.php?uid=" . $_SESSION['user_id'] . "&message=Загружаемый файл должен быть изображением");
		exit;
	}

	// получаем мета данные изображения
	$arr = getimagesize ($_FILES["image"]["tmp_name"]);
	// проверяем формат загружаемого изображения
	if ($arr["mime"] == "image/png") { // png
		$ext = ".png";
	} elseif ($arr["mime"] == "image/jpeg") { // jpeg, jpg
		$ext = ".jpg";
	} elseif ($arr["mime"] == "image/bmp") { // bmp
		$ext = ".bmp";
	} else { 
		// в случае иных расширений
		header ("Location: ../personal-cabinet.php?uid=". $_SESSION['user_id'] . "&message=Поддерживаемые форматы изображения: jpeg, jpg, png и bmp");
		exit;
	}

	// получаем размер изображения
	$filesize = filesize ($_FILES["image"]["tmp_name"]);
	// перевод размера в мб
	$filesize = $filesize / (1024 * 1024);
	// проверка на размер изображения
	if($filesize > 10) {
		header ("Location: ../personal-cabinet?uid=". $_SESSION['user_id'] . "&message=Изображение не должно превышать 10 мб");
	}

	// формируем имя изображения
	$image_name = time () . $ext;

	// перемещаем изображение в директорию хранения
	if (!move_uploaded_file ($_FILES["image"]["tmp_name"], "../images/before/" . $image_name)) {
		header ("Location: ../personal-cabinet.php?uid=". $_SESSION['user_id'] . "&message=Произошла ошибка с сохранением вашего изображения");
		exit;
	}
	
	// запись полученных данных формы в переменные
	$title = $mysqli->real_escape_string (trim ($_REQUEST["title"]));
	$description = $mysqli->real_escape_string (trim ($_REQUEST["description"]));
	$category = $mysqli->real_escape_string (trim ($_REQUEST["category"]));
	// путь для добавления в базу данных
	$path = "images/before/". $image_name;

	// запрос на добавление данных в базу
	$insert_sql = sprintf ("
		INSERT INTO `applications`(`user_id`, `title`, `description`, `category_id`, `path_to_image_before`, `status_id`) VALUES 
		('%s', '%s', '%s', '%s', '%s', '%s')",
		$_SESSION["user_id"],
		$title,
		$description,
		$category,
		$path,
		"3"
	);

	// выполняем запрос на вставку
	if (!$mysqli->query ($insert_sql)) {
		header ("Location: ../personal-cabinet.php?uid=". $_SESSION['user_id'] ."&message=Ошибка вставки данных. ". $mysqli->error);
		exit;
	}

	header ("Location: ../personal-cabinet.php?uid=". $_SESSION['user_id'] ."&message=Заявка создана");
	exit;