<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

mysql_connect("localhost", "", "", "");

$db= mysql_select_db("");

$password=$_POST["password"];
$username=$_POST["username"];






$result = $conn->query("SELECT User_Name, Password FROM User");

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"Task_ID":"'  . $rs["Task_ID"] . '",';
    $outp .= '"Task_Description":"'. $rs["Task_Description"] . '"}'; 
}
$outp .="]";

$conn->close();

echo($outp);
?>


<?php
