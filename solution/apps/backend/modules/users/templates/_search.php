<?php echo form_tag('users') ?>
  <label for="item">Keyword :</label>
  <?php echo input_tag('q',$sf_params->get('q')) ?>
  <?php echo select_tag('gender', options_for_select(Array('' => '��', 'M' => '��', 'F' => 'Ů'), $sf_params->get('gender'))) ?>
  <?php echo submit_tag('Search') ?>
</form>
