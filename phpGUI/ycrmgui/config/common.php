<?php
/**
 *
 * common.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: common.php,v 1.7 2006/12/26 10:43:06 arzen Exp $
 */
$ActiveOption = array(	
			'new'=>$wb->vars["Lang"]["lang_new"],
			'live'=>$wb->vars["Lang"]["lang_live"],
			'deleted'=>$wb->vars["Lang"]["lang_deleted"],
			);
			
$GenderOption = array(	
			'm'=>$wb->vars["Lang"]["lang_male"],
			'f'=>$wb->vars["Lang"]["lang_female"],
			);
$LangOption = array(	
			'zh-cn'=>$wb->vars["Lang"]["lang_chinese"],
			'en'=>$wb->vars["Lang"]["lang_english"],
			);
			
$ReviewwayOption = array(	
			'phone'=>$wb->vars["Lang"]["lang_reviewwayphone"],
			'network'=>$wb->vars["Lang"]["lang_reviewwaynetwork"],
			'visit'=>$wb->vars["Lang"]["lang_reviewwayvisit"],
			);

$ReplyOption = array(	
			'Y'=>$wb->vars["Lang"]["lang_yes"],
			'N'=>$wb->vars["Lang"]["lang_no"],
			);
			
$StateOption = array(	
			'pending'=>$wb->vars["Lang"]["lang_pending"],
			'start'=>$wb->vars["Lang"]["lang_start"],
			'10'=>"10%",
			'20'=>"20%",
			'30'=>"30%",
			'40'=>"40%",
			'50'=>"50%",
			'60'=>"60%",
			'70'=>"70%",
			'80'=>"80%",
			'90'=>"90%",
			'close'=>$wb->vars["Lang"]["lang_close"],
			);
			
$ComplaintsStateOption = array(	
			'handling'=>$wb->vars["Lang"]["lang_statehandling"],
			'cancel'=>$wb->vars["Lang"]["lang_statecancel"],
			'finish'=>$wb->vars["Lang"]["lang_statefinish"],
			);

$AccessOption = array(	
			'public'=>$wb->vars["Lang"]["lang_public"],
			'private'=>$wb->vars["Lang"]["lang_private"],
			);

$DebitOption = array(	
			'I'=>$wb->vars["Lang"]["lang_income"],
			'P'=>$wb->vars["Lang"]["lang_payout"],
			);

$OrderStateOption = array(	
			'handling'=>$wb->vars["Lang"]["lang_statehandling"],
			'delivery'=>$wb->vars["Lang"]["lang_statedelivery"],
			'cancel'=>$wb->vars["Lang"]["lang_statecancel"],
			'finish'=>$wb->vars["Lang"]["lang_statefinish"],
			'prepay'=>$wb->vars["Lang"]["lang_stateprepay"],
			'waitpay'=>$wb->vars["Lang"]["lang_statewaitpay"],
			);

$PaywayOption = array(	
			'cash'=>$wb->vars["Lang"]["lang_paywaycash"],
			'week'=>$wb->vars["Lang"]["lang_paywayweek"],
			'month'=>$wb->vars["Lang"]["lang_paywaymonth"],
			'quarter'=>$wb->vars["Lang"]["lang_paywayquarter"],
			'year'=>$wb->vars["Lang"]["lang_paywayyear"],
			);

$DeliverywayOption = array(	
			'visiting'=>$wb->vars["Lang"]["lang_deliverywayvisiting"],
			'network'=>$wb->vars["Lang"]["lang_deliverywaynetwork"],
			'land'=>$wb->vars["Lang"]["lang_deliverywayland"],
			'ocean'=>$wb->vars["Lang"]["lang_deliverywayocean"],
			'air'=>$wb->vars["Lang"]["lang_deliverywayair"],
			);

?>
