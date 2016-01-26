<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
$newUserID = $_POST['newUserID'];
$newTaskListID = $_POST['newTaskListID'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "DELETE From Tasklist WHERE User_ID=$newUserID AND Task_List_ID=$newTaskListID";
$sql2 = "DELETE From Task WHERE User_ID=$newUserID AND Task_List=$newTaskListID";
    //echo ($newTitle);
  	//echo ($newBody);
    //echo ($newUserID);


if ($conn->query($sql) === TRUE) {
  	//header("Location: testloggedin.php"); 
  	//echo "Record updated successfully";


} else {
    echo "Error updating record: " . $conn->error;
}
if ($conn->query($sql2) === TRUE) {
  	header("Location: registeredIndex.php"); 
  	//echo "Record updated successfully";


} else {
    //echo "Error updating record: " . $conn->error;
}

$conn->close();

?>