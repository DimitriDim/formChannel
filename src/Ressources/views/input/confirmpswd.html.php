     
      <p class="name">
        <input name="<?=\App\Form\Form::PSW_CONFIRM_NAME?>" 
        	   type="text" 
        	   class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" 
        	   value="<?= (string) filter_input(INPUT_POST, \App\Form\Form::PSW_CONFIRM_NAME,FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>" 
        	   placeholder="Confirm"/>
      </p>