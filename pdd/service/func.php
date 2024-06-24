<?php
// вспомогательные функции нашего проекта
// функции можно не использовать, а создавать код по мере необходимости в файлах проекта 
// вот только не знаю, упростит ли это код... 
	
// ====================
// функция получения последних 4 решённых заявок для главной страницы
function fnGetLatestApplications () {
	global $mysqli;
	// запрос на получение последних 4 решённых заявок
	$applications_sql = "SELECT a.*, c.category as category_name FROM `applications` a LEFT JOIN `category` as c on c.category_id=a.category_id WHERE a.`status_id`='1' ORDER BY a.`created_at` DESC LIMIT 4";
	// выполнение запроса
	$result = $mysqli->query ($applications_sql);

	// если запрос выполнен успешно
	if ($result) {
		// если записей с атрибутом `status`='Решена' нет 
		if ($result->num_rows == 0) {
			$app = "<h3>Решённые заявки отсутствуют</h3>";
		// если записи есть
		} else {
			// цикл по записям и добавление данных в переменную $app
			while ($row = $result->fetch_array ()) {
				$app .= sprintf ("
					<div class='wrap'>
						<div class='image' onmouseenter='fn_image_enter(event)' onmouseleave='fn_image_leave(event)' id='image_%d'>
							<div class='before' style='display: none'><img src='%s' /></div>
							<div class='after'><img src='%s' /></div>
						</div>
						<h3>%s</h3>
						<p class='justify'>Категория заявки: <b>%s</b></p>
						<p class='date'>%s</p>
					</div>",
					$row["application_id"], 
					$row["path_to_image_before"], 
					$row["path_to_image_after"],
					$row["title"], 
					$row["category_name"], 
					$row["created_at"]
				);
			}
		}

	// в случае некорректности выполнения запроса
	} else {
		$app = "<h3>Ошибка вывода заявок</h3>";
	}

	return $app;
}; 
// end fnGetLatestApplications
// --------------------

// ====================
// функция получения общего количества решёных заявок в базе (используется на главной странице)
function fnGetCountApplications () {
	global $mysqli;
	// запрос на получение числа решённых заявок
	$count_sql = "SELECT COUNT(*) as `count` FROM `applications` WHERE `status_id`='1'";
	// выполнение запроса
	$result = $mysqli->query ($count_sql);
	// если запрос выполнен успешно
	if($result) {
		// получение данных из запроса
		$row = $result->fetch_array ();
		// возвращение числа решённых заявок
		return $row['count'];
	} else {
		return "сбой при подключении к серверу...";
	}
}; 
// fnGetCountApplications
// --------------------

// ====================
// функция получения списка категорий заявок 
// категории согласно задания составляется динамически, могут редактироваться администратором
function fnGetCategoryApplications () {
	global $mysqli;
	// запрос на получение всех категорий заявок
	$category_sql = "SELECT * FROM `category`";
	// выполнение запроса
	$result = $mysqli->query ($category_sql);
	// если запрос выполнился корректно
	if ($result) {
		// цикл записи данных в переменную
		while ($row = $result->fetch_array ()) {
			$cat .= sprintf("<option value=%s>%s</option>",
				$row["category_id"], 
				$row["category"]
			);
		}
	// в случае некорректности выполнения запроса
	} else {
		$cat = "<h3>проблема вывода категорий</h3>";
	}

	return $cat;
}; 
// end fnGetCategoryApplications
// --------------------

// ====================
// фукнкция получения списка всех заявок авторизованного пользователя (для вывода в личный кабинет)
function fnGetApplicationsUser ($uid) {
	global $mysqli;
	// запрос на получение списка всех заявок пользователя
	$applications_sql = sprintf ("SELECT a.*, c.category as category_name, s.status as status_name FROM `applications` as a LEFT JOIN `status` as s on s.`status_id`=a.`status_id` LEFT JOIN `category` as c on c.`category_id`=a.`category_id` WHERE a.`user_id`= %d ORDER BY a.`created_at` DESC", $uid);
	// выполнение запроса
	$result = $mysqli->query ($applications_sql);

	// если запрос выполнился корректно
	if ($result) {
		// если записей нет
		if($result->num_rows == 0) {
			$app = "<h3>Заявки отсутствуют</h3>";
		// если записи есть
		} else {
			// цикл записи данных в переменную
			while ($row = $result->fetch_array ()) {
				$app .= sprintf ("
					<div class='wrap'>
						
						<h3>%s</h3>
						<p id='status'>Статус заявки: <b>%s</b></p>
						
						<h4>Описание:</h4>
						<p class='justify'>%s</p>
						<p class='del'><a href='service/delete-application.php?uid=%d&id=%d' onclick='return fn_app_delete()'>Удалить заявку</a></p>
						<p class='date'>%s</p>
					</div>",
					$row["application_id"], 
					$row["title"], 
					$row["status_name"], 
					$row["category_name"],
					$row["description"], 
					$_SESSION["user_id"],
					$row["application_id"], 
					$row["created_at"]
				);
			}
		}
	// В случае некорректности выполнения запроса
	} else {
		$app = "<h3>Ошибка вывода заявок</h3>";
	}

	return $app;
}; 
// end fnGetApplicationsUser
// --------------------

// ====================
//Функция получения статусов
function fnGetStatuses() {
	global $mysqli;

	$statuses = array();
	$sql = "SELECT * FROM `status` ORDER BY `status` ASC";
	$result = $mysqli->query ($sql);
	if($result) {
		while ($row = $result->fetch_array()) {
			$statuses[$row["status_id"]] = $row["status"];
		}
	}
	return $statuses;
}
// end fnGetStatuses
// --------------------


// ====================
// функция получения всех заявок на страницу Администратора
// заявки выводятся по категориям
function fnGetAdminApplications($status) {
	global $mysqli;

	// Запрос на получение всех заявок со статутом "Новая"
	$new_sql = "SELECT a.*, s.status as status_name, c.category as category_name FROM `applications` as a LEFT JOIN `status` as s on s.`status_id`=a.`status_id` LEFT JOIN `category` as c on c.`category_id`=a.`category_id` WHERE a.`status_id`='3' ORDER BY a.`created_at` DESC";
	// Запрос на получение всех заявок со статутом "Решена"
	$resolved_sql = "SELECT a.*, s.status as status_name, c.category as category_name FROM `applications` as a LEFT JOIN `status` as s on s.`status_id`=a.`status_id` LEFT JOIN `category` as c on c.`category_id`=a.`category_id` WHERE a.`status_id`='1' ORDER BY a.`created_at` DESC";
	// Запрос на получение всех заявок со статутом "Отклонена"
	$rejected_sql = "SELECT a.*, s.status as status_name, c.category as category_name FROM `applications` as a LEFT JOIN `status` as s on s.`status_id`=a.`status_id` LEFT JOIN `category` as c on c.`category_id`=a.`category_id` WHERE a.`status_id`='2' ORDER BY a.`created_at` DESC";

	// формирование запроса в зависимости от статуса
	if($status == "new") {
		// Выполнение первого запроса
		$result = $mysqli->query ($new_sql);
	} elseif ($status == "resolved") {
		// Выполнение второго запроса
		$result = $mysqli->query ($resolved_sql);
	} elseif($status == "rejected") {
		// Выполнение третьего запроса
		$result = $mysqli->query ($rejected_sql);
	}

	$statuses = fnGetStatuses();

	// Если запрос выполнен успешно
	if($result) {
		// если записей нет
		if( $result->num_rows == 0) {
			$app = "<h3>Заявки отсутствуют</h3>";
		// если записи есть
		} else {
			// цикл по записям для формирования данных вывода
			while ($row = $result->fetch_array()) {
				// проверка на состояние заявки для выбора нужного изображения
				if($status == "new") $image = $row["path_to_image_before"];
				if($status == "rejected") $image = $row["path_to_image_before"];
				if($status == "resolved") $image = $row["path_to_image_after"];
				// запись данных в переменную
				$out = sprintf("
					<div class='wrap'>
						<div class='image'>
							<div class='before'><img src='%s'/></div>
						</div>
						<h3>%s</h3>
						<p id='status'>Статус заявки: <b>%s</b></p>
						<p class='justify'>Категория заявки: <b>%s</b></p>
						<h4>Описание:</h4>
						<p class='justify'>%s</p>
						%s
						<p class='date'>%s</p> 
					</div>",

					$image,
					$row["title"],
					$row["status_name"],
					$row["category_name"],
					$row["description"],
					'%s',
					$row["created_at"]
				);

				if($status == "new") {
						$more = sprintf ("
							<p>
								<select onchange='fn_change_app(event)' id='%d'>
									<option disabled selected>Выберите тип действий</option>
									<option value='1'>Решить</option>
									<option value='2'>Отклонить</option>
								</select>
							</p>
							<div id='change_%d'></div>",
							$row["application_id"],
							$row["application_id"]
						);
				} else if ($status == "rejected") {
						$more = sprintf ("
							<h4>Причина отказа:</h4>
							<p class='justify'>%s</p>",
							$row["rejection_reason"]
						);
				};

				$app .= sprintf ($out, $more);
				
			} // end while
		}

	// в случае некорректности выполнения запроса
	} else {
		$app = "<h3>Ошибка вывода заявок</h3>";
	}

	// возвращаем данные
	return $app;
}
// end fnGetAdminApplications
// --------------------

// ====================
// функция добавления новой категории заявок
function fnAddCategoryApplications () {
	global $mysqli;
	
	// запись полученного значения в переменную
	$category = $mysqli->real_escape_string ( trim($_POST["category"]));
	// подготовка запроса на добавление категории в базу
	$insert_sql = sprintf ("INSERT INTO `category`(`category`) VALUES ('%s')", $category);

	// выполнение запроса
	if($mysqli->query($insert_sql)) {
		// успех выполнения
		header("Location: ./category-page.php?uid=" . $_SESSION["user_id"] . "&message=Категория добавлена");
	} else {
		// ошибка выполнения
		header("Location: ./category-page.php?uid=" . $_SESSION["user_id"] . "&message=Ошибка вставки данных");
	}

}
// end fnAddCategoryApplications
// --------------------

// функция удаления категории 
// влечет за собой удаление всех заявок категории
function fnDeleteCategoryApplications () {
	global $mysqli;

	// построение запроса на удаление всех заявок удаляемой категории
	$del_app_sql = sprintf ("DELETE FROM `applications` WHERE `category_id` = %d", $_POST["cat_id"]);
	
	// выполнение запроса, в случае неудачи вывод сообщения об ошибке
	if(!$mysqli->query ($del_app_sql)) {
		header("Location: ./category-page.php?uid=" . $_SESSION["user_id"] . "&message=Ошибка удаления заявок");
		exit;
	} 

	// построение запроса на удаление самой категории
	$del_cat_sql = sprintf ("DELETE FROM `category` WHERE `category_id` = %d", $_POST["cat_id"]);
	// выполнение запроса,  в случае неудачи вывод сообщения об ошибке
	if(!$mysqli->query($del_cat_sql)) {
		header("Location: ./category-page.php?uid=" . $_SESSION["user_id"] . "&message=Ошибка удаления категории");
		exit;
	}

	// в случае успеха
	header("Location: ./category-page.php?uid=" . $_SESSION["user_id"] . "&message=Категория удалена");
	exit;	
}
// end fnDeleteCategoryApplications
// --------------------