<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/datatables.min.css" rel="stylesheet">
    <title>Курсы валют</title>
  </head>
  <body>
    <div class="container">
      <h1>Информационная система "Курсы валют"</h1>
      <div class="mb-5">
        <form name="filterform" id="filter" action="/" method="post">
          <div class="d-flex">
            <div class="mb-3 flex-fill">
              <label for="" class="form-label">Валюта</label>
              <select name="vals" class="form-select" aria-label="Фильтр по валюте">
              <option value="all" selected>Все</option>
                <?
                include "dbconn.php";
                $sel = $mysqli->query("SELECT `id`, `Name` FROM guide");
                while ($row = $sel->fetch_assoc()) {
                  ?> <option value="<?=$row['id']?>"><?=$row['Name']?></option> <?
                }
                ?>
            </select>
            </div>
            <div class="flex-fill ms-3 me-3">
                <label for="" class="form-label">Дата начала периода</label>
                <input name="datestart"type="date" class="form-control">
            </div>
            <div class="flex-fill">
                <label for="" class="form-label">Дата окончания периода</label>
                <input name="dateend" type="date" class="form-control">
              </div>
          </div>
          <button type="submit" class="btn btn-primary">Применить фильтр</button>
          <button type="button" class="btn btn-primary ms-5">Показать динамику на графике</button>
          <button type="button" class="btn btn-primary">Скачать в формате json</button>
        </form>
      </div>
      <table id="valuta" class="table table-striped display">
        <thead>
          <tr>
            <th scope="col">Цифр. код</th>
            <th scope="col">Букв. код</th>
            <th scope="col">Единиц</th>
            <th scope="col">Валюта</th>
            <th scope="col">Курс</th>
            <th scope="col">Дата курса</th>
          </tr>
        </thead>
        <tbody id='tableContent'>
        </tbody>
      </table>
    </div>
    <script>
      // Отправляем данные фильтра для обработки post запросом в файл filter.php
      document.getElementById('filter').addEventListener('submit', function(event) {
          event.preventDefault();
          let form = document.forms.filterform;
          let dates = form.elements.datestart;
          $.ajax({
            url: '/filter.php',
            method: 'post',
            dataType: 'html',
            data: $(this).serialize(),
            success: function(data){
              $('#tableContent').html(data);
          }
	        });
      });
    </script>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/datatables.min.js"></script>
    <script>// let table = new DataTable('#valuta');</script>
  </body>
</html>
