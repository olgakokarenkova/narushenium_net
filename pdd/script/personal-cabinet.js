	// функция валидации полей формы -Создать Заявку
	// !!! --> применять только после исполнения основного функционала проекта
	// Запрос на создание заявки
	function fn_app_add() {
		// получение данных формы
		let form = document.forms[0];
		// переменные обработки ошибок
		let validator = {};
		let error = '';
		// переменная с элементами формы для заполнения ошибок валидации
		let p_err = document.querySelectorAll("p.error");

		// проверка поля -Название заявки
		if(form.elements["title"].value == "") {
			error = "Введите Название заявки";
			validator.title = error;
		}

		// проверка поля -Название заявки по символам
		if(form.elements["title"].value.length >= 50) {
			error = "Название не должно превышать 50 символов";
			validator.title = error;
		}

		// проверка поля -Описание заявки
		if(form.elements["description"].value == "") {
			error = "Описание должно быть заполнено";
			validator.description = error;
		}

		// проверка поля -Описание заявки по символам
		if(form.elements["description"].value.length >= 500) {
			error = "Описание не должно превышать 500 символов";
			validator.description = error;
		}

		// проверка списка -Категория заявки
		if(form.elements["category"].value == "") {
			error = "Категория должна быть выбрана";
			validator.category = error;
		}

		// проверка наличия ошибок в переменной validator
		if(Object.keys(validator).length != 0) {
			// Вывод ошибок валидации
			for (let i = 0; i < p_err.length; i++) {
				// Проверка на пустоту валидации
				if(validator[p_err[i].id] == undefined) validator[p_err[i].id] = "";
				// Добавление сообщения об ошибке
				p_err[i].innerHTML = validator[p_err[i].id];
			}
			// отмена отправки данных серверу
			return false;
		}

		// разрешене отправки данных серверу
		return true;
	};
	// ====================

	// функция фильтрации заявок по статусу
	// !!! --> применять только после исполнения основного функционала проекта
	function fn_app_filtration(status) {
		// получение всех заявок
		let app = document.querySelectorAll(".wrap");

		// если заявки отсутствуют
		if(app.length == 0) return;

		// если переданный статус отсутствует
		if(status == undefined) {
			// отображение всех заявок
			for(let i = 0; i < app.length; i++) {
				// Отображение заявки
				app[i].style.display = "block";
			}
			// очищение блока сообщения
			document.querySelector("#mess").innerHTML = "";
			// завершение выполнения функции
			return;
		}

		// получение текста статуса у всех заявок
		let stat = document.querySelectorAll(".wrap #status b");
		// фильтрация по статусу
		for(let i = 0; i < stat.length; i++) {
			// проверка на статус
			if(stat[i].innerHTML == status) {
				// отображение нужного блока
				app[i].style.display = "block";
				// переход на следующую итерацию цикла
				continue;
			}
			// Скрытие заявки в случае несоответствия фильтрации
			app[i].style.display = "none";
		}

		// счётчик
		let count = 0;
		// смотрим сколько блоков скрыто
		for(let i = 0; i < app.length; i++) {
			if(app[i].style.display == "none") {
				count++;
			}
		}

		// если все блоки скрыты, значит фильтрация не нашла заявок
		if(app.length == count) {
			// выводим сообщение об отсутствии заявок фильтрации
			document.querySelector("#mess").innerHTML = "<h3 id='filtr'>Фильтрация ничего не нашла</h3>";
		// в ином случае удалем сообщение
		} else {
			document.querySelector("#mess").innerHTML = "";
		}
	};
	// ====================

	// функция вывода диалогового окна на проверку действительно ли пользователь хочет удалить заявку
	// !!! --> применять только после исполнения основного функционала проекта	
	function fn_app_delete() {
		// Переменная выбора
		let result = confirm("Вы действительно хотите удалить заявку?");
		// Возвращение результата
		return result;
	}
	// ====================