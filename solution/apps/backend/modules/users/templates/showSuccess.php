<?php use_helpers('I18N', 'Date') ?>
<div id="sf_admin_container">

<h1><?php echo __('用户%%user_name%%详细信息', 
array('%%user_name%%' => $users->getUserName())) ?></h1>

<fieldset id="sf_fieldset_________" class="">
<h2><?php echo __('基本信息') ?></h2>


<div class="form-row">
  <label for="users_user_name"><?php echo __('用户名:') ?></label>  
  <div class="content">
  <?=$users->getUserName()?>    
  </div>
</div>

<div class="form-row">
  <label for="users_user_name"><?php echo __('性别:') ?></label>  
  <div class="content">
  <?=$users->getGender()=='F'?__("女"):__("男");?>    
  </div>
</div>

<div class="form-row">
  <label for="users_user_name"><?php echo __('权限:') ?></label>  
  <div class="content">
  <?=$users->getRoleId();?> &nbsp;   
  </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_________" class="">
<h2>附加信息</h2>

<div class="form-row">
  <label for="users_user_name"><?php echo __('电话:') ?></label>  
  <div class="content">
  <?=$users->getPhone();?> &nbsp;   
  </div>
</div>

<div class="form-row">
  <label for="users_user_name"><?php echo __('电子邮箱:') ?></label>  
  <div class="content">
  <?=$users->getEmail();?> &nbsp;   
  </div>
</div>

<div class="form-row">
  <label for="users_user_name"><?php echo __('详细地址:') ?></label>  
  <div class="content">
  <?=$users->getAddrees();?> &nbsp;   
  </div>
</div>

<div class="form-row">
  <label for="users_user_name"><?php echo __('照片:') ?></label>  
  <div class="content">
  <?php if($users->getPhoto()) echo image_tag('/'.sfConfig::get('sf_upload_dir_name').'/'.$users->getPhoto()) ?>&nbsp;    
  </div>
</div>

</fieldset>    

<ul class="sf_admin_actions">
  <li><?php echo button_to(__('返回列表'), 'users/list?id='.$users->getId(), array (
  'class' => 'sf_admin_action_list',
)) ?></li>
</ul>
</div>    