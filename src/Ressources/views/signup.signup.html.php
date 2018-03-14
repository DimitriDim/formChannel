

<?php include  __DIR__ . "/header/header.signup.html.php"; ?>



<div id="form-div">
<center>
<h1> Sign Up </h1>
</center>



<?php include  __DIR__ . "/form/alert.html.php"; ?>

<?php if(!$success):?>

<?php include  __DIR__ . "/form/form.html.php"; ?>

<?php else:?>

<a class="btn btn-primary" href="/formation-php/web/signin" class="btn btn-success">Sign in</a>

<?php endif;?>

</div>
  
<?php include  __DIR__ . "/footer/footer.signup.html.php"; ?>
