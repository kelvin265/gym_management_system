<?php
session_start();
include('db_connect.php');
 date_default_timezone_set('Asia/Kolkata');
 //$current_date = date('Y-m-d h:i:s');
    $current_date = date('Y-m-d h:i A');
   $exp_date_time = explode(' ', $current_date);
 $curr_date =  $exp_date_time['0'];
 $curr_time =  $exp_date_time['1']. ' ' .$exp_date_time['2'];
 //extract($_POST);

$member_id = $_GET['id'];

/*$q = "select * from tbl_attendance where user_id='$user_id' AND curr_date = '$curr_date'";
$result = $conn->query($q);
$num_count  = mysqli_num_rows($result);
if($num_count > 0)
{

 $_SESSION['error']='Already Check In';
?>
<script type="text/javascript">
window.location="../attendance.php";
</script>
<?php
}*/
 //else {


   $sql = "INSERT INTO  tbl_attendance (member_id, curr_date,curr_time)
   VALUES ('$member_id','$curr_date','$curr_time')";


 if ($conn->query($sql) === TRUE) {
   $attend_count = 0;
  $attend = "select * from members where member_id = '$member_id'";
  $result_attend = $conn->query($attend);
  $row_attend = mysqli_fetch_array($result_attend);
   $cnt = $row_attend['attendance_count'];
$attend_count = $attend_count + 1;
     $sql1 = "update members set attendance_count ='$attend_count' where member_id = '$member_id'";
     $conn->query($sql1) ;

   
     // $_SESSION['success']='Record Successfully Added';
      
     ?>
<script type="text/javascript">
window.location="index.php?page=attendance";
</script>
<?php
} else {
   
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="index.php?page=attendance";
</script>
<?php
}


//}



 

//}

?>