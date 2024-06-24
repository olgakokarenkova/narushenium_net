<?php
session_start(); // обязательно начинайте сессию перед обращением к $_SESSION

// проверяем, существует ли ключ "auth" в массиве $_SESSION
if (isset($_SESSION["auth"]) && $_SESSION["auth"] == true) {
    // если пользователь авторизован
    $menu = '<a href="./"> Главная</a> | ';

    // если пользователь является администратором
    if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
        $menu .= sprintf("<a href='./admin.php?uid=%d'>Заявки</a> |", $_SESSION["user_id"]);
    }

    $menu .= sprintf("
        <a href='./personal-cabinet.php?uid=%d'>Личный кабинет</a> |
        <a href='./service/logout.php'>Выход</a>",
        $_SESSION["user_id"]
    );
} else {
    // если посетитель является гостем
    $menu = '
        <a href="registr.php">Регистрация</a> |
        <a href="logout.php">Вход</a>
    ';
}

// вывод пунктов меню
print($menu);
?>