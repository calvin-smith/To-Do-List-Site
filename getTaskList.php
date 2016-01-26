<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "", "", "");

$result = $conn->query("SELECT Task_list_ID, User_ID, Title FROM Tasklist");

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"Task_list_ID":"'  . $rs["Task_list_ID"] . '",';
    $outp .= '"User_ID":"'   . $rs["User_ID"] . '",';
    $outp .= '"Title":"'. $rs["Title"] . '"}'; 
}
$outp .="]";

$conn->close();

echo($outp);
?>