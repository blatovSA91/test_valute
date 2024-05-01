<?
function importxml($sDate, $eDate){
    include "dbconn.php";
    //$resDate = str_replace('.', '/', $exDate);
    $period = new DatePeriod(
        new DateTime($sDate),
        new DateInterval('P1D'),
        new DateTime($eDate . '23:59')
    );
    $resDates = array();
    foreach ($period as $key => $value) {
        $resDates[] = $value->format('d.m.Y');   
    } 
    foreach($resDates as $exDate){
        $exxml = simplexml_load_file('https://www.cbr.ru/scripts/XML_daily.asp?date_req='.$exDate);
        $date = $exxml['Date'];
        $sel = $mysqli->query("SELECT * FROM exchange WHERE `date` = '".$date."';");
        if($exDate == $date || mysqli_num_rows($sel)==0){
            $j=0;
            while($exxml->Valute[$j]){
                $id = $exxml->Valute[$j]['ID'];
                $NumCode = $exxml->Valute[$j]->NumCode;
                $CharCode = $exxml->Valute[$j]->CharCode;
                $Value = str_replace(',', '.', $exxml->Valute[$j]->Value);
                $VunitRate = str_replace(',', '.', $exxml->Valute[$j]->VunitRate);
                $j++;
                $sqladd = $mysqli->query("INSERT INTO exchange (`ids`, `NumCode`, `CharCode`, `Value`, `VunitRate`, `date`) VALUES ('".$id."', '".$NumCode."', '".$CharCode."', '".$Value."', '".$VunitRate."', '".$date."')");
            }
        }
    }
    return($date);
}
?>