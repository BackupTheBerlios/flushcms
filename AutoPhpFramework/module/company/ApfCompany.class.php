<?php

/**
 *
 * ApfCompany.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfCompany.class.php,v 1.18 2006/10/23 13:48:33 arzen Exp $
 */

class ApfCompany  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$ActiveOption;

		$template->setFile(array (
			"MAIN" => "apf_company_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		array_shift($ActiveOption);
		$template->setVar(array (
			"FILEPHOTO" => fileTag("photo"),
			"WEBDIR" => $WebBaseDir,
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,"new"),
			"DOACTION" => "addsubmit"
		));

	}
	
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$i18n,$ActiveOption;
		$template->setFile(array (
			"MAIN" => "apf_company_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");

		$apf_company = DB_DataObject :: factory('ApfCompany');
		$apf_company->get($apf_company->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_company->getId(),"NAME" => $apf_company->getName(),"ADDREES" => $apf_company->getAddrees(),"PHONE" => $apf_company->getPhone(),"FAX" => $apf_company->getFax(),"EMAIL" => $apf_company->getEmail(),"PHOTO" => $apf_company->getPhoto(),"HOMEPAGE" => $apf_company->getHomepage(),"EMPLOYEE" => $apf_company->getEmployee(),"BANKROLL" => $apf_company->getBankroll(),"LINK_MAN" => $apf_company->getLinkMan(),"INCORPORATOR" => $apf_company->getIncorporator(),"INDUSTRY" => $apf_company->getIndustry(),"PRODUCTS" => $apf_company->getProducts(),"MEMO" => $apf_company->getMemo(),"ACTIVE" => $apf_company->getActive(),"ADD_IP" => $apf_company->getAddIp(),"CREATED_AT" => $apf_company->getCreatedAt(),"UPDATE_AT" => $apf_company->getUpdateAt(),));
		array_shift($ActiveOption);
		$template->setVar(array (
			"FILEPHOTO" => fileTag("photo",$apf_company->getPhoto()),
			"WEBDIR" => $WebBaseDir,
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,$apf_company->getActive()),
			"DOACTION" => "updatesubmit"
		));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$ActiveOption,$UploadDir,$ClassDir,$AllowUploadFilesType;
		$apf_company = DB_DataObject :: factory('ApfCompany');

		if ($edit_submit) 
		{
			$apf_company->get($apf_company->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_company->setName(stripslashes(trim($_POST['name'])));
		$apf_company->setAddrees(stripslashes(trim($_POST['addrees'])));
		$apf_company->setPhone(stripslashes(trim($_POST['phone'])));
		$apf_company->setFax(stripslashes(trim($_POST['fax'])));
		$apf_company->setEmail(stripslashes(trim($_POST['email'])));
		$apf_company->setPhoto(stripslashes(trim($_POST['photo'])));
		$apf_company->setHomepage(stripslashes(trim($_POST['homepage'])));
		$apf_company->setEmployee(stripslashes(trim($_POST['employee'])));
		$apf_company->setBankroll(stripslashes(trim($_POST['bankroll'])));
		$apf_company->setLinkMan(stripslashes(trim($_POST['link_man'])));
		$apf_company->setIncorporator(stripslashes(trim($_POST['incorporator'])));
		$apf_company->setIndustry(stripslashes(trim($_POST['industry'])));
		$apf_company->setProducts(stripslashes(trim($_POST['products'])));
		$apf_company->setMemo(stripslashes(trim($_POST['memo'])));
		$apf_company->setActive(stripslashes(trim($_POST['active'])));
		$apf_company->setAddIp(stripslashes(trim($_POST['add_ip'])));

		if ($_POST['photo_del']=='Y') 
		{
			unlink($UploadDir.$_POST['photo_old']);
			$apf_company->setPhoto("");
			$_POST['photo_old']="";
		}

		$allow_upload_file = TRUE;
		if($_FILES['photo']['name'])
		{
			require_once 'HTTP/Upload.php';
			require_once ($ClassDir."FileHelper.class.php");
			$upload = new http_upload();
			$file = $upload->getFiles('photo');
			$file->setValidExtensions($AllowUploadFilesType,'accept');
			if (PEAR::isError($file)) 
			{
				$allow_upload_file = FALSE;
				$upload_error_msg = $file->getMessage();
			}
			if ($file->isValid()) 
			{
				$file->setName('uniq');
				$current_date = FileHelper::createCategoryDir($UploadDir,"product");
				$date_photo_dir = $UploadDir.$current_date;
				$dest_name = $file->moveTo($date_photo_dir);
				if (PEAR::isError($dest_name)) 
				{
					$allow_upload_file = FALSE;
					$upload_error_msg = $dest_name->getMessage();
				}
				else 
				{
					$real = $file->getProp('real');
					$apf_company->setPhoto($current_date.$dest_name);
				}
			} 
			elseif ($file->isError()) 
			{
				$allow_upload_file = FALSE;
				$upload_error_msg = $file->errorMsg();
			}			
		}
				
		$val = $apf_company->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_company->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_company->update();
				$this->forward("company/apf_company/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_company->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_company->insert();
				$this->forward("company/apf_company/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_company_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
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
				"ID" => $_POST['id'],"NAME" => $_POST['name'],"ADDREES" => $_POST['addrees'],"PHONE" => $_POST['phone'],"FAX" => $_POST['fax'],"EMAIL" => $_POST['email'],"PHOTO" => $_POST['photo'],"HOMEPAGE" => $_POST['homepage'],"EMPLOYEE" => $_POST['employee'],"BANKROLL" => $_POST['bankroll'],"LINK_MAN" => $_POST['link_man'],"INCORPORATOR" => $_POST['incorporator'],"INDUSTRY" => $_POST['industry'],"PRODUCTS" => $_POST['products'],"MEMO" => $_POST['memo'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );
			array_shift($ActiveOption);
			$template->setVar(array (
				"FILEPHOTO" => fileTag("photo",$_POST['photo_old']),
				"WEBDIR" => $WebBaseDir,
				"ACTIVEOPTION" => radioTag("active",$ActiveOption,$_POST['active']),
				"DOACTION" => $do_action
			));

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_company = DB_DataObject :: factory('ApfCompany');
		$apf_company->get($apf_company->escape($controller->getID()));
		$apf_company->setActive('deleted');
		$apf_company->update();
		$this->forward("company/apf_company/");
	}
	
	function executeDetail () 
	{
		global $template,$ModuleDir,$ClassDir,$WebTemplateDir,$WebBaseDir,$controller,$i18n,$ActiveOption,$WebTemplateFullPath,$GenderOption,$CurrencyFormat;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'I18N/Currency.php';
		require_once $ModuleDir.'contact/ApfContact.class.php';
		require_once $ModuleDir.'product/ApfProduct.class.php';

		$template->setFile(array (
			"MAIN" => "apf_company_detail.html"
		));
		$template->setBlock("MAIN", "detail_block");
		
		$apf_company = DB_DataObject :: factory('Apfcompany');
		$apf_company->get($apf_company->escape($controller->getID()));

		$template->setVar(array ("ID" => $apf_company->getId(),"NAME" => $apf_company->getName(),"ADDREES" => $apf_company->getAddrees(),"PHONE" => $apf_company->getPhone(),"FAX" => $apf_company->getFax(),"EMAIL" => $apf_company->getEmail(),"PHOTO" => imageTag ($apf_company->getPhoto()),"HOMEPAGE" => $apf_company->getHomepage(),"EMPLOYEE" => $apf_company->getEmployee(),"BANKROLL" => $apf_company->getBankroll(),"LINK_MAN" => $apf_company->getLinkMan(),"INCORPORATOR" => $apf_company->getIncorporator(),"INDUSTRY" => $apf_company->getIndustry(),"PRODUCTS" => $apf_company->getProducts(),"MEMO" => $apf_company->getMemo(),"ACTIVE" => $apf_company->getActive(),"ADD_IP" => $apf_company->getAddIp(),"CREATED_AT" => $apf_company->getCreatedAt(),"UPDATE_AT" => $apf_company->getUpdateAt(),));

//		related contact
		$contact_category_arr =array(""=>$i18n->_("All"))+ApfContact::getCategory();

		$apf_company_contact = DB_DataObject :: factory('ApfCompanyContact');
		$apf_company_contact->whereAdd(" apf_company_contact.company_id = '".$apf_company->getId() . "'  ");
		$apf_company_contact->orderBy("apf_contact.id desc");
		$apf_company_contact->buildContactJoin();
//		$apf_company_contact->debugLevel(4);
		$apf_company_contact->find();

		$template->setBlock("MAIN", "contact_list", "contact_list_block");
		$i = 0;
		while ($apf_company_contact->fetch())
		{
			$data = $apf_company_contact->toArray();
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";
			
			$template->setVar(array (
				"LIST_TD_CLASS" => $list_td_class
			));
//			Var_Dump::display($data);
			$template->setVar(array ("C_ID" => $data['id'],"C_CATEGORY" => $contact_category_arr[$data['category']],"C_NAME" => $data['name'],"C_GENDER" => $GenderOption[$data['gender']],"C_BIRTHDAY" => $data['birthday'],"C_ADDREES" => $data['addrees'],"C_OFFICE_PHONE" => $data['office_phone'],"C_PHONE" => $data['phone'],"C_FAX" => $data['fax'],"C_MOBILE" => $data['mobile'],"C_EMAIL" => $data['email'],"C_ACTIVE" => $data['active']));

			$template->parse("contact_list_block", "contact_list", TRUE);
			$i++;
		}
		$contact_total = $i;
		
//		related product
		$currency = new I18N_Currency($CurrencyFormat);
		$product_category_arr =array(""=>$i18n->_("All"))+ApfProduct::getCategory();

		$apf_company_product = DB_DataObject :: factory('ApfCompanyProduct');
		$apf_company_product->orderBy("apf_product.id desc");
		$apf_company_product->whereAdd(" apf_company_product.company_id = '".$apf_company->getId() . "'  ");
		$apf_company_product->buildProductJoin();
//		$apf_company_product->debugLevel(4);
		$apf_company_product->find();

		$template->setBlock("MAIN", "product_list", "product_list_block");
		$i = 0;
		while ($apf_company_product->fetch())
		{
			$data = $apf_company_product->toArray();
			
//			get the last product price
			$apf_product_price = DB_DataObject :: factory('ApfProductPrice');
			$apf_product_price->whereAdd("company_id ='".$apf_company->getId()."' ");
			$apf_product_price->whereAdd("product_id ='{$data['id']}' ");
			$apf_product_price->orderBy('created_at desc');
//			$apf_product_price->debugLevel(4);
			$apf_product_price->find();
			$apf_product_price->fetch();
			$data['price'] = $apf_product_price->getPrice()?$apf_product_price->getPrice():$data['price'];
					
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";
			
			$template->setVar(array (
				"LIST_TD_CLASS" => $list_td_class
			));
//			Var_Dump::display($data);
			$template->setVar(array ("P_ID" => $data['id'],"P_CATEGORY" => $product_category_arr[$data['category']],"P_COMPANY_ID" => $data['company_id'],"P_NAME" => $data['name'],"P_PRICE" => "<div ondblclick=\"editPrice('".$data['id']."','".$apf_company->getId()."','".$data['price']."')\" >".$currency->format( $data['price'] )."</div>","P_PHOTO" => imageTag ($data['photo']),"P_MEMO" => $data['memo'],"P_ACTIVE" => $data['active']));

			$template->parse("product_list_block", "product_list", TRUE);
			$i++;
		}
		$product_total = $i;

		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"C_TOLTAL_NUM" => $contact_total,
			"P_TOLTAL_NUM" => $product_total,
			"WEBDIR" => $WebBaseDir,
			"COMID" => $apf_company->getId(),
		));
			
	}
	
	function executeRelatedcontact () 
	{
		global $ClassDir,$template,$WebBaseDir,$WebTemplateDir,$controller,$i18n,$ActiveOption,$WebTemplateFullPath,$GenderOption;

		include_once($ClassDir."URLHelper.class.php");
		$template->setFile(array (
			"MAIN" => "apf_related_edit.html"
		));
		$template->setBlock("MAIN", "detail_block");
		
//		related contact
		$apf_company_contact = DB_DataObject :: factory('ApfCompanyContact');
		$apf_company_contact->whereAdd(" apf_company_contact.company_id = '".$controller->getId() . "'  ");
		$apf_company_contact->buildContactJoin();
//		$apf_company_contact->debugLevel(4);
		$apf_company_contact->find();

		$i = 0;
		$option_items = "";
		while ($apf_company_contact->fetch())
		{
			$row = $apf_company_contact->toArray();
			$data[] = $row['contact_id'];
			$option_items .= "<option value=\"{$row['contact_id']}\"  >{$row['name']}</option>\n";
			$i++;
		}
		
		$template->setVar(array (
			"C_ID" => $controller->getID(),
			"OLD_RELATEDLIST" => is_array($data)?implode(",",$data):"",
			"OPTION_ITEMS" => $option_items,
			"RELATED_CONTACT_ADD_URL" => "/contact/apf_contact/related",
			"RELATED_CONTACT_SUBMIT_URL" => "/company/apf_company/",
			"WEBDIR" => $WebBaseDir,
			"TEMPLATEDIR" => $WebTemplateFullPath,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"TOPIC" => $i18n->_("Company Contact Relation"),
			"DOACTION" => "relatedcontactsubmit",
			));
			
		$controller->parseTemplateLang();		
		$template->parse("OUT", array (
			"LAOUT",
		));
		$template->p("OUT");
		exit;

	}
	
	function executeRelatedcontactsubmit () 
	{
		$old_relatedlist_arr = explode(",",$_POST['old_relatedlist']);
		$relatedlist_arr = $_POST['relatedlist']?$_POST['relatedlist']:array();

		$new_relatedlist_arr =	array_diff($relatedlist_arr,$old_relatedlist_arr);
		$remove_relatedlist_arr = array_diff($old_relatedlist_arr,$relatedlist_arr);
//		Var_Dump::display(array($new_relatedlist_arr,$remove_relatedlist_arr));
		
		if (is_array($new_relatedlist_arr) && sizeof($new_relatedlist_arr)>0) 
		{
		    foreach($new_relatedlist_arr as $contact_id)
		    {
				$apf_company_contact = DB_DataObject :: factory('ApfCompanyContact');
				$apf_company_contact->setCompanyId($_POST['ID']);
				$apf_company_contact->setContactId($contact_id);
//				$apf_company_contact->debugLevel(4);
				$apf_company_contact->insert();
		    }
		}
		
		if (is_array($remove_relatedlist_arr) && sizeof($remove_relatedlist_arr)>0) 
		{
		    foreach($remove_relatedlist_arr as $contact_id)
		    {
				$apf_company_contact = DB_DataObject :: factory('ApfCompanyContact');
				$apf_company_contact->setCompanyId($_POST['ID']);
				$apf_company_contact->setContactId($contact_id);
//				$apf_company_contact->debugLevel(4);
				$apf_company_contact->delete();
		    }
		}
		echo "<SCRIPT LANGUAGE=\"JavaScript\">opener.location.reload( true );window.close(); </SCRIPT>";
		exit;
	}

	function executeRelatedproduct () 
	{
		global $ClassDir,$template,$WebBaseDir,$WebTemplateDir,$controller,$i18n,$ActiveOption,$WebTemplateFullPath,$GenderOption;

		include_once($ClassDir."URLHelper.class.php");
		$template->setFile(array (
			"MAIN" => "apf_related_edit.html"
		));
		$template->setBlock("MAIN", "detail_block");
		
//		related product
		$apf_company_product = DB_DataObject :: factory('ApfCompanyProduct');
		$apf_company_product->whereAdd(" apf_company_product.company_id = '".$controller->getId() . "'  ");
		$apf_company_product->buildProductJoin();
//		$apf_company_product->debugLevel(4);
		$apf_company_product->find();

		$i = 0;
		$option_items = "";
		while ($apf_company_product->fetch())
		{
			$row = $apf_company_product->toArray();
			$data[] = $row['product_id'];
			$option_items .= "<option value=\"{$row['product_id']}\"  >{$row['name']}</option>\n";
			$i++;
		}
		
		$template->setVar(array (
			"C_ID" => $controller->getID(),
			"OLD_RELATEDLIST" => is_array($data)?implode(",",$data):"",
			"OPTION_ITEMS" => $option_items,
			"RELATED_CONTACT_ADD_URL" => "/product/apf_product/related",
			"RELATED_CONTACT_SUBMIT_URL" => "/company/apf_company/",
			"WEBDIR" => $WebBaseDir,
			"TEMPLATEDIR" => $WebTemplateFullPath,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"TOPIC" => $i18n->_("Company Products Relation"),
			"DOACTION" => "relatedproductsubmit",
			));
			
		$controller->parseTemplateLang();		
		$template->parse("OUT", array (
			"LAOUT",
		));
		$template->p("OUT");
		exit;

	}
	
	function executeRelatedproductsubmit () 
	{
		$old_relatedlist_arr = explode(",",$_POST['old_relatedlist']);
		$relatedlist_arr = $_POST['relatedlist']?$_POST['relatedlist']:array();

		$new_relatedlist_arr =	array_diff($relatedlist_arr,$old_relatedlist_arr);
		$remove_relatedlist_arr = array_diff($old_relatedlist_arr,$relatedlist_arr);
//		Var_Dump::display(array($new_relatedlist_arr,$remove_relatedlist_arr));
		
		if (is_array($new_relatedlist_arr) && sizeof($new_relatedlist_arr)>0) 
		{
		    foreach($new_relatedlist_arr as $product_id)
		    {
				$apf_company_product = DB_DataObject :: factory('ApfCompanyProduct');
				$apf_company_product->setCompanyId($_POST['ID']);
				$apf_company_product->setProductId($product_id);
//				$apf_company_product->debugLevel(4);
				$apf_company_product->insert();
		    }
		}
		
		if (is_array($remove_relatedlist_arr) && sizeof($remove_relatedlist_arr)>0) 
		{
		    foreach($remove_relatedlist_arr as $product_id)
		    {
				$apf_company_product = DB_DataObject :: factory('ApfCompanyProduct');
				$apf_company_product->setCompanyId($_POST['ID']);
				$apf_company_product->setProductId($product_id);
//				$apf_company_product->debugLevel(4);
				$apf_company_product->delete();
		    }
		}
		echo "<SCRIPT LANGUAGE=\"JavaScript\">opener.location.reload( true );window.close(); </SCRIPT>";
		exit;
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_company_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$max_row = 30;
		$apf_company = DB_DataObject :: factory('ApfCompany');

		$apf_company->orderBy('id desc');
		
		if (($keyword = trim($_REQUEST['q'])) != "") 
		{
			$apf_company->whereAdd("name LIKE '%".$apf_company->escape("{$keyword}") . "%' OR addrees LIKE '%".$apf_company->escape("{$keyword}") . "%' OR phone LIKE '%".$apf_company->escape("{$keyword}") . "%' OR link_man LIKE '%".$apf_company->escape("{$keyword}") . "%' ");
		}
		if (($active = trim($_REQUEST['active'])) != "") 
		{
			$apf_company->whereAdd(" active = '".$apf_company->escape("{$active}") . "'  ");
		}
		$ToltalNum = $apf_company->count();
		
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_company->limit($start_num,$max_row);
		$apf_company->find();
		
		$i=0;
		$myData=array();
		while ($apf_company->fetch())
		{
			$myData[] = $apf_company->toArray();
			$i++;
		}
		$tmpData = ($ToltalNum>$max_row)?array_pad($myData, $ToltalNum, array()):$myData;
		$params = array(
		    'itemData' => $tmpData,
		    'perPage' => $max_row,
		    'delta' => 8,             // for 'Jumping'-style a lower number is better
		    'append' => true,
		    'separator' => ' | ',
		    'clearIfVoid' => false,
		    'urlVar' => 'entrant',
		    'useSessions' => true,
		    'closeSession' => true,
		    //'mode'  => 'Sliding',    //try switching modes
		    'mode'  => 'Jumping',
		    'extraVars' => array(
			    'q'  => $_REQUEST['q'],
			    'active'  => $_REQUEST['active'],
		    ),
		
		);
		$pager = & Pager::factory($params);
		$page_data = $pager->getPageData();
		$links = $pager->getLinks();
		
		$selectBox = $pager->getPerPageSelectBox();
		$i = 0;
		foreach($myData as $data)
		{
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";
			
			$template->setVar(array (
				"LIST_TD_CLASS" => $list_td_class
			));
			
			$template->setVar(array ("ID" => $data['id'],"NAME" => "<a href=\"{$WebBaseDir}/company/apf_company/detail/{$data['id']}\" >".$data['name']."</a>","ADDREES" => $data['addrees'],"PHONE" => $data['phone'],"FAX" => $data['fax'],"EMAIL" => $data['email'],"PHOTO" => $data['photo'],"HOMEPAGE" => $data['homepage'],"EMPLOYEE" => $data['employee'],"BANKROLL" => $data['bankroll'],"LINK_MAN" => $data['link_man'],"INCORPORATOR" => $data['incorporator'],"INDUSTRY" => $data['industry'],"PRODUCTS" => $data['products'],"MEMO" => $data['memo'],"ACTIVE" => $data['active'],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		
		$template->setVar(array (
			"KEYWORD" => textTag ("q",$_REQUEST['q']),
			"ACTIVEOPTION" => selectTag("active",$ActiveOption,$_REQUEST['active']),
			"WEBDIR" => $WebBaseDir,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"TOLTAL_NUM" => $ToltalNum,
			"PAGINATION" => $links['all']
		));

	}
	
}
?>