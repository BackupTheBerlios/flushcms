<?php
/**
 * users actions.
 *
 * @package    solution
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.7 2006/08/27 05:47:05 arzen Exp $
 */
class usersActions extends autousersActions
{

	protected function addFiltersCriteria(& $c)
	{
		if (($this->getRequestParameter('q') != "") || ($this->getRequestParameter('q') != NULL) )
		{
			$c->add(UsersPeer :: USER_NAME, $this->getRequestParameter('q') . '%', Criteria :: LIKE);
		}

		if (($this->getRequestParameter('gender') != "") || ($this->getRequestParameter('gender') != NULL) )
		{
			$c->add(UsersPeer :: GENDER, $this->getRequestParameter('gender'), Criteria :: EQUAL);
		}

	}

	public function executeShow()
	{
		$this->users = UsersPeer :: retrieveByPk($this->getRequestParameter('id'));

		$c = new Criteria();
		$c->add(RolePeer :: ID, $this->users->getRoleId());
		$this->roles = RolePeer :: doSelect($c);

		$this->forward404Unless($this->users);
	}

	protected function updateUsersFromRequest()
	{
		$user_password = $this->getRequestParameter('password1');
		$user_password2 = $this->getRequestParameter('password2');
		$user_gender = $this->getRequestParameter('gender');
		$user_roleid = $this->getRequestParameter('role_id');
		if ($user_password && ($user_password == $user_password2))
		{
			$this->users->setUserPwd($user_password);
		}
		if (isset ($user_gender))
		{
			$this->users->setGender($user_gender);
		}
		if (!$this->getRequest()->getError("users{photo}") && $fileName = $this->getRequest()->getFileName("users[photo]"))
		{
			$this->getRequest()->moveFile("users[photo]", sfConfig :: get('sf_upload_dir_name') . '/' . $fileName);
			$this->users->setPhoto($fileName);
		}
		if ($user_roleid)
		{
			$this->users->setRoleId($user_roleid);
		}
		$ip = $_SERVER['REMOTE_ADDR'];
		$this->users->setAddIp($ip);
		parent :: updateUsersFromRequest();
	}

	public function handleError()
	{
		$this->forward('users', 'create');
	}

}