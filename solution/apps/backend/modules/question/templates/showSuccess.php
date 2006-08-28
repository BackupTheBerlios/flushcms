<?php use_helpers('I18N', 'Date','Text') ?>
<div id="sf_admin_container">

<?php include_partial('question/list_tab') ?>

<h1><?php echo __('问题%%question%%详细信息', 
array('%%question%%' => $question->getQuestion())) ?></h1>

<fieldset id="sf_fieldset_________" class="">
<h2><?php echo __('问题') ?></h2>


<div class="form-row">
  <?=$question->getQuestion()?>    
</div>

</fieldset>

<fieldset id="sf_fieldset_________" class="">
<h2><?php echo __('解决方案') ?></h2>

<div class="form-row">
  <?php
  $i=0; 
  foreach ($solutions as $solution):
  $i++; 
  ?>
    <div class="solution" style="margin-bottom:10px;">
      <?php
      echo count($solutions)>1?$i.".":""; 
      echo simple_format_text($solution->getSolution()); 
      ?><br/>
    </div>    
  <?php endforeach ?>     
</div>


</fieldset>    

<ul class="sf_admin_actions">
  <li><?php echo button_to(__('返回列表'), 'question/list?id='.$question->getId(), array (
  'class' => 'sf_admin_action_list',
)) ?></li>
</ul>
</div>    