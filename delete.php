<?php
$user=$_GET['user'];
include ("db_connect.php");
$del="DELETE from exam where (user='$user');
mysqli_query($con,$del);
print "<script>
        alert ('Record Deleted!!!');
        </script>";
        header("Location:display.php");
?>