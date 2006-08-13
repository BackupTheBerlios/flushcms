<h2>Authentication</h2>
 
<?php if ($sf_request->hasErrors()): ?>
  Identification failed - please try again
<?php endif ?>
 
<?php echo form_tag('security/login') ?>
  <label for="login">login:</label>
  <?php echo input_tag('login', $sf_params->get('login')) ?>
 
  <label for="password">password:</label>
  <?php echo input_password_tag('password') ?>
 
  <?php echo submit_tag('submit', 'class=default') ?>
</form>
