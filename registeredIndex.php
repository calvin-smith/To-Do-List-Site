<?php 
//Built from SQL login tutorial by E-Oreo
//http://forums.devshed.com/php-faqs-stickies-167/program-basic-secure-login-system-using-php-mysql-891201.html


    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
    // At the top of the page we check to see whether the user is logged in or not 
    if(empty($_SESSION['User'])) 
    { 

        // If they are not, we redirect them to the login page. 
      header("Location: index.php"); 
    }
    else {  

        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
      header("Redirecting to registeredIndex.php"); 
    
    }
?>

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
            <li class="bold" role="presentation"><a href="#"><strong><?php echo htmlentities($_SESSION['User']['Username'], ENT_QUOTES, 'UTF-8'); ?></strong></a></li>
            <!-- Logout Button -->
            <li role="presentation"><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">To-Do List</h3>
      </div>
<!-- End Nav Bar -->

<!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav" id="tasks">

          <script>

          var xmlhttpList = new XMLHttpRequest();
          var urlList = "http://info3103.cs.unb.ca/u9b6y/project/getTaskList.php";

          xmlhttpList.onreadystatechange=function() {
              if (xmlhttpList.readyState == 4 && xmlhttpList.status == 200) {
                  generateTasks(xmlhttpList.responseText);
              }
          }
          xmlhttpList.open("GET", urlList, true);
          xmlhttpList.send();

          function generateTasks(response) {
            var arrList = JSON.parse(response);
              var outList = "";
              var i;

              
              for(i = 0; i < arrList.length; i++) {
                    outList +=
                    '<li><a id="'
                    + arrList[i].Task_list_ID
                    + '" title="'
                    + arrList[i].Title
                    + '" href="#'
                    + '" onclick="generateTimeline('
                    + arrList[i].Task_list_ID
                    + ', '
                    + arrList[i].User_ID
                    + ')";return false;">'
                    + arrList[i].Title
                    + '</a></li>';
                    
              }
             
              document.getElementById("tasks").innerHTML = outList;
          }
          </script>

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

<script>
  function generateTimeline (TaskListID, userID) {
    var selectedTaskList = TaskListID;
    var selectedTaskListUser = userID;
    
    updateUserVariables(TaskListID, selectedTaskListUser);

    var xmlhttp = new XMLHttpRequest();
    var url = "http://info3103.cs.unb.ca/u9b6y/project/getTasks.php";

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            generateTaskList(xmlhttp.responseText, selectedTaskList);
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send();

    function generateTaskList(response, TaskListID) {
      var arr = JSON.parse(response);
        var out = "";
        var inverted = "";
        var completed = "";
        var i;
        var counter = 0;
        

        for(i = 0; i < arr.length; i++) {
          if (arr[i].Task_List == TaskListID) {

            if (counter % 2 == 0) {
              inverted += '<li>';
            }
            else {
              inverted += '<li class="timeline-inverted">';
            }

            if (arr[i].Completed == 1) {
              completed = "complete";
            }
            else {
              completed = "incomplete";
            }


            out += 
            inverted
            + '<div class="timeline-badge ' 
            + completed
            + '"><i class="glyphicon glyphicon-check"></i></div><div class="timeline-panel"><div class="timeline-heading"><h4 class="timeline-title" id="'
            + arr[i].Task_ID
            + '-title">'
            + arr[i].Task_Name
            + '</h4></div><div class="timeline-body"><p id="'
            + arr[i].Task_ID
            + '-body">'
            + arr[i].Task_Description 
            + '</p><hr><div class="btn-group"><button type="button" class="btn btn-primary btn-sm dropdown-toggle button '
            + completed
            + '" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> <span class="caret"></span></button><ul class="dropdown-menu" role="menu">'
            + '<li><a href="#" onclick="toggleComplete('
            + arr[i].Completed
            + ', '
            + arr[i].Task_ID
            + ', '
            + arr[i].User_ID
            + ')";return false;">'
            + 'Toggle Completed'
            + '</a>'
            + '<li><a href="#" onclick="editTask('
            + arr[i].Task_List
            + ', '
            + arr[i].Task_ID
            + ', '
            + arr[i].User_ID
            + ')";return false;">'
            + 'Edit'
            + '</a>'
            + '<li><a href="#" onclick="deleteTask('
            + arr[i].Task_List
            + ', '
            + arr[i].Task_ID
            + ', '
            + arr[i].User_ID
            + ')";return false;">'
            + 'Delete'
            + '</a></li></ul></div><button type="button" class="btn btn-primary btn-sm btn-danger hidden" id="'
            + arr[i].Task_ID
            + '-btn" onclick="submitEditTask('
            + arr[i].Task_List
            + ', '
            + arr[i].Task_ID
            + ', '
            + arr[i].User_ID
            + ')">Submit Edit</button></div></div></li>';
            
            counter += 1;
          }
          
        }

      document.getElementById("taskList").innerHTML = out;
    }
  }
</script>
 </ul>
</div>

<!-- NEW TASK PANEL -->
<div class="popup hidden" id="newtaskpanel" value="hidden">
   <form method="post" accept-charset="UTF-8" id="newTaskForm" name="newTaskForm">
                  <input style="margin-bottom: 15px; width: 100%;" type="text" placeholder="Title" id="newTaskTitle" name="newTaskTitle">
                  <textarea style="margin-bottom: 15px; width: 100%; resize: none;" rows="5" id="newTaskBody" name="newTaskBody" placeholder="Your task"></textarea>
                  <div style="margin-bottom: 15px; margin-right: 15px; resize: none;">
                    <input style="display:inline-block; width: 40%; float: left" class="btn btn-primary btn-block btn-success" type="" id="newTask" value="Create Task" onclick="createNewTask()">
                    <input style="display:inline-block; width: 40%; float: right" class="btn btn-primary btn-block btn-success" type="" id="newTaskList" value="Create Task List" onclick="createNewTaskList()">
                  </div>
                  </form>

</div>
<button type="button" class="btn btn-info btn-circle btn-xl" id="newtaskbutton" onclick="toggleAddTask()"><i class="glyphicon glyphicon-ok"></i></button>
<button type="button" class="btn btn-info btn-circle btn-xl" id="deletetaskbutton" onclick="deleteTaskList()"><i class="glyphicon glyphicon-trash"></i></button>
<!--style="margin-bottom: 15px; margin-right: 15px; resize: none;" -->
<!-- END NEW TASK PANEL -->


<form action="test.php" method="post" id="functionForm">
<input type="hidden" name="newTaskID" id="newTaskID">
<input type="hidden" name="selectedTaskListCreator" id="selectedTaskListCreator" value="">
<input type="hidden" name="newTaskListID" id="newTaskListID" value="">
<input type="hidden" name="newUserID" id="newUserID" value="<?php echo htmlentities($_SESSION['User']['ID'], ENT_QUOTES, 'UTF-8'); ?>"/>
<input type="hidden" name="newCompleted" id="newCompleted">
<input type="hidden" name="newTitle" id="newTitle">
<input type="hidden" name="newBody" id="newBody">
<input type="hidden" name="Username" id="Username" value="<?php echo htmlentities($_SESSION['User']['Username'], ENT_QUOTES, 'UTF-8'); ?>"/>
</form>


<script>

function updateUserVariables(taskListID, userID) {

  document.getElementById("newTaskListID").value = taskListID;

  document.getElementById("selectedTaskListCreator").value = userID;
  
}

function createNewTask() {

  var formElement = document.getElementById("functionForm");
  formElement.action = "createNewTask.php";
  
  var newTitleElement = document.getElementById("newTitle");
  newTitleElement.value = newTaskTitle.value;

  var newBodyElement = document.getElementById("newBody");
  newBodyElement.value = newTaskBody.value;
  
  var selectedTaskListCreatorElement = document.getElementById("selectedTaskListCreator");
  var newUserIDElement = document.getElementById("newUserID");

  if (newUserIDElement.value != selectedTaskListCreatorElement.value) {
    window.alert("You're not authorized to perform this function.");
  }
  
  else {
    newTitleElement.form.submit();
  }

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

  if (newUserIDElement.value == userID) {
  newBodyElement.form.submit();
  }
  
  else {
  window.alert("You're not authorized to perform this function.");
  }
}

function deleteTask(taskList, taskID, userID) {

  var formElement = document.getElementById("functionForm");
  formElement.action = "delete.php";

  var newTaskIDElement = document.getElementById("newTaskID");
  newTaskIDElement.value = taskID;

  var newUserIDElement = document.getElementById("newUserID");

  if (newUserIDElement.value == userID) {
  newUserIDElement.form.submit();
  }
  
  else {
  window.alert("You're not authorized to perform this function.");
  }

}

function deleteTaskList() {

  var formElement = document.getElementById("functionForm");
  formElement.action = "deleteTaskList.php";
  var newTaskListIDElement = document.getElementById("newTaskListID");
  
  var newUserIDElement = document.getElementById("newUserID");
  
  var selectedTaskListCreatorElement = document.getElementById("selectedTaskListCreator");

  if (newTaskListIDElement.value == "unset") {
    console.log("Error: No ID selected");
  }
  
  else if (newUserIDElement.value != selectedTaskListCreatorElement.value) {
    window.alert("You're not authorized to perform this function.");
  }
  
  else {
    newTaskListIDElement.form.submit();
  }
}

</script>


<!-- End Main Body - Timeline -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
