<?
//Подключение к БД. Необходимо заменить "user", "pass", "bd" реальными именем пользователя, паролем и именем базы соотвественно.
    $mysqli = mysqli_connect("localhost", "user", "pass", "bd") or die ('Ошибка!');
    mysqli_query($mysqli, "SET NAMES utf8");
?>