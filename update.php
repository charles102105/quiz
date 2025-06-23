<?php
include ("db_connect.php");
$e=$_GET['exam_date'];
$u=$_GET['user'];
$s=$_GET['score'];
$r=$_GET['remark'];
print"<form action=update.php>
      <table border=1>
      <TR>TD>exam date<TD><input name=exam_date value=$e>
      <TR><TD>user<TD><input name=user value=$u readonly>
      <TR><TD>score<TD><input name=score value=$s>
      <TR><TD>remark<TD><input name=remark value=$r>
      <TR><TD>colspan=2><input type=submit value="Update Now" name=update>
</table></form>";
?>