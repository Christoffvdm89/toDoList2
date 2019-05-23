<?php

$con = mysqli_connect('localhost','root','','todo');
// check connection
if (!$con){
  die ("Connection error: " . mysqli_connect_error());
  }

//add task
if(isset($_POST['submit'])){  
$task = $_POST['task']; 
$sql = "INSERT INTO tasks (task) VALUES('$task')";

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



// select tasks from database
$sql3= "SELECT * FROM tasks";
$tasks = mysqli_query($con,$sql3);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo list application with PHP and MySQL</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <div class="heading">
    <h1>Todo list application with PHP and MySQL</h1>
    </div>

    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" id="form">  
         <input type="text" name="task">
         <button type="submit" name="submit">Add Task</button>

     </form>

     <table>
       <thead>
         <tr>
          <th>Id</th>
          <th>Task</th>
          <th>Action</th>
         </tr>
       </thead>

       
       <tbody>
       <?php while ($row = mysqli_fetch_array($tasks)) {?>
        <tr>
           <td><?php echo $row['id']?></td>
           <td><?php echo $row['task']?></td>
           <td>
           <a href="index.php?del_task= <?php echo $row['id'];?>">x</a>
           </td>
         </tr>
       <?php } ?>
       </tbody>
     </table>
       

</body>
</html>