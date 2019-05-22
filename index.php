<?php

$con = mysqli_connect('localhost','root','','todo');
// check connection
if (!$con)
  {
  die ("Connection error: " . mysqli_connect_error());
  }

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
          <th>N</th>
          <th>Task</th>
          <th>Action</th>
         </tr>
       </thead>

       
       <tbody>
         <tr>
           <td>1</td>
           <td>This is the first task placeholder</td>
           <td>
             <a href="#">x</a>
           </td>
         </tr>
       </tbody>
     </table>
       

</body>
</html>