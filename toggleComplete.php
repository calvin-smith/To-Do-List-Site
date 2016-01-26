<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
$newTaskID = $_POST['newTaskID'];
$newCompleted = $_POST['newCompleted'];
$newUserID = $_POST['newUserID'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE Task SET Completed=$newCompleted WHERE Task_ID=$newTaskID AND User_ID=$newUserID";


if ($conn->query($sql) === TRUE) {
  header("Location: registeredIndex.php"); 
    //echo "Record updated successfully";
    //echo ($newTaskID);
    //echo ($newCompleted);
    //echo ($newUserID);

} else {
    //echo "Error updating record: " . $conn->error;
}

$conn->close();

?>