<?php
/** 
*
* attachment mod faq [English]
*
* @package attachment_mod
* @version $Id: lang_faq_attach.php,v 1.1 2006/11/20 08:46:28 arzen Exp $
* @copyright (c) 2002 torgeir andrew waterhouse
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (!isset($faq) || !is_array($faq))
{
	$faq = array();
}

$faq[] = array("--","附件");

$faq[] = array("如何新增附件?", "当你发表新文章时, 您可以新增附件. 您应该会在输入文字下看到 <i>附件</i> 的表格. 您只要按下 <i>浏览...</i> 键, 文件管理的窗口就会跳出. 浏览您所要增加的附件, 选择好文件后按下确定, 或者双击该文件名即可. 如果您要详细说明此附件, 在 <i>文件注解</i> 栏中填写即可，文件注解将显示为该附件的连接. 如果您不想加入注解, 系统会自动以文件名代替. 如果管理员允许, 您将可以依照此方式上传数个文件, 直至达到上限为止.<br/><br/>管理员会设定附加文件的大小上限, 定义扩展名和 MIME 类型. 管理员保留删除您增加的附件的权利.<br/><br/>请注意管理员将不负任何资料损失的责任.");

$faq[] = array("如何在文章发表后新增附件?", "欲在文章发表后新增附件, 你必须编辑您的文章, 并且照着上述步骤. 新的附加文件会在您按下 <i>送出</i> 键后加入编辑过的文章中.");

$faq[] = array("如何删除附件?", "欲删除附件, 您必须编辑您原本的文章, 并且在 <i>已加入的附加文件</i> 表格中, 按下您想删除的附加文件旁的 <i>删除附加文件</i> 键. 该附加文件将会在您按下 <i>送出</i> 后被删除.");

$faq[] = array("如何更新文件注解?", "欲更新文件注解, 您必须编辑您原本的文章, 并且在 <i>已加入的附件</i> 表格中, 按下您想更新注解的附件旁的 <i>更新注解</i> 键. 该附件的注解将会在您按下 <i>送出</i> 后被更新.");

$faq[] = array("为何我在文章中看不见附件?", "最有可能的原因是, 该附加文件或其 MIME 类型已经被管理员关闭, 或者由于某些因素, 该附件已经被版主或管理员删除.");

$faq[] = array("为何我无法新增附件?", "在某些讨论区, 只有部分会员可以新增附加文件. 欲新增附件, 您必须取得授权, 而只有版主和管理员有这个权力可以调整您的权限, 请与他们联系.");

$faq[] = array("我已获得授权, 但为何还是无法新增附加文件?", "管理员限制了附加文件的文件大小, 扩展名和 MIME 类型. 版主或者管理员可能变更了您的权限, 或者关闭了某个讨论区的附件功能. 当您尝试新增附件时,您应该会看到一些错误讯息. 如果没有, 或许您可以联系版主或者管理员.");

$faq[] = array("为何我无法删除附件?", "在某些讨论区, 删除附件可能受限于会员及群组. 欲删除附件, 您必须取得授权, 而只有版主和管理员有这个权力可以调整您的权限, 请与他们联系.");

$faq[] = array("为何我无法下载/查看附件?", "在某些讨论区, 下载/查看附件可能受限于部分使用者及群组. 欲下载/观看附加文件, 您必须取得授权, 而只有版主和管理员有这个权力可以调整您的权限, 请与他们联系.");

$faq[] = array("我该向谁反映违法的附件?", "您应该立即通知网站管理员. 如果您无法得知谁是网站管理员, 您应该先通知任何一个讨论区的版主, 并且询问管理员的下落. 如果您依然没有得到任何回应, 您应该与该网域的所有人联系 (WHOIS 搜寻) 或者, 这个网站是架设在免费的伺服器上 (例如: yahoo, free.fr, f2s.com, etc.), 则应通知其管理团队或者专门的部门. 请特别注意, phpBB 团队将完全不负任何责任, 并且没有任何能力控制这个讨论版将被如何使用. 因为任何法律上的问题而联系 phpBB 团队是非常没有意义的, 除非是直接关于 phpbb.com 网站或者 phpBB 程式模组本身. 如果您曾经寄信通知 phpBB 团队关于其他人使用这个程式, 您将会得到冷淡的回应, 或者不会接到回应.");

?>