<?php include  __DIR__ . "/../header/header.signup.html.php"; ?>



<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
  
    <li class="active">
    <a>My channel</a>
    </li>
    
    <li>
    <a href="channels">Channels</a>
    </li>
    
  </ul>
  
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
    
    <div class="col-md-4">
    <br>
    <br>
    <br>
		<center>
		<h1> New channel </h1>
		</center>
	 <?php include  __DIR__ . "/../form/alert.html.php"; ?>
     <?php include  __DIR__ . "/../form/channel.form.php"; ?>
     
    </div>
    
        <div class="col-md-4">
    <br>
    <br>
    <br>
		<center>
		<h1> My channels </h1>
		</center>

     <?php include  __DIR__ . "/listChannel.php"; ?>
     
    </div>

    
    <div class="tab-pane" id="tab2">

      
    </div>
  </div>
</div>



<?php include  __DIR__ . "/../footer/footer.signup.html.php"; ?>