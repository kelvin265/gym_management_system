<?php
session_start();
include('db_connect.php');

$member_id= $_GET['id'];


 $sql = "DELETE FROM tbl_attendance WHERE member_id='".$_GET["id"]."'";
$res = $conn->query($sql) ;


 $attend = "select * from members where member_id = '$member_id'";
  $result_attend = $conn->query($attend);
  $row_attend = mysqli_fetch_array($result_attend);
  $cnt = $row_attend['attendance_count'];
 $attend_count = $cnt  - 1;
      $sql1 = "update members set attendance_count ='$attend_count' where member_id='$member_id'";
     $conn->query($sql1) ;
?>
<script>
//alert("Delete Successfully");
window.location = "index.php?page=attendance";
</script>


 