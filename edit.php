<?php
if(!empty($_GET['update']))
{
    include("db_connect.php");
    $u=$_GET['u'];
    $e=$_GET['e'];
    $s=$_GET['s'];
    $r=$_GET['r'];
$update="update exam
set exam_date='$e', score='$s', remark='$r' where (user=$u)";
mysqli_query($con,$update);
print "<script>
    alert('Record Updated');
    </script>";
    header("Location:display.php");
}
?>