<?php
/**
 *
 * common.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: common.php,v 1.3 2006/10/30 04:56:27 arzen Exp $
 */
$GenderOption = array(	
			''=>$i18n->_('All'),
			'm'=>$i18n->_('Male'),
			'f'=>$i18n->_('Female'),
			);
$DebitOption = array(	
			''=>$i18n->_('All'),
			'I'=>$i18n->_('Income'),
			'P'=>$i18n->_('Payout'),
			);
$ActiveOption = array(	
			''=>$i18n->_('All'),
			'new'=>"<FONT COLOR=\"#6600FF\">".$i18n->_('New')."</FONT>",
			'live'=>"<FONT COLOR=\"#006600\">".$i18n->_('Live')."</FONT>",
			'deleted'=>"<FONT COLOR=\"#FF0000\">".$i18n->_('Deleted')."</FONT>"
			);

?>
