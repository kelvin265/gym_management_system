<?php 
include('db_connect.php');
session_start();
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">
	<div id="msg"></div>
	
	<form action="" id="manage-user">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label class="control-label">Member</label>
			<select name="member_id" required="required" class="custom-select select2" id="">
				<option value=""></option>
				<?php
					$qry = $conn->query("SELECT * FROM members order by firstname asc");
					while($row= $qry->fetch_assoc()):
				?>
				<option value="<?php echo $row['member_id'] ?>" <?php echo isset($plan_id) && $plan_id == $row['member_id'] ? 'selected' : '' ?>><?php echo ucwords($row['firstname']) ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		

	</form>
</div>
<script>
	
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=assign_member',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else if(resp == 2){
					$('#msg').html('<div class="alert alert-danger">user already assigned to another member</div>')
					end_load()
				}else if(resp == 3){
					$('#msg').html('<div class="alert alert-danger">Please choose member</div>')
					end_load()
				}
			}
		})
	})

</script>