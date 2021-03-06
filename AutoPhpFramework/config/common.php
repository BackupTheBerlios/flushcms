<?php
/**
 *
 * common.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: common.php,v 1.11 2006/12/10 00:29:56 arzen Exp $
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

$AccessOption = array(	
			''=>$i18n->_('All'),
			'public'=>"<FONT COLOR=\"#6600FF\">".$i18n->_('Public')."</FONT>",
			'private'=>"<FONT COLOR=\"#006600\">".$i18n->_('Private')."</FONT>",
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

$OrderStateOption = array(	
			''=>$i18n->_('All'),
			'handling'=>"<FONT COLOR=\"#6600FF\">".$i18n->_('StateHandling')."</FONT>",
			'delivery'=>"<FONT COLOR=\"#3399CC\">".$i18n->_('StateDelivery')."</FONT>",
			'cancel'=>"<FONT COLOR=\"#FF0000\">".$i18n->_('StateCancel')."</FONT>",
			'finish'=>"<FONT COLOR=\"#336633\">".$i18n->_('StateFinish')."</FONT>",
			'prepay'=>"<FONT COLOR=\"#FF9900\">".$i18n->_('StatePrepay')."</FONT>",
			'waitpay'=>"<FONT COLOR=\"#996600\">".$i18n->_('StateWaitpay')."</FONT>",
			);

$ComplaintsStateOption = array(	
			''=>$i18n->_('All'),
			'handling'=>"<FONT COLOR=\"#6600FF\">".$i18n->_('StateHandling')."</FONT>",
			'cancel'=>"<FONT COLOR=\"#FF0000\">".$i18n->_('StateCancel')."</FONT>",
			'finish'=>"<FONT COLOR=\"#336633\">".$i18n->_('StateFinish')."</FONT>",
			);

$PaywayOption = array(	
			''=>$i18n->_('All'),
			'cash'=>"<FONT COLOR=\"#336633\">".$i18n->_('PaywayCash')."</FONT>",
			'week'=>"<FONT COLOR=\"#FF0000\">".$i18n->_('PaywayWeek')."</FONT>",
			'month'=>"<FONT COLOR=\"#CCCC00\">".$i18n->_('PaywayMonth')."</FONT>",
			'quarter'=>"<FONT COLOR=\"#FF9900\">".$i18n->_('PaywayQuarter')."</FONT>",
			'year'=>"<FONT COLOR=\"#3399CC\">".$i18n->_('PaywayYear')."</FONT>",
			);

$DeliverywayOption = array(	
			''=>$i18n->_('All'),
			'visiting'=>"<FONT COLOR=\"#3399CC\">".$i18n->_('DeliverywayVisiting')."</FONT>",
			'network'=>"<FONT COLOR=\"#996600\">".$i18n->_('DeliverywayNetwork')."</FONT>",
			'land'=>"<FONT COLOR=\"#6600FF\">".$i18n->_('DeliverywayLand')."</FONT>",
			'ocean'=>"<FONT COLOR=\"#CCCC00\">".$i18n->_('DeliverywayOcean')."</FONT>",
			'air'=>"<FONT COLOR=\"#FF0000\">".$i18n->_('DeliverywayAir')."</FONT>",
			);

$ReviewwayOption = array(	
			''=>$i18n->_('All'),
			'phone'=>"<FONT COLOR=\"#6600FF\">".$i18n->_('ReviewwayPhone')."</FONT>",
			'network'=>"<FONT COLOR=\"#FF0000\">".$i18n->_('ReviewwayNetwork')."</FONT>",
			'visit'=>"<FONT COLOR=\"#336633\">".$i18n->_('ReviewwayVisit')."</FONT>",
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

function registerGlobalVar ($key,$value) 
{
	global $global_arr;
	$global_arr[$key]=$value;
}

function isGlobalVarRegisted ($key) 
{
	global $global_arr;
	
	if (array_key_exists($key, $global_arr)) 
	{
		return true;
	}
	else 
	{
		return false;
	}
	
}
?>
