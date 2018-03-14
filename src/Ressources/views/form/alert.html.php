

      <?php if($error || $success):?>
      <div class="<?= $error ? "alert alert-danger":"alert alert-success" ?>">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <strong><?= $error ? $error->getMessage() : $success ?></strong>
      </div>
     <?php endif;?>
	 
