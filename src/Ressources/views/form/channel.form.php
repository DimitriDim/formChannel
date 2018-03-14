
<form class="form" id="signup" method="POST" action="">
	<p class="name">
		<input name="<?=\App\Form\Form::CHANNEL_NAME?>" type="text"
			class="validate[required,custom[email]] feedback-input"
			value="<?=filter_input(INPUT_POST,\App\Form\Form::CHANNEL_NAME,FILTER_SANITIZE_SPECIAL_CHARS)?>"
			placeholder="Nom du channel" />
	</p>

	<p class="name">
		<input name="<?=\App\Form\Form::CHANNEL_DESCR?>" type="text"
			class="validate[required,custom[onlyLetter],length[0,100]] feedback-input"
			value="<?=filter_input(INPUT_POST,\App\Form\Form::CHANNEL_DESCR,FILTER_SANITIZE_SPECIAL_CHARS) ?>"
			placeholder="Decription" />
	</p>
      
      	<p class="name text-center">
		<input name="<?=\App\Form\Form::CHANNEL_CAPACITY?>" type="number" step="1" value="1" min="1" max="99">
	</p>
     <input type="hidden" name="token" value="<?= $user->token ?>">
	<div class="submit">
		<input type="submit" value="Create" id="button-blue" />
		<div class="ease"></div>
	</div>
</form>

