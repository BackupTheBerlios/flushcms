<?php
$RootDir = dirname(__FILE__)."/"; 
$IncludeDir = $RootDir."includes/";
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') 
{
    $separator = ";";
} 
else 
{
    $separator = ":";
}

ini_set('include_path', ".{$separator}".$IncludeDir."pear");

?>