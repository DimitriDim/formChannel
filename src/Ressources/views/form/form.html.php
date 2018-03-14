
<form class="form" id="signup" method="POST" action="">
	<p class="email">
		<input name="<?=\App\Form\Form::EMAIL_NAME?>" type="text"
			class="validate[required,custom[email]] feedback-input"
			value="<?= (string) filter_var($user->email, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>"
			placeholder="Email" />
	</p>

	<p class="name">
		<input name="<?=\App\Form\Form::PSW_NAME?>" type="password"
			class="validate[required,custom[onlyLetter],length[0,100]] feedback-input"
			value="<?= (string) filter_var($user->pswd,FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>"
			placeholder="Password" />
	</p>
      
      <?php if(strpos(filter_input(INPUT_SERVER, "REDIRECT_URL"),"signup")):?>
		<?php include  __DIR__ . "/../input/confirmpswd.html.php"; ?>
 		<?php endif;?>
      <input type="hidden" name="token" value="<?= $token ?>">
	<div class="submit">
		<input type="submit" value="SEND" id="button-blue" />
		<div class="ease"></div>
	</div>
</form>
