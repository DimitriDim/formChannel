
<div class="text-center">
<img src="http://www.echoparkpaper.com/images/logos/Welcome_Home_Logo.jpg" alt="mon_image"/>


                      <?php if($_SESSION["user"]->role != \App\Role\Role::VISITOR_VALUE): ?>
                      <p>Welcome <?= $_SESSION["user"]->email ?> </p>
                      <?php endif;?>
                      
</div>