<center><h1>List of Record</h1></center>
<center><p>Today is <?php print date("F j, Y, g:i a");?></p></center>
<table border=1 align=center>
<tr><th>Exam Date
    <th>User
    <th>Score
    <th>Remark
    <th>Edit
    <th>Delete
<?php
inclue ("db_connect.php");
$view="select * from exam";
$result=mysqli_query($con,$view);
$count=mysqli_num_rows($result);
while ($rec=mysqli_fetch_array($result,MYSQLI_ASSOC))
{
    $exam_date=$rec['exam_date'];
    $user=$rec['user'];
    $score=$rec['score'];
    $remark=$rec['remark'];
    print "<tr><Td>$exam_date<td>$user<td>$score<td>$remark<td><a href='update.php?exam_date=$exam_date&user&score=$score=$score&remark=$remarks'><img src=edit.png width=15 height=15 align center></a><td><a href='delete.php?user=$user' align=center><img src=delete.jpg width=15 height=15 align=center></a>";
}
print "</table><center>$count record/s";
?>
<p><a href=insert.php>Insert Record</a>&nbsp;&nbsp;<a href=search.php>Search Records</a>