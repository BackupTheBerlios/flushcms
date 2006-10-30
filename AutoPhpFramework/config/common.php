<?php
/**
 *
 * common.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: common.php,v 1.4 2006/10/30 05:24:37 arzen Exp $
 */
$GenderOption = array(	
			''=>'All',
			'm'=>"<FONT COLOR=\"#6600FF\">".$i18n->_('Male')."</FONT>",
			'f'=>"<FONT COLOR=\"#FF0000\">".$i18n->_('Female')."</FONT>",
			);
$DebitOption = array(	
			''=>'All',
			'I'=>"<FONT COLOR=\"#6600FF\">".$i18n->_('Income')."</FONT>",
			'P'=>"<FONT COLOR=\"#FF0000\">".$i18n->_('Payout')."</FONT>",
			);
$ActiveOption = array(	
			''=>$i18n->_('All'),
			'new'=>"<FONT COLOR=\"#6600FF\">".$i18n->_('New')."</FONT>",
			'live'=>"<FONT COLOR=\"#006600\">".$i18n->_('Live')."</FONT>",
			'deleted'=>"<FONT COLOR=\"#FF0000\">".$i18n->_('Deleted')."</FONT>",
			);

?>
