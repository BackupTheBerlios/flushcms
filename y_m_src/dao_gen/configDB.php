<?php
require_once'DB/DataObject.php';
$config=parse_ini_file('example.ini',TRUE);

foreach($config as $class=>$values){
$options=&PEAR::getStaticProperty($class,'options');
$options=$values;
}
?>