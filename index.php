<?php 
//Built from SQL login tutorial by E-Oreo
//http://forums.devshed.com/php-faqs-stickies-167/program-basic-secure-login-system-using-php-mysql-891201.html


    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
    // At the top of the page we check to see whether the user is logged in or not 
    if(empty($_SESSION['User'])) 
    { 

      // If they are not, we redirect them to the login page. 
      //header("Location: index.php"); 
    }
    else {  

        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
      header("Redirecting to registeredIndex.php"); 
    
    }
?>
<!--index.php -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To-Do List</title>
 
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="bootstrap-theme">  
    <link href="css/timelinestyle.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
  
  </head>
  <body>
<!-- Start Nav Bar -->
<!-- 
Modified Nav Bar Template by McGyver
http://bootsnipp.com/snippets/8z0Q
-->
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <!-- Sign Up Button -->
            <li class="dropdown">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown">Register <strong class="caret"></strong></a>
              <div class="dropdown-menu" style="padding: 15px; padding-bottom: 15px;">
                <form method="post" action="register.php" accept-charset="UTF-8">
                  <input style="margin-bottom: 15px;" type="text" placeholder="Username" id="Username" name="Username">
                  <input style="margin-bottom: 15px;" type="password" placeholder="Password" id="Password" name="Password">
                  <input style="margin-bottom: 15px;" type="email" placeholder="Email" id="Email" name="Email">
                  <input class="btn btn-primary btn-block  btn-danger" type="submit" id="register" value="Register">
                  </form>
              </div>
            </li>

            <!-- Login Button -->
            <li class="dropdown">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown">Log In <strong class="caret"></strong></a>
              <div class="dropdown-menu" style="padding: 15px; padding-bottom: 15px;">
                <form action="login.php" method="post" accept-charset="UTF-8">
                  <input style="margin-bottom: 15px;" type="text" placeholder="Username" id="Username" name="Username">
                  <input style="margin-bottom: 15px;" type="password" placeholder="Password" id="Password" name="Password">
                  <input class="btn btn-primary btn-block" type="submit" id="sign-in" value="Sign In">
                  </form>
              </div>
            </li>
          </ul>
        </nav>
        <h3 class="text-muted">To-Do List</h3>
      </div>
<!-- End Nav Bar -->

<!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav" id="tasks">

        </ul>
    </div>
<!-- /#sidebar-wrapper -->

<!-- Start Main Body - Timeline -->
<!-- 
Modified Timeline template by Betul
http://codepen.io/betdream/pen/Ifvbi/
-->
  <div class="container">
  <ul class="timeline" id="taskList">

 </ul>
</div>


<form action="test.php" method="post" id="functionForm">
<input type="hidden" name="newTaskID" id="newTaskID">
<input type="hidden" name="newTaskListID" id="newTaskListID">
<input type="hidden" name="newUserID" id="newUserID" value="<?php echo htmlentities($_SESSION['User']['ID'], ENT_QUOTES, 'UTF-8'); ?>"/>
<input type="hidden" name="newCompleted" id="newCompleted">
<input type="hidden" name="newTitle" id="newTitle">
<input type="hidden" name="newBody" id="newBody">
<input type="hidden" name="Username" id="Username" value="<?php echo htmlentities($_SESSION['User']['Username'], ENT_QUOTES, 'UTF-8'); ?>"/>
</form>


<script>

function updateUserVariables(taskListID) {

  var newTaskListIDElement = document.getElementById("newTaskListID");
  newTaskListIDElement.value = taskListID;

}

function createNewTask() {

  var formElement = document.getElementById("functionForm");
  formElement.action = "createNewTask.php";
  
  var newTitleElement = document.getElementById("newTitle");
  newTitleElement.value = newTaskTitle.value;

  var newBodyElement = document.getElementById("newBody");
  newBodyElement.value = newTaskBody.value;

  newTitleElement.form.submit();

}

function createNewTaskList() {

  var formElement = document.getElementById("functionForm");
  formElement.action = "createNewTaskList.php";
  
  var newTitleElement = document.getElementById("newTitle");
  newTitleElement.value = newTaskTitle.value;

  newTitleElement.form.submit();

}


function toggleAddTask() {
  if (newtaskpanel.value == "hidden") {
    newtaskpanel.className = "";
    newtaskpanel.className = "popup";
    newtaskpanel.value = "visible";
  }
  else {
    newtaskpanel.className = "";
    newtaskpanel.className = "popup hidden";
    newtaskpanel.value = "hidden";
  }
}



function toggleComplete(complete, taskID, userID) {
  
  var formElement = document.getElementById("functionForm");
  formElement.action = "toggleComplete.php";

  var newTaskIDElement = document.getElementById("newTaskID");
  newTaskIDElement.value = taskID;

  var newUserIDElement = document.getElementById("newUserID");
  newUserIDElement.value = userID;

  var newCompletedElement = document.getElementById("newCompleted");
  newCompletedElement.value = !complete;

  newCompletedElement.form.submit();

}

function editTask(taskList, taskID, userID) {
  
  var taskTitle = document.getElementById(taskID +"-title");
  taskTitle.contentEditable = true;
  taskTitle.className += ' bg-warning'; 

  var taskBody = document.getElementById(taskID +"-body");
  taskBody.contentEditable = true;
  taskBody.className += ' bg-warning';

  var taskBtn = document.getElementById(taskID +"-btn");
  taskBtn.className = "";
  taskBtn.className = "btn btn-primary btn-sm btn-danger";
 
}

function submitEditTask (taskList, taskID, userID) {

  var formElement = document.getElementById("functionForm");
  formElement.action = "edit.php";
  
  var taskTitle = document.getElementById(taskID +"-title");
  var newTitleElement = document.getElementById("newTitle");
  newTitleElement.value = taskTitle.innerHTML;

  var taskBody = document.getElementById(taskID +"-body");
  var newBodyElement = document.getElementById("newBody");
  newBodyElement.value = taskBody.innerHTML;

  var taskBtn = document.getElementById(taskID +"-btn");
  taskBtn.className = "";
  taskBtn.className = "btn btn-primary btn-sm btn-danger hidden";

  var newTaskIDElement = document.getElementById("newTaskID");
  newTaskIDElement.value = taskID;

  var newUserIDElement = document.getElementById("newUserID");
  newUserIDElement.value = userID;

  newBodyElement.form.submit();

}

function deleteTask(taskList, taskID, userID) {

  var formElement = document.getElementById("functionForm");
  formElement.action = "delete.php";

  var newTaskIDElement = document.getElementById("newTaskID");
  newTaskIDElement.value = taskID;

  var newUserIDElement = document.getElementById("newUserID");
  newUserIDElement.value = userID;

  newUserIDElement.form.submit();

}

</script>


<!-- End Main Body - Timeline -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
