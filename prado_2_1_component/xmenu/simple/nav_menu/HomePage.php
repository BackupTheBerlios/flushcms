<?php
/*
 * Created on May 10, 2006
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class HomePage extends TCallbackPage
{
	
	public function clickMe($sender, $param)
	{
		echo "ddddd";

		if ($param instanceof TCommandEventParameter)
			$sender->Text = "Name: {$param->name} , Param:{$param->parameter} ";

		else
			$sender->Text = "I'm clicked";

	}
	
	public function buttonClicked($sender, $param)
	{

		if ($param instanceof TCommandEventParameter)
			$sender->Text = "Name: {$param->name} , Param:{$param->parameter} ";

		else
			$sender->Text = "I'm clicked";

	}
  
}
?>
