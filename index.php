<?php
// Starting session
session_start();
?>


<!DOCTYPE html>
<html>
<body>


<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" id="form">

<input type="text" name="task">
<button type="submit" name="submit">Submit</button>

</form>
<?php

$_SESSION["task"]= $_POST["task"];

echo $_SESSION["task"];




?>


</body>
</html>