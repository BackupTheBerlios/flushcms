<?php
  foreach ( sfConfig::get('app_categories') as $name => $module ) {
    $param = ($module == '@' . $sf_last_module) ? 'class=selected' : '';
    echo link_to(__($name), $module, $param);
  }
?>