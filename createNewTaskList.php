<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
$newUserID = $_POST['newUserID'];
$newTitle = $_POST['newTitle'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO Tasklist (Task_List_ID, User_ID, Title) VALUES (NULL, '$newUserID', '$newTitle')";
    //echo ($newTitle);
  	//echo ($newBody);
    //echo ($newUserID);


if ($conn->query($sql) === TRUE) {
  	header("Location: registeredIndex.php"); 
  	//echo "Record updated successfully";


} else {
    //echo "Error updating record: " . $conn->error;
}

$conn->close();

?>