	// функции управления видимостью изображений 
	// !!! --> применять только после исполнения основного функционала проекта 
	// функция отображения  старого изображения
	function fn_image_enter(e) {
		document.querySelector("#" + e.target.id + " div.before").style.display = "block";
		document.querySelector("#" + e.target.id + " div.after").style.display = "none";
	}
	// функция скрытия старого изображения
	function fn_image_leave(e) {
		document.querySelector("#" + e.target.id + " div.before").style.display = "none";
		document.querySelector("#" + e.target.id + " div.after").style.display = "block";
	}
	// ====================

	// функция валидации полей формы -Регистрация
	// !!! --> применять только после исполнения основного функционала проекта
	// Запрос на регистрацию
	function fn_register() {
		// получение данных формы
		let form = document.forms[0];
		// переменные для сбора  обработки ошибок
		let validator = {};
		let error = '';
		// переменная с элементами формы для заполнения ошибок валидации
		let p_err = document.querySelectorAll("p.error");

		// регулярные выражения для проверки валидации
		let fio_reg = /^[а-яА-ЯёЁ\-\ ]+$/;
		let login_reg = /^[a-zA-Z]+$/;
		let email_reg = /@/;

		// валидация поля -ФИО
		if(!fio_reg.test(form.elements["fio"].value)) {
			error = "ФИО должен содержать только кириллические буквы, дефис и пробелы";
			validator.fio = error;
		}

		// валидация поля -Логин
		if(!login_reg.test(form.elements["login"].value)) {
			error = "Логин должен содержать только латиницу";
			validator.login = error;
		}

		// валидация поля -Email
		if(!email_reg.test(form.elements["email"].value)) {
			error = "Email должно содержать валидный email формат";
			validator.email = error;
		}

		// валидация поля -Пароль
		if(form.elements["password"].value == "" ) {
			error = "Поле Пароль должно быть заполнено";
			validator.password = error;
		}

		// подтверждение пароля
		if(form.elements["password_check"].value == "") {
			error = "Поле Подтверждение пароля должно быть заполнено";
			validator.password_check = error;
		}

		// валидация совпадения полей -Пароль и -Подтверждение пароля
		if(form.elements["password"].value != form.elements["password_check"].value) {
			error = "Пароли не совпадают";
			validator.password_match = error;
		}

		// валидация Согласия на обработку данных
		if(!document.querySelector("input[name=privacy]").checked) {
			error = "Согласие обязательно";
			validator.privacy = error;
		}

		// проверка наличия ошибок в валидации
		if(Object.keys(validator).length != 0) {
			// вывод ошибок валидации
			for (let i = 0; i < p_err.length; i++) {
				// проверка на пустоту валидации
				if(validator[p_err[i].id] == undefined) validator[p_err[i].id] = "";
				// добавление сообщения об ошибке
				p_err[i].innerHTML = validator[p_err[i].id];
				// проверка на null
				if (document.querySelector("form#reg input[name="+ p_err[i].id +"]") == null)
					continue;
				// добавление или удаление класса ошибки
				if(p_err[i].innerHTML != "")
					document.querySelector("form#reg input[name="+ p_err[i].id +"]").classList.add('error');
				else
					document.querySelector("form#reg input[name="+ p_err[i].id +"]").classList.remove('error');
			}
			// отмена отправки данных серверу
			return false;
		}

		// разрешение на отправку данных серверу
		return true;
	}
	// ====================