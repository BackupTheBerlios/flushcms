<?php use_helpers('I18N', 'Date') ?>
<div id="sf_admin_container">

<h1><?php echo __('�û�%%user_name%%��ϸ��Ϣ', 
array('%%user_name%%' => $users->getUserName())) ?></h1>

<fieldset id="sf_fieldset_________" class="">
<h2><?php echo __('������Ϣ') ?></h2>


<div class="form-row">
  <label for="users_user_name"><?php echo __('�û���:') ?></label>  
  <div class="content">
  <?=$users->getUserName()?>    
  </div>
</div>

<div class="form-row">
  <label for="users_user_name"><?php echo __('�Ա�:') ?></label>  
  <div class="content">
  <?=$users->getGender()=='F'?__("Ů"):__("��");?>    
  </div>
</div>

<div class="form-row">
  <label for="users_user_name"><?php echo __('Ȩ��:') ?></label>  
  <div class="content">
  <?=$users->getRoleId();?> &nbsp;   
  </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_________" class="">
<h2>������Ϣ</h2>

<div class="form-row">
  <label for="users_user_name"><?php echo __('�绰:') ?></label>  
  <div class="content">
  <?=$users->getPhone();?> &nbsp;   
  </div>
</div>

<div class="form-row">
  <label for="users_user_name"><?php echo __('��������:') ?></label>  
  <div class="content">
  <?=$users->getEmail();?> &nbsp;   
  </div>
</div>

<div class="form-row">
  <label for="users_user_name"><?php echo __('��ϸ��ַ:') ?></label>  
  <div class="content">
  <?=$users->getAddrees();?> &nbsp;   
  </div>
</div>

<div class="form-row">
  <label for="users_user_name"><?php echo __('��Ƭ:') ?></label>  
  <div class="content">
  <?php if($users->getPhoto()) echo image_tag('/'.sfConfig::get('sf_upload_dir_name').'/'.$users->getPhoto()) ?>&nbsp;    
  </div>
</div>

</fieldset>    

<ul class="sf_admin_actions">
  <li><?php echo button_to(__('�����б�'), 'users/list?id='.$users->getId(), array (
  'class' => 'sf_admin_action_list',
)) ?></li>
</ul>
</div>    