# test_valute
Реализована загрузка и хранение данных в БД. Отображение данных в виде таблицы с учетом дпнных из фильтра.

Установка:
1) Для работы системы необходимо установить на сервере:
- PHP версии не ниже 8.1
- MYSQL не ниже 5.7
- Веб сервер Nginx или Apache сконфигурироваными для работы с PHP.

2) Разместите файлы системы на web сервере. Сконфигурируйте Nginx или Apache для работы с директорией в которую загрузили систему.

3) Создайте базу данных и пользователя для работы с ней. Пользователю назначьте права на чтение и запись в созданную базу. Структуру БД создайте из файла bd.sql командой source. Занесите актуальные данные для подключения к базе данных в файл dbconn.php. После этого удалите файл bd.sql. 


Инструкция по работе в системе:
1) Выберите значение из списка в поле "Валюта".
2) Укажите дату начала и окончания периода.
3) Нажмите на кнопку "Применить"
   Данные, подгружаются в бузу данных автоматически в зависимости от выбранной даты в фильтре.
