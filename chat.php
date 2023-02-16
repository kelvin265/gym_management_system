<?php 
  if(!isset($_SESSION['login_id'])){
    header("location: index.php?page=login");
  }
?>
<?php include('db_connect.php');?>
<div class="container-fluid">
	
	<div class="col-lg-12">
	<section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: index.php?page=chatForum");
          }
        ?>
        <a href="index.php?page=chatForum" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/profile.jpg" alt="">
        <div class="details">
          <span><?php echo $row['name'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>
	</div>	

</div>


<script src="javascript/chat.js"></script>
