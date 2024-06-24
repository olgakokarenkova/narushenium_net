	// функция вывода форм в зависимости от выбора действия для заявки
	// можно формы выводить сразу на сервере -  
	// плюс --> 1)избавимся от скрипта JavaScript; 2)проще реализация функционала
	// минус --> скорее всего потеряем в дизайне (хотя не факт)
	function fn_change_app(e) {
		// переменная вывода данных
		let out;
		// проверка выбора пункта из списка
		if(e.target.value == 1) {
			// запись данных в переменную
			out = `
				<form enctype="multipart/form-data" action="./service/change-status-application.php?uid=${id}" method="POST" onsubmit="return fn_validation_app()">
					<p><b>Доказательство решения проблемы:</b></p>
					<input type="hidden" value="${e.target.value}" name="change">
					<input type="hidden" value="${e.target.id}" name="app_id">
					<input type="file" name="image"> <br>
					<input type="submit" value="Отправить">
				</form>
			`;
		} else if (e.target.value == 2) {
			// запись данных в переменную
			out = `
				<form action="./service/change-status-application.php" method="GET" onsubmit="return fn_validation_app()">
					<input type="hidden" value="${id}" name="uid">
					<input type="hidden" value="${e.target.value}" name="change">
					<input type="hidden" value="${e.target.id}" name="app_id">
					<p class="error" id="rejection_reason"></p>
					<textarea name="rejection_reason" placeholder="Причина отказа"></textarea>
					<input type="submit" value="Отправить">
				</form>
			`;
		}
		// вывод данных в форму
		document.querySelector("#change_" + e.target.id).innerHTML = out;
	};
	// ====================	

	// Функция валидация данных форм обработки заявок -Решить -Отклонить
	// !!! --> применять только после исполнения основного функционала проекта	
	function fn_validation_app() {
		// получение данных формы
		let form = document.forms[0];
		// переменные обработки ошибок
		let validator = {};
		let error = '';
		// переменная с элементами формы для заполнения ошибок валидации
		let p_err = document.querySelectorAll("p.error");

		// валидация поля причин отказа выполнения заявки на пустоту
		if(form.elements['rejection_reason'].value == "") {
			error = "Причина отказа должна быть заполнена";
			validator.rejection_reason = error;
		}

		// валидация поля причин отказа выполнения заявки на количество символов
		if(form.elements['rejection_reason'].value.length > 500) {
			error = "Причина отказа не должна превышать 500 символов";
			validator.rejection_reason = error;
		}

		// проверка наличия ошибок в валидации
		if(Object.keys(validator).length != 0) {
			// вывод ошибок валидации
			for (let i = 0; i < p_err.length; i++) {
				// проверка на пустоту валидации
				if(validator[p_err[i].id] == undefined) validator[p_err[i].id] = "";
				// добавление сообщения об ошибке
				p_err[i].innerHTML = validator[p_err[i].id];
			}
			// отмена отправки данных серверу
			return false;
		}

		// разрешение отправки данных серверу
		return true;
	};
	// ====================