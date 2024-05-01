<?
include "dbconn.php";
include "function.php";
//Манипуляции с датами в случае их не корректного заполнения
if($_POST['datestart'] || $_POST['dateend']){
    if($_POST['datestart']){
        $sdateRes = date("d.m.Y", strtotime($_POST['datestart']));
    } else {
        $sdateRes = date("d.m.Y", strtotime($_POST['dateend']));
    }
    if($_POST['dateend']){
        $fdateRes = date("d.m.Y", strtotime($_POST['dateend']));
    } else {
        $fdateRes = $sdateRes;
    }
} else {
    $sdateRes = date("d.m.Y");
    $fdateRes = $sdateRes;
}
if($sdateRes > $fdateRes){
    echo 'Ошибка. Дата начала периода старше даты его окончания';
} else {
    $dateImport = importxml($sdateRes, $fdateRes); // загружаем данные в БД если их еще там нет
    echo '<p>Недостающие данные загружены в базу до ' . $dateImport . '</p>';
    //Запрашиваем данные в БД в соотвествии с фильтром
    if($_POST['vals'] != 'all'){
        $selRes = $_POST['vals'];
        $sel = $mysqli->query("SELECT * FROM exchange JOIN guide ON exchange.ids = guide.id WHERE (`exchange`.`date` BETWEEN '".$sdateRes."' AND '".$fdateRes."') AND `exchange`.`ids` = '".$selRes."';");
    } else {
        $sel = $mysqli->query("SELECT * FROM exchange JOIN guide ON exchange.ids = guide.id WHERE `exchange`.`date` BETWEEN '".$sdateRes."' AND '".$fdateRes."';");
    }
    //Выводим данные в таблицу
    if (mysqli_num_rows($sel)!=0){
        while ($row = $sel->fetch_assoc()) {
            echo '<tr> <td>' . $row['NumCode'] . '</td> <td>' . $row['CharCode'] . '</td> <td>' . $row['Nominal'] . '</td> <td>' . $row['Name'] . '</td> <td>' . $row['Value'] . '</td> <td>' . $row['date'] . '</td> </tr>';
        }
    }
}

?>