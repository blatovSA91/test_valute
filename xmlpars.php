<?
//Для ручной загрузки справочника
include "dbconn.php";
$xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_val.asp?d=0');
$i=0;
while($xml->Item[$i]){
    $id = $xml->Item[$i]['ID'];
    $Name = $xml->Item[$i]->Name;
    $EngName = $xml->Item[$i]->EngName;
    $Nominal = $xml->Item[$i]->Nominal;
    $ParentCode = $xml->Item[$i]->ParentCode;
    $i++;
    $sqladd = $mysqli->query("INSERT INTO guide VALUES ('".$id."', '".$Name."', '".$EngName."', '".$Nominal."', '".$ParentCode."')");
}
?>

?>