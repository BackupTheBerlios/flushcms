<?php
/**
 *
 * common.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: common.php,v 1.5 2006/12/25 14:53:35 arzen Exp $
 */
$ActiveOption = array(	
			$wb->vars["Lang"]["lang_new"]=>'new',
			$wb->vars["Lang"]["lang_live"]=>'live',
			$wb->vars["Lang"]["lang_deleted"]=>'deleted',
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

?>
