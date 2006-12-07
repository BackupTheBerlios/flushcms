<?php
/**
 *
 * common.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: common.php,v 1.8 2006/12/07 23:45:19 arzen Exp $
 */
 
$GenderOption = array(	
			''=>$i18n->_('All'),
			'm'=>"<FONT COLOR=\"#6600FF\">".$i18n->_('Male')."</FONT>",
			'f'=>"<FONT COLOR=\"#FF0000\">".$i18n->_('Female')."</FONT>",
			);
			
$DebitOption = array(	
			''=>$i18n->_('All'),
			'I'=>"<FONT COLOR=\"#6600FF\">".$i18n->_('Income')."</FONT>",
			'P'=>"<FONT COLOR=\"#FF0000\">".$i18n->_('Payout')."</FONT>",
			);
			
$ActiveOption = array(	
			''=>$i18n->_('All'),
			'new'=>"<FONT COLOR=\"#6600FF\">".$i18n->_('New')."</FONT>",
			'live'=>"<FONT COLOR=\"#006600\">".$i18n->_('Live')."</FONT>",
			'deleted'=>"<FONT COLOR=\"#FF0000\">".$i18n->_('Deleted')."</FONT>",
			);
			
$StateOption = array(	
			'pending'=>"<FONT COLOR=\"#6600FF\">".$i18n->_('Pending')."</FONT>",
			'start'=>"<FONT COLOR=\"#006600\">".$i18n->_('Start')."</FONT>",
			'10'=>"10%",
			'20'=>"20%",
			'30'=>"30%",
			'40'=>"40%",
			'50'=>"50%",
			'60'=>"60%",
			'70'=>"70%",
			'80'=>"80%",
			'90'=>"90%",
			'close'=>"<FONT COLOR=\"#FF0000\">".$i18n->_('Close')."</FONT>",
			);

for ($index = 0; $index < 24; $index++) 
{
	$TimeOption[$index.":00:00"]=$index.":00";
}			

function logFileString ($string) 
{
	global $i18n,$AddIP,$userid,$group_ids,$logger,$user_name;
	
	$log_format = "{$string}\t{$AddIP}\t$user_name\t{$userid}";
	$logger->log($log_format);
	
}
?>
