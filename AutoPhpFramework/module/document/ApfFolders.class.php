<?php

/**
 *
 * ApfFolders.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfFolders.class.php,v 1.13 2006/12/08 10:10:55 arzen Exp $
 */

class ApfFolders  extends Actions
{
	function executeCreatefolder () 
	{
		global $template,$WebBaseDir,$controller,$AccessOption,$logger;

		$template->setFile(array (
			"MAIN" => "apf_folders_edit.html"
		));
		$template->setBlock("MAIN", "add_block");

		$params_id=$controller->getID();
		$PID = $params_id;
				
		array_shift($AccessOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "addsubmit",
			"ACCESSOPTION" => radioTag("access",$AccessOption,"public"),
			"PID" => $PID,
		));
	}
	
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	
	function executeCreatefile () 
	{
		global $template,$WebBaseDir,$controller,$AccessOption;

		$template->setFile(array (
			"MAIN" => "apf_files_edit.html"
		));
		$template->setBlock("MAIN", "add_block");

		$params_id=$controller->getID();
		$PID = $params_id;
				
		array_shift($AccessOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "addfilesubmit",
			"FILE_NAME" => fileTag("filename"),
			"ACCESSOPTION" => radioTag("access",$AccessOption,"public"),
			"PID" => $PID,
		));
	}
	
	function executeAddfilesubmit () 
	{
		$this->handleFileFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$AccessOption,$controller,$i18n;
		$template->setFile(array (
			"MAIN" => "apf_folders_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$apf_folders = DB_DataObject :: factory('ApfFolders');
		$apf_folders->get($apf_folders->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_folders->getId(),"NAME" => $apf_folders->getName(),"PARENT" => $apf_folders->getParent(),"DIRPATH" => $apf_folders->getDirpath(),"DESCRIPTION" => $apf_folders->getDescription(),"PASSWORD" => $apf_folders->getPassword(),"GROUPID" => $apf_folders->getGroupid(),"USERID" => $apf_folders->getUserid(),"ACTIVE" => $apf_folders->getActive(),"ADD_IP" => $apf_folders->getAddIp(),"CREATED_AT" => $apf_folders->getCreatedAt(),"UPDATE_AT" => $apf_folders->getUpdateAt(),));
		array_shift($AccessOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"ACCESSOPTION" => radioTag("access",$AccessOption,$apf_folders->getAccess()),
			"DOACTION" => "updatesubmit"
		));

		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$AddIP,$userid,$group_ids,$logger,$user_name,$DocumentDir;
		$apf_folders = DB_DataObject :: factory('ApfFolders');

		if ($edit_submit) 
		{
			$apf_folders->get($apf_folders->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}
		
		$apf_folders->setName(stripslashes(trim($_POST['name'])));
		$apf_folders->setParent(stripslashes(trim($_POST['parent'])));
		$apf_folders->setDescription(stripslashes(trim($_POST['description'])));
		$apf_folders->setPassword(stripslashes(trim($_POST['password'])));
		$apf_folders->setActive(stripslashes(trim($_POST['active'])));
		$apf_folders->setAccess(stripslashes(trim($_POST['access'])));

		$apf_folders->setAddIp($AddIP);
		$apf_folders->setGroupid($group_ids);
		$apf_folders->setUserid($userid);
		
		$val = $apf_folders->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$parent_dir = $this->getFolderByPID($_POST['parent']);
				$old_folder_name = $DocumentDir.$parent_dir."/".$_POST['old_folder'];
				$new_folder_name = $DocumentDir.$parent_dir."/".$_POST['name'];
				rename($old_folder_name,$new_folder_name);
				
				$log_string = $i18n->_("Rename").$i18n->_("Folder")."\t{$old_folder_name}=>{$new_folder_name}";
				logFileString ($log_string);
				
				$apf_folders->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_folders->setDirpath($parent_dir."/".$_POST['name']);
				$apf_folders->update();
				$this->forward("document/apf_folders/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$parent_dir = $this->getFolderByPID($_POST['parent']);
				$dir_path = $this->createFolderByPID ($_POST['parent'],$_POST['name']);
				$apf_folders->setDirpath($dir_path);
				
				$apf_folders->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_folders->insert();
				
				$log_string = $i18n->_("CreateFolder")."\t{$_POST['name']}";
				logFileString ($log_string);
				
				$this->forward("document/apf_folders/list/{$_POST['parent']}");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_folders_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"DOACTION" => $do_action
			));
			foreach ($val as $k => $v)
			{
				if ($v == false)
				{
					$template->setVar(array (
						strtoupper($k)."_ERROR_MSG" => " &darr; ".$i18n->_("Please check here")." &darr; "
					));

				}
			}
			$template->setVar(
				array (
				"ID" => $_POST['id'],"NAME" => $_POST['name'],"PARENT" => $_POST['parent'],"DESCRIPTION" => $_POST['description'],"PASSWORD" => $_POST['password'],"GROUPID" => $_POST['groupid'],"USERID" => $_POST['userid'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDelfolder()
	{
		global $controller,$DocumentDir,$ClassDir,$i18n,$AddIP,$userid,$group_ids,$logger,$user_name;
		require_once ($ClassDir."FileHelper.class.php");
		
		$apf_folders = DB_DataObject :: factory('ApfFolders');
		$apf_folders->get($apf_folders->escape($controller->getID()));
		$apf_folders->find();
		$apf_folders->fetch();

		$foldername = $apf_folders->getDirpath();
		$real_folder_path = $DocumentDir.$foldername;
		$this->delFolderAndFileByFID ($controller->getID());
		$apf_folders->delete();
		
		$apf_files = DB_DataObject :: factory('ApfFiles');
		$apf_files->setParent($apf_folders->escape($controller->getID()));
		$apf_files->find();
		while ($apf_files->fetch()) 
		{
			$filename = $apf_files->getFilename();
			$apf_files->delete();
			
			$log_string = $i18n->_("Delete").$i18n->_("File")."\t{$foldername}";
			logFileString ($log_string);
		}
		
		FileHelper::deleteDir($real_folder_path);
		
		$log_string = $i18n->_("Delete").$i18n->_("Folder")."\t{$foldername}";
		logFileString ($log_string);

		$this->forward("document/apf_folders/list/".$apf_folders->getParent());
	}
	
	function delFolderAndFileByFID ($fid) 
	{
		global $i18n;
		$apf_folders = DB_DataObject :: factory('ApfFolders');
		$apf_folders->setParent($apf_folders->escape($fid));
		$apf_folders->find();
		while ($apf_folders->fetch()) 
		{
			$apf_files = DB_DataObject :: factory('ApfFiles');
			$apf_files->setParent($apf_folders->getId());
			$apf_files->find();
			while ($apf_files->fetch()) 
			{
				$filename = $apf_files->getFilename();
				$apf_files->delete();
	
				$log_string = $i18n->_("Delete").$i18n->_("File")."\t{$filename}";
				logFileString ($log_string);
			}
			$this->delFolderAndFileByFID ($apf_folders->getId());
			$foldername = $apf_folders->getName();
			$apf_folders->delete();
			
			$log_string = $i18n->_("Delete").$i18n->_("Folder")."\t{$foldername}";
			logFileString ($log_string);
			
		}
		
	}
	
	function executeDelfile () 
	{
		global $controller,$DocumentDir,$i18n,$AddIP,$userid,$group_ids,$logger,$user_name;
		$apf_files = DB_DataObject :: factory('ApfFiles');
		$apf_files->get($apf_files->escape($controller->getID()));
		$apf_files->find();
		$apf_files->fetch();
		
		$filename = $apf_files->getFilename();
		$real_file_path = $DocumentDir.$this->getFolderByPID ($apf_files->getParent())."/{$filename}";
		@unlink($real_file_path);
		$apf_files->delete();
		
		$log_string = $i18n->_("Delete").$i18n->_("File")."\t{$filename}";
		logFileString ($log_string);
		
		$this->forward("document/apf_folders/list/".$apf_files->getParent());
	}
	
	function executeDownloadfile () 
	{
		global $controller;
		$fid = $controller->getID();
		$this->downloadFileByID($fid);
		exit;
	}

	function executeDownloadfolder () 
	{
		global $controller;
		$fid = $controller->getID();
		$this->downloadFolderByID($fid);
		exit;
	}
	
	function handleFileFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$DocumentDir,$ClassDir,$AddIP,$userid,$group_ids;
		$apf_files = DB_DataObject :: factory('ApfFiles');

		if ($edit_submit) 
		{
			$apf_files->get($apf_files->escape($_POST['ID']));
			$do_action = "updatefilesubmit";
		}
		else 
		{
			$do_action = "addfilesubmit";
		}

		$apf_files->setName(stripslashes(trim($_POST['name'])));
		$apf_files->setParent(stripslashes(trim($_POST['parent'])));
		$apf_files->setDescription(stripslashes(trim($_POST['description'])));
		$apf_files->setMajorRevision(stripslashes(trim($_POST['major_revision'])));
		$apf_files->setMinorRevision(stripslashes(trim($_POST['minor_revision'])));
		$apf_files->setPassword(stripslashes(trim($_POST['password'])));
		$apf_files->setActive(stripslashes(trim($_POST['active'])));
		$apf_files->setAccess(stripslashes(trim($_POST['access'])));

		$apf_files->setAddIp($AddIP);
		$apf_files->setGroupid($group_ids);
		$apf_files->setUserid($userid);

		$UploadDocumentDir = $DocumentDir.$this->getFolderByPID ($_POST['parent']);
		if ($_POST['filename_del']=='Y') 
		{
			unlink($UploadDocumentDir.$_POST['filename_old']);
			$apf_files->setFilename("");
			$_POST['filename_old']="";
		}
		if($_POST['upload_temp'])
		{
			$apf_files->setFilename($_POST['upload_temp']);	
		}
		$allow_upload_file = TRUE;
		if($_FILES['filename']['name'])
		{
			require_once ($ClassDir."FileHelper.class.php");
			$upload_data = FileHelper::uploadDocumentFile ($UploadDocumentDir);
//			Var_Dump::display($upload_data);
			$allow_upload_file = $upload_data["upload_state"];
			if ($allow_upload_file) 
			{
				$filenames_arr = $upload_data["upload_msg"];
				if ($filename_pic = $filenames_arr['filename']) 
				{
					$apf_files->setFilename($filename_pic);
					$apf_files->setExt($filenames_arr['exten_name']);
					$apf_files->setFSize($filenames_arr['file_size']);
					$_POST['upload_temp'] = $filename_pic;
				}
			}
			else
			{
				$upload_error_msg = $upload_data["upload_msg"];
			}

		}
				
		$val = $apf_files->validate();
		if (($val === TRUE) && ($allow_upload_file === TRUE))
		{
			if ($edit_submit) 
			{
				$apf_files->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_files->update();
				$this->forward("document/apf_folders/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_files->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_files->insert();
				$log_string = $i18n->_("Create").$i18n->_("File")."\t{$_POST['name']}";
				logFileString ($log_string);
				
				$this->forward("document/apf_folders/list/{$_POST['parent']}");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_files_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"DOACTION" => $do_action
			));
			if (is_array($val)) 
			{
				foreach ($val as $k => $v)
				{
					if ($v == false)
					{
						$template->setVar(array (
							strtoupper($k)."_ERROR_MSG" => " &darr; ".$i18n->_("Please check here")." &darr; "
						));
	
					}
				}
			}
			if ($allow_upload_file !== TRUE) 
			{
				$template->setVar(array (
					"FILENAME_ERROR_MSG" => " &darr; {$upload_error_msg} &darr; "
				));
			}
			
			$template->setVar(
				array (
				"ID" => $_POST['id'],"NAME" => $_POST['name'],"PARENT" => $_POST['parent'],"FILENAME" => $_POST['filename'],"F_SIZE" => $_POST['f_size'],"DESCRIPTION" => $_POST['description'],"CHECKED_OUT" => $_POST['checked_out'],"MAJOR_REVISION" => $_POST['major_revision'],"MINOR_REVISION" => $_POST['minor_revision'],"URL" => $_POST['url'],"PASSWORD" => $_POST['password'],"USERID" => $_POST['userid'],"GROUPID" => $_POST['groupid'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
		
	}
	
	
	function executeList()
	{
		global $template,$controller,$WebBaseDir,$WebTemplateDir,$WebTemplateFullPath,$userid,$ClassDir,$ActiveOption,$i18n;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_folders_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");
		
		$params_id=$controller->getID();
		$PID = $params_id?$params_id:0;
//		list folder		
		$apf_folders = DB_DataObject :: factory('ApfFolders');
		$apf_folders->setParent($PID);
		$apf_folders->whereAdd(" userid = '$userid' OR access = 'public' ");
		$apf_folders->orderBy('id desc');
		$apf_folders->find();
		
		$myData=array();
		while ($apf_folders->fetch())
		{
			$row = $apf_folders->toArray();
			$row['name']="<a href=\"{$WebBaseDir}/document/apf_folders/list/{$row['id']}\">".$this->getFolderIco().$row['name']."</a>";
			$row['download_link']=$this->getFolderDownloadLink ($row['id']);
			$row['edit_link']="<a href=\"{$WebBaseDir}/document/apf_folders/update/{$row['id']}\"><img alt=\"".$i18n->_("Edit")."\" title=\"".$i18n->_("Edit")."\" src=\"{$WebTemplateFullPath}images/edit_icon.png\" /></a>";
			$row['del_action']="delfolder";
			$myData[] = $row;
		}
//		lsit files
		$apf_files = DB_DataObject :: factory('ApfFiles');
		$apf_files->setParent($PID);
		$apf_files->whereAdd(" userid = '$userid' OR access = 'public' ");
		$apf_files->orderBy('id desc');
		$apf_files->find();
		while ($apf_files->fetch())
		{
			$row = $apf_files->toArray();
			$row['name']=$this->getFileIco($row['ext']).$row['name'];
			$row['download_link']=$this->getFileDownloadLink ($row['id']);
			$row['edit_link']="";
			$row['del_action']="delfile";
			$myData[] = $row;
		}
		$i = 0;
		foreach($myData as $data)
		{
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";
			
			$template->setVar(array (
				"LIST_TD_CLASS" => $list_td_class
			));
			
			$template->setVar(array ("DOWNLOAD_LINK" => $data['download_link'],"EDIT_LINK" => $data['edit_link'],"DEL_ACTION" => $data['del_action'],"ID" => $data['id'],"NAME" => $data['name'],"PARENT" => $data['parent'],"DESCRIPTION" => $data['description'],"PASSWORD" => $data['password'],"GROUPID" => $data['groupid'],"USERID" => $data['userid'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		$ToltalNum = $i;
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"NAVIGATOR" => $this->getNavigatorByID ($PID),
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"TOLTAL_NUM" => $ToltalNum,
			"PID" => $PID,
		));

	}
	
	function createFolderByPID ($pid,$name) 
	{
		global $DocumentDir;
		if (!file_exists($DocumentDir)) 
		{
			@mkdir($DocumentDir,0777);
		}
		if ($pid==0) 
		{
			$new_folder_name = $DocumentDir.$name;
			@mkdir($new_folder_name,0777);
			return $name;
		} 
		else 
		{
			$folder_name = $this->getFolderByPID ($pid)."/{$name}";
			$new_folder_name = $DocumentDir."{$folder_name}/";
			mkdir($new_folder_name,0777);
			
			return $folder_name;
		}
	}
	
	function getFolderByPID ($pid) 
	{
		if ($pid==0) 
		{
			return "";
		}
		else
		{
			$apf_folders = DB_DataObject :: factory('ApfFolders');
			$apf_folders->setId($pid);
			$apf_folders->find();
			$apf_folders->fetch();
			return $apf_folders->getDirpath();
		}
	}
	
	function getNavigatorByID ($id) 
	{
		global $WebBaseDir,$i18n;
		$navigator_url = "{$WebBaseDir}/document/apf_folders/list/";
		$root_nav_str = "<a href=\"{$navigator_url}\">".$i18n->_("Root")."</a>";
		if ($id==0) 
		{
			return $root_nav_str;
		} 
		else 
		{
			$apf_folders = DB_DataObject :: factory('ApfFolders');
			$apf_folders->setId($id);
			$apf_folders->find();
			$apf_folders->fetch();
			
			$dir_path = $apf_folders->getDirpath();
			$dir_path_arr = explode("/",$dir_path);
			$temp_nav_str = "";
			foreach($dir_path_arr as $key=>$value)
			{
				$tmp_folders = DB_DataObject :: factory('ApfFolders');
				$tmp_folders->setName($value);
				$tmp_folders->find();
				$tmp_folders->fetch();
				$temp_nav_str .= "<a href=\"{$navigator_url}".$tmp_folders->getId()."\">".$value."</a>/";
			}
			return $root_nav_str."/".$temp_nav_str;
		}
	}
	
	function getFolderIco () 
	{
		global $WebTemplateFullPath;
		return "<img src=\"".$WebTemplateFullPath."images/fileico/folder_closed.gif\" />";
	}
	
	function getFileIco ($ext) 
	{
		global $WebTemplateFullPath;
		return "<img src=\"".$WebTemplateFullPath."images/fileico/{$ext}.gif\" />";
	}
	
	function getFileDownloadLink ($id) 
	{
		global $WebTemplateFullPath,$WebBaseDir;
		return "<a href=\"{$WebBaseDir}/document/apf_folders/downloadfile/{$id}\"><img src=\"".$WebTemplateFullPath."images/download.gif\" /></a>";
	}
	
	function getFolderDownloadLink ($id) 
	{
		global $WebTemplateFullPath,$WebBaseDir;
		return "<a href=\"{$WebBaseDir}/document/apf_folders/downloadfolder/{$id}\"><img src=\"".$WebTemplateFullPath."images/zip.gif\" /></a>";
	}
	
	function downloadFileByID ($id) 
	{
		global $DocumentDir;
		require_once 'HTTP/Download.php';
		$apf_files = DB_DataObject :: factory('ApfFiles');
		$apf_files->setId($id);
		$apf_files->orderBy('id desc');
		$apf_files->find();
		$apf_files->fetch();
		
		$filename = $apf_files->getFilename();
		$real_file_path = $DocumentDir.$this->getFolderByPID ($apf_files->getParent())."/{$filename}";

		$dl = &new HTTP_Download();
		$dl->setFile($real_file_path);
		$dl->setContentDisposition (HTTP_DOWNLOAD_ATTACHMENT, $filename);
		$dl->setBufferSize(50 * 1024); // 25 K
		$dl->setThrottleDelay(2);   // 1 sec
		$dl->send();
	}

	function downloadFolderByID ($id) 
	{
		global $DocumentDir;
		require_once 'HTTP/Download.php';
		$apf_folders = DB_DataObject :: factory('ApfFolders');
		$apf_folders->setId($id);
		$apf_folders->find();
		$apf_folders->fetch();
		
		$filename = $apf_folders->getName().".tar.gz";
		$foldername = $apf_folders->getDirpath();
		$real_folder_path = $DocumentDir.$foldername;
		HTTP_Download::sendArchive($filename,$real_folder_path,HTTP_DOWNLOAD_TGZ,"",$real_folder_path); 
	}

}
?>