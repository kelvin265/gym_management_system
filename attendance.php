<?php 

?>

<div class="container-fluid">
	
	<div class="row">
	<div class="col-lg-12">
			<button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
	</div>
	</div>
	<br>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
			<b>Attendaance</b>
				<table class="table-striped table-bordered col-md-12">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Name</th>
					<th class="text-center">Attendance</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';

					date_default_timezone_set('Asia/Kolkata');
					//$current_date = date('Y-m-d h:i:s');
					$current_date = date('Y-m-d h:i A');
					$exp_date_time = explode(' ', $current_date);
					$todays_date =  $exp_date_time['0'];
					$q="select * from  members";
					$res = $conn->query($q);
					$i=1;
					while($row=mysqli_fetch_array($res)):

				 ?>
				 <tr>
				 	<td class="text-center">
				 		<?php echo $i++ ?>
				 	</td>
				 	<td><?php echo $row['firstname'];?> <?php echo $row['lastname'];?></td>
				 	


					<td><div class="row"><i class="fa fa-map-marker" style="font-size:50px;color:blue"></i>
						<div class="widget-thumb-body">
					<span class="widget-thumb-body-stat" data-counter="counterup" data-value="0" style="margin-left: 30%;"><?php echo $row['attendance_count'] ?></span><br>
					<span class="widget-thumb-subtitle uppercase"> Check In</span>
						</div></div>
					</td>

					<input type="hidden" name="member_id" value="<?php echo $row['member_id'];?>">

					<?php
					$q = "select * from tbl_attendance where curr_date = '$todays_date' AND member_id  = '".$row['member_id']."'";
					$result = $conn->query($q);
					$num_count  = mysqli_num_rows($result);
					$row_exist = mysqli_fetch_array($result);
					$curr_date = $row_exist['curr_date'];
					if($curr_date == $todays_date){
					
					?>
				 	 <td><label class="btn btn-primary" style="padding-top: 0px;height: 26px;"><?php echo $row_exist['curr_date'];?>  <?php echo $row_exist['curr_time'];?></label><br>
					<a href = "del_attendance.php?id=<?php echo $row_exist['member_id'] ;?>" class="btn btn-warning"><i class="fa fa remove"></i>REMOVE CHECK IN</a></td>
					</td>

					<?php } else {
						
					?>
					<td><a href="check_attendance.php?id=<?php echo $row['member_id'];?>"><button type="button" name="check_in" class="btn btn-success">CHECK IN</button></td>

					<?php }
					?>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>
<script>
	$('table').dataTable();
$('#new_user').click(function(){
	uni_modal('New User','manage_user.php')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
})
$('.assign_member').click(function(){
	uni_modal('Assign Member ','assign_member.php?id='+$(this).attr('data-id'))
})
$('.delete_user').click(function(){
		_conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
	})
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>