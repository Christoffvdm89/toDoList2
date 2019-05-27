<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$con = mysqli_connect('localhost','root','','todo');
// check connection
if (!$con){
  die ("Connection error: " . mysqli_connect_error());
  }

//add task,date
if(isset($_POST['submit'])){  
$task = $_POST['task']; 
$date = $_POST['date']; 
$sql = "INSERT INTO tasks (task,date) VALUES('$task','$date')";

if (mysqli_query($con, $sql)){
  echo "Record inserted successfully";
}else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
header("location: index.php");
}


//delete task
if(isset($_GET['del_task'])){  
  $id = $_GET['del_task']; 
  $sql2 = "DELETE FROM tasks WHERE id=$id";
  
if (mysqli_query($con, $sql2)){
  echo "Record deleted successfully";
}else{
  echo "ERROR: Could not able to execute $sql2. " .
  mysqli_error($link);
}
header("location: index.php");
}

// update task
if(isset($_POST['update'])){  
  $id_n = $_POST['id_update']; 
  $task_n = $_POST['task_update']; 
  $date_n = $_POST['date_update']; 
  $sql4 = "UPDATE tasks SET task='$task_n', date='$date_n'   WHERE id=$id_n";
  
if (mysqli_query($con, $sql4)){
  echo "Record deleted successfully";
}else{
  echo "ERROR: Could not able to execute $sql4. " .
  mysqli_error($link);
}
header("location: index.php");
}


// select tasks from database
$sql3= "SELECT * FROM tasks ORDER BY task";
$tasks = mysqli_query($con,$sql3);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>

    <div class="heading">
    <h1>Todo list application with PHP and MySQL</h1>
    </div>

    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" id="form">  
         Task<label for="task"><input type="text" name="task" placeholder="task"></label>
         <br>
         Due date<label for="date"><input type="date" name="date"></label>
         <br>
         <button type="submit" name="submit">Add Task</button>
         <br>
         Update Id<label for="id_update"><input type="text" name="id_update"></label>
         <br>
         Task<label for="task_update"><input type="text" name="task_update" placeholder="task"></label>
         <br>
         Due date<label for="date_update"><input type="date" name="date_update"></label>
         <br>
         <button type="submit" name="update">Update Task</button>

     </form>

     <table>
       <thead>
         <tr>
          <th>No</th>
          <th>ID</th>
          <th>Task</th>
          <th>Date</th>
          <th>Action</th>
         </tr>
       </thead>

       
       <tbody>
       <?php $i=1; while ($row = mysqli_fetch_array($tasks)) {?>
        <tr>
           <td><?php echo $i;?></td>
           <td><?php echo $row['id']?></td>
           <td><?php echo $row['task']?></td>
           <td><?php echo $row['date']?></td>
           <td>
           <a href="index.php?del_task= <?php echo $row['id'];?>">x</a>
           </td>
         </tr>
       <?php $i++; } ?>
       </tbody>
     </table>
          
</body>
</html>