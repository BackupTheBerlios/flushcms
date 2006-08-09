<?php
  foreach ( sfConfig::get('app_categories') as $name => $module ) {
    $param = ($module == '@' . $sf_last_module) ? 'class=selected' : '';
    echo "<span>".link_to(__($name), $module, $param)."&nbsp;&nbsp;&nbsp;&nbsp;</span>";
  }
?>