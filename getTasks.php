<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "", "", "");

$result = $conn->query("SELECT Task_ID, Task_List, User_ID, Task_Name, Completed, Task_Description FROM Task");

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"Task_ID":"'  . $rs["Task_ID"] . '",';
    $outp .= '"Task_List":"'   . $rs["Task_List"] . '",';
    $outp .= '"User_ID":"'   . $rs["User_ID"] . '",';
    $outp .= '"Task_Name":"'   . $rs["Task_Name"] . '",';
    $outp .= '"Completed":"'   . $rs["Completed"] . '",';
    $outp .= '"Task_Description":"'. $rs["Task_Description"] . '"}'; 
}
$outp .="]";

$conn->close();

echo($outp);
?>
