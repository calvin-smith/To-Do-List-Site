<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
$newTaskID = $_POST['newTaskID'];
$newUserID = $_POST['newUserID'];
$newTitle = $_POST['newTitle'];
$newBody = $_POST['newBody'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE Task SET Task_Name='$newTitle', Task_Description='$newBody' WHERE User_ID=$newUserID AND Task_ID=$newTaskID";

if ($conn->query($sql) === TRUE) {
  	header("Location: registeredIndex.php");


} else {
}

$conn->close();

?>
