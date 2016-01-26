<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
$newUserID = $_POST['newUserID'];
$newTitle = $_POST['newTitle'];
$newBody = $_POST['newBody'];
$completed = "0";
$newTaskListID = $_POST['newTaskListID'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO Task (Task_ID, Task_List, User_ID, Task_Name, Task_Description, Completed) VALUES (NULL, '$newTaskListID', '$newUserID', '$newTitle', '$newBody', '$completed')";


if ($conn->query($sql) === TRUE) {
  	header("Location: registeredIndex.php"); 
  	//echo "Record updated successfully";


} else {
    //echo "Error updating record: " . $conn->error;
}

$conn->close();

?>
