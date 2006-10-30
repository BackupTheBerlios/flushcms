<?php

/**
 *
 * ApfContact.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfContact.class.php,v 1.22 2006/10/30 05:24:37 arzen Exp $
 */

class ApfContact  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$ActiveOption,$GenderOption;

		$template->setFile(array (
			"MAIN" => "apf_contact_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$category_arr =$this->getCategory();
		array_shift($GenderOption);
		array_shift($ActiveOption);

		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"CATEGORYOPTION" => selectTag("category",$category_arr),
			"BIRTHDAYDATE" => inputDateTag ("birthday"),
			"GENDEROPTION" => radioTag("gender",$GenderOption,"m"),
			"FILEPHOTO" => fileTag("photo"),
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,"new"),
			"DOACTION" => "addsubmit"
		));

	}
	
	function executeAddsubmit()
	{
		global $UploadDir;
		$this->handleFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$i18n,$GenderOption,$ActiveOption;
		$template->setFile(array (
			"MAIN" => "apf_contact_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_contact = DB_DataObject :: factory('ApfContact');
		$apf_contact->get($apf_contact->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_contact->getId(),"CATEGORY" => $apf_contact->getCategory(),"COMPANY_ID" => $apf_contact->getCompanyId(),"NAME" => $apf_contact->getName(),"GENDER" => $apf_contact->getGender(),"BIRTHDAY" => $apf_contact->getBirthday(),"ADDREES" => $apf_contact->getAddrees(),"OFFICE_PHONE" => $apf_contact->getOfficePhone(),"PHONE" => $apf_contact->getPhone(),"FAX" => $apf_contact->getFax(),"MOBILE" => $apf_contact->getMobile(),"EMAIL" => $apf_contact->getEmail(),"PHOTO" => $apf_contact->getPhoto(),"HOMEPAGE" => $apf_contact->getHomepage(),"ACTIVE" => $apf_contact->getActive(),"ADD_IP" => $apf_contact->getAddIp(),"CREATED_AT" => $apf_contact->getCreatedAt(),"UPDATE_AT" => $apf_contact->getUpdateAt(),));
		
		$category_arr =$this->getCategory();
		array_shift($GenderOption);
		array_shift($ActiveOption);
		$template->setVar(array (
			"CATEGORYOPTION" => selectTag("category",$category_arr,$apf_contact->getCategory()),
			"BIRTHDAYDATE" => inputDateTag ("birthday",$apf_contact->getBirthday()),
			"GENDEROPTION" => radioTag("gender",$GenderOption,$apf_contact->getGender()),
			"FILEPHOTO" => fileTag("photo",$apf_contact->getPhoto()),
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,$apf_contact->getActive()),
		));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$GenderOption,$ActiveOption,$ClassDir,$UploadDir,$AllowUploadFilesType;
		
		$apf_contact = DB_DataObject :: factory('ApfContact');

		if ($edit_submit) 
		{
			$apf_contact->get($apf_contact->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_contact->setCategory(stripslashes(trim($_POST['category'])));
		$apf_contact->setCompanyId(stripslashes(trim($_POST['company_id'])));
		$apf_contact->setName(stripslashes(trim($_POST['name'])));
		$apf_contact->setGender(stripslashes(trim($_POST['gender'])));
		$apf_contact->setBirthday(stripslashes(trim($_POST['birthday'])));
		$apf_contact->setAddrees(stripslashes(trim($_POST['addrees'])));
		$apf_contact->setOfficePhone(stripslashes(trim($_POST['office_phone'])));
		$apf_contact->setPhone(stripslashes(trim($_POST['phone'])));
		$apf_contact->setFax(stripslashes(trim($_POST['fax'])));
		$apf_contact->setMobile(stripslashes(trim($_POST['mobile'])));
		$apf_contact->setEmail(stripslashes(trim($_POST['email'])));
		$apf_contact->setHomepage(stripslashes(trim($_POST['homepage'])));
		$apf_contact->setActive(stripslashes(trim($_POST['active'])));
		$apf_contact->setAddIp(stripslashes(trim($_POST['add_ip'])));
		
		if ($_POST['photo_del']=='Y') 
		{
			unlink($UploadDir.$_POST['photo_old']);
			$apf_contact->setPhoto("");
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
				$current_date = FileHelper::createCategoryDir($UploadDir,"photo");
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
					$apf_contact->setPhoto($current_date.$dest_name);
				}
			} 
			elseif ($file->isError()) 
			{
				$allow_upload_file = FALSE;
				$upload_error_msg = $file->errorMsg();
			}			
		}
				
		$val = $apf_contact->validate();
		if ( ($val === TRUE) && ($allow_upload_file === TRUE) )
		{
			if ($edit_submit) 
			{
				$apf_contact->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_contact->update();
				$this->forward("contact/apf_contact/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_contact->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_contact->insert();
				$this->forward("contact/apf_contact/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_contact_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"DOACTION" => $do_action
			));
			
			$category_arr =$this->getCategory();
			array_shift($GenderOption);
			array_shift($ActiveOption);
			$template->setVar(array (
				"CATEGORYOPTION" => selectTag("category",$category_arr,$_POST['category']),
				"BIRTHDAYDATE" => inputDateTag ("birthday",$_POST['birthday']),
				"GENDEROPTION" => radioTag("gender",$GenderOption,$_POST['gender']),
				"FILEPHOTO" => fileTag("photo",$_POST['photo_old']),
				"ACTIVEOPTION" => radioTag("active",$ActiveOption,$_POST['active']),
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
			if ($allow_upload_file !== TRUE) 
			{
				$template->setVar(array (
					"PHOTO_ERROR_MSG" => " &darr; {$upload_error_msg} &darr; "
				));
			}
			$template->setVar(
				array (
				"ID" => $_POST['id'],"CATEGORY" => $_POST['category'],"COMPANY_ID" => $_POST['company_id'],"NAME" => $_POST['name'],"GENDER" => $_POST['gender'],"BIRTHDAY" => $_POST['birthday'],"ADDREES" => $_POST['addrees'],"OFFICE_PHONE" => $_POST['office_phone'],"PHONE" => $_POST['phone'],"FAX" => $_POST['fax'],"MOBILE" => $_POST['mobile'],"EMAIL" => $_POST['email'],"PHOTO" => $_POST['photo'],"HOMEPAGE" => $_POST['homepage'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_contact = DB_DataObject :: factory('ApfContact');
		$apf_contact->get($apf_contact->escape($controller->getID()));
		$apf_contact->setActive('deleted');
		$apf_contact->update();
		$this->forward("contact/apf_contact/");
	}
	
	function executeExportword () 
	{
		global $controller,$ClassDir,$UploadDir;
		require_once $ClassDir.'MsDocGenerator.class.php';
		$doc = new clsMsDocGenerator();
		
		$apf_contact = DB_DataObject :: factory('ApfContact');
		$apf_contact->get($apf_contact->escape($controller->getID()));
		$doc->setDocumentCharset("gbk");
		$doc->setDocumentLang("setDocumentLang");
		
		$doc->addParagraph($apf_contact->getName());
		$apf_contact->getPhoto()?$doc->addParagraph($doc->addImage($UploadDir.$apf_contact->getPhoto(),80,80)):"";
		
		$filename = date("Y_m_d").$apf_contact->getName().".doc";
		$doc->output($filename);
		exit;
	}
	
	function executeExportvcard () 
	{
		global $controller,$GenderOption;
		require_once 'Contact_Vcard_Build.php';
		$vcard = new Contact_Vcard_Build();
		
		$apf_contact = DB_DataObject :: factory('ApfContact');
		$apf_contact->get($apf_contact->escape($controller->getID()));
		
	    // set a formatted name
	    $vcard->setFormattedName($apf_contact->getName());
	    
	    // set the structured name parts
	    $vcard->setName($apf_contact->getName(), '', '',
	        $GenderOption[$apf_contact->getGender()], '');
	    
	    // add a work email.  note that we add the value
	    // first and the param after -- Contact_Vcard_Build
	    // is smart enough to add the param in the correct
	    // place.
	    $vcard->addEmail($apf_contact->getEmail());
	    $vcard->addParam('TYPE', 'WORK');
	    
	    // add a home/preferred email
	    $vcard->addEmail($apf_contact->getEmail());
	    $vcard->addParam('TYPE', 'HOME');
	    $vcard->addParam('TYPE', 'PREF');

	    // add a home/preferred Telephone
	    $vcard->addTelephone($apf_contact->getPhone());
	    $vcard->addParam('TYPE', 'HOME');
	    $vcard->addParam('TYPE', 'PREF');

	    // add a home/preferred Telephone
	    $vcard->addTelephone($apf_contact->getMobile());
	    $vcard->addParam('TYPE', 'CELL');
	    $vcard->addParam('TYPE', 'VOICE');
	    
	    // add a work address
	    $vcard->addAddress('', '', $apf_contact->getAddrees(),
	        '', '', '', 'CN');
	    $vcard->addParam('TYPE', 'WORK');
	    $vcard->addParam('TYPE', 'HOME');
	    
	    // set the title (checks for colon-escaping)
//	    $vcard->setTitle('The Title: The Subtitle');

		$vcard->send($apf_contact->getName().".vcf");
		exit;
	}
	
	function executeExport () 
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_contact_export.html"
		));
		$template->setBlock("MAIN", "add_block");
		

		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "exportsubmit"
		));
	}
	
	function executeExportsubmit () 
	{
		switch (strtolower($_POST['what'])) 
		{
			case 'excel':
				$this->exportExcel();
				break;
			case 'pdf':
				$this->exportPDF();
				break;
			case 'csv':
				$this->exportCSV();
				break;
			case 'xml':
				$this->exportXML();
				break;
		}
	}
	
	function exportXML () 
	{
		global $i18n,$ClassDir;
		
		require_once 'XML/Util.php';
		require_once $ClassDir.'StringHelper.class.php';
		
		$header = array(
			"name",
			"gender",
			"birthday",
			"mobile",
			"phone",
			"office_phone",
			"fax",
			"addrees",
			"category",
			"email",
			"homepage",
			);

		$filename = date("Y_m_d")."_contact_export.xml";
		$xml_data = "";
		$xml = new XML_Util;
		$xml_data .=$xml->getXMLDeclaration("1.0", "UTF-8")."\n";
		$xml_data .="".$xml->createStartElement("contact")."\n";

		//		Write contact record
		$apf_contact = DB_DataObject :: factory('ApfContact');
		$apf_contact->orderBy('id desc');
		$apf_contact->find();
		
		while ($apf_contact->fetch())
		{
			$xml_data .="\t".$xml->createStartElement("record")."\n";
			foreach($header as $title)
			{
				$coloum_function = "get".StringHelper::CamelCaseFromUnderscore($title);
				$tag = array(
							  "qname"        => $title,
							  "content"      => $apf_contact->$coloum_function()
							);
				$xml_data .= "\t\t".$xml->createTagFromArray($tag)."\n";
			}
			$xml_data .="\t".$xml->createEndElement("record")."\n";
		}
		
		$xml_data .="".$xml->createEndElement("contact")."\n";
		$xml->send($xml_data,$filename);
		exit;
		
	}
	
	function exportCSV () 
	{
		global $i18n,$ClassDir;
		
		require_once 'File/CSV.php';
		require_once $ClassDir.'StringHelper.class.php';
		$header = array(
			"name",
			"gender",
			"birthday",
			"mobile",
			"phone",
			"office_phone",
			"fax",
			"addrees",
			"category",
			"email",
			"homepage",
			);
			
		$conf = array(
		    'fields' => count($header),
		    'sep'    => ";",
		    'quote'  => '"',
		    'header' => false,
		    'crlf' => "\r\n"
		);
		$filename = date("Y_m_d")."_contact_export.csv";
		$csv = new File_CSV;
		
		//		Write contact record
		$apf_contact = DB_DataObject :: factory('ApfContact');
		$apf_contact->orderBy('id desc');
		$apf_contact->find();
		
		while ($apf_contact->fetch())
		{
			$row_data = array();
			foreach($header as $title)
			{
				$coloum_function = "get".StringHelper::CamelCaseFromUnderscore($title);
				$row_data[] = $apf_contact->$coloum_function();
			}
			$csv->append($row_data, $conf);
		}
		
		$csv->send($filename);
		exit;
		
	}
	
	function exportExcel () 
	{
		global $i18n,$ClassDir;
		require_once 'Spreadsheet/Excel/Writer.php';
		require_once $ClassDir.'StringHelper.class.php';
		
		$header = array(
			"name"=>"30",
			"gender"=>"10",
			"birthday"=>"20",
			"mobile"=>"30",
			"phone"=>"30",
			"office_phone"=>"30",
			"fax"=>"30",
			"addrees"=>"40",
			"category"=>"10",
			"email"=>"30",
			"homepage"=>"40",
			);
		
		// Creating a workbook
		$workbook = new Spreadsheet_Excel_Writer();
		// sending HTTP headers
		$filename = date("Y_m_d")."_contact_export.xls";
		$workbook->send($filename);
		// Creating a worksheet
		$worksheet =& $workbook->addWorksheet($i18n->_('Contact'));
		
		// Write header
		$i=0;
		foreach($header as $title=>$lenght)
		{
			$format_title =& $workbook->addFormat(array('right' => 5, 'top' => 20, 'size' => 14,
                                                      'pattern' => 1, 'bordercolor' => 'blue',
                                                      'Bold '=>1,'Color'=>'yellow','Align'=>'center',
                                                      'fgcolor' => 'blue'));
			$coloum_title = StringHelper::CamelCaseFromUnderscore($title);
			$worksheet->setInputEncoding('gb2312');
			$worksheet->write(0, $i, $i18n->_($coloum_title),$format_title);
			$worksheet->setColumn($i,$i,$lenght);
			$i++;
		}
		//		Write contact record
		$apf_contact = DB_DataObject :: factory('ApfContact');
		$apf_contact->orderBy('id desc');
		$apf_contact->find();
		
		$x=1;
		while ($apf_contact->fetch())
		{
			$y=0;
			foreach($header as $title=>$lenght)
			{
				$coloum_function = "get".StringHelper::CamelCaseFromUnderscore($title);
				$worksheet->setInputEncoding('gb2312');
				$worksheet->write($x, $y, $apf_contact->$coloum_function());
				$y++;
			}
			$x++;
		}
				
		$worksheet->freezePanes(array(1, 1));
				
		$workbook->close();
		exit;
	}
	
	function executeImport () 
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_contact_import.html"
		));
		$template->setBlock("MAIN", "add_block");
		

		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"IMPORTFILE" => fileTag("sourcefile"),
			"DOACTION" => "importsubmit"
		));
	}

	function executeImportsubmit () 
	{
		global $ClassDir,$AllowUploadFilesType,$UploadDir;
		
		$import_file_name="";
		if($_FILES['sourcefile']['name'])
		{
			require_once 'HTTP/Upload.php';
			require_once ($ClassDir."FileHelper.class.php");
			$upload = new http_upload();
			$file = $upload->getFiles('sourcefile');
			$file->setValidExtensions($AllowUploadFilesType,'accept');
			if (PEAR::isError($file)) 
			{
				$allow_upload_file = FALSE;
				$upload_error_msg = $file->getMessage();
			}
			if ($file->isValid()) 
			{
				$file->setName('uniq');
				$current_date = FileHelper::createCategoryDir($UploadDir,"import");
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
					$import_file_name = $UploadDir.$current_date.$dest_name;
				}
			} 
			elseif ($file->isError()) 
			{
				$allow_upload_file = FALSE;
				$upload_error_msg = $file->errorMsg();
			}			
		}
		if (file_exists($import_file_name)) 
		{
			switch (strtolower($_POST['what'])) 
			{
				case 'excel':
					$this->importExcel($import_file_name);
					break;
			}
		}
	}
	
	function importExcel ($import_file_name) 
	{
		global $i18n,$ClassDir;

		require_once 'Spreadsheet/Excel/reader.php';
		require_once $ClassDir.'StringHelper.class.php';
		
		$header = array(
			"name",
			"gender",
			"birthday",
			"mobile",
			"phone",
			"office_phone",
			"fax",
			"addrees",
			"category",
			"email",
			"homepage",
			);

		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('gbk');
		$data->read($import_file_name);
		for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) 
		{
			$apf_contact = DB_DataObject :: factory('ApfContact');
			for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) 
			{
				$coloum_function = "set".StringHelper::CamelCaseFromUnderscore($header[$j-1]);
				$apf_contact->$coloum_function($data->sheets[0]['cells'][$i][$j]);
			}
			$apf_contact->insert();
		}
		unlink($import_file_name);
		$this->forward("contact/apf_contact/");
				
	}
	
	function exportPDF () 
	{
		global $i18n,$ClassDir;
		require_once ('fpdf/PDF_Chinese.php'); 
		require_once $ClassDir.'StringHelper.class.php';
		$header = array(
			"name"=>"20",
			"gender"=>"12",
			"birthday"=>"25",
			"mobile"=>"30",
			"phone"=>"30",
			"office_phone"=>"30",
			"fax"=>"30",
			"addrees"=>"20",
			);

		$pdf=new PDF_Chinese(); 
		$pdf->AddGBFont('simsun','ËÎÌå'); 
		$pdf->AddGBFont('simhei','ºÚÌå'); 
		$pdf->AddGBFont('simkai','¿¬Ìå_GB2312'); 
		$pdf->AddGBFont('sinfang','·ÂËÎ_GB2312'); 
		$pdf->Open(); 
		$pdf->SetMargins(5,20,5);
		$pdf->AddPage();
		$pdf->SetAutoPageBreak("on",20); 
		
		$pdf->SetFont('simsun','',16);
		$pdf->Cell(0,20,$i18n->_('Contact'),0,1,'C');
		
		foreach($header as $title=>$lenght)
		{
			$header_title_arr[] = $i18n->_(StringHelper::CamelCaseFromUnderscore($title));
		}
		
		// Write header
		$pdf->SetFont('simsun','B',7);
		$pdf->SetWidths(array_values($header));
		$pdf->Row(array_values($header_title_arr));

		// Write contact record
		$pdf->SetFont('simsun','',7); 
		$apf_contact = DB_DataObject :: factory('ApfContact');
		$apf_contact->orderBy('id desc');
		$apf_contact->find();
		
		$i=0;
		$page_rows=30;
		while ($apf_contact->fetch())
		{
			(($i%$page_rows == 0) && $i)?$pdf->AddPage():"";
			$coloum_data = array();
			foreach($header as $title=>$lenght)
			{
				$coloum_function = "get".StringHelper::CamelCaseFromUnderscore($title);
				$coloum_data []= $apf_contact->$coloum_function();
			}
			$pdf->Row(array_values($coloum_data));
			$i++;
		}
		
		$pdf->SetFont('Arial','',9);
		$pdf->AliasNbPages();
		
	
		$filename = date("Y_m_d")."_contact_export.pdf";
		$pdf->Output($filename,true);
		exit; 		
	}
	
	function executeRelated () 
	{
		global $controller,$template;
		$this->executeList(true);
		$controller->parseTemplateLang();		
		$template->parse("OUT", array (
			"LAOUT",
		));
		$template->p("OUT");
		exit;
	}
	
	function executeList($is_related=false)
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir,$GenderOption,$ActiveOption,$i18n;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => $is_related?"apf_contact_related_list.html":"apf_contact_list.html"
		));
		$category_arr =array(""=>$i18n->_("All"))+$this->getCategory();
		
		$template->setBlock("MAIN", "main_list", "list_block");

		$max_row = 30;
		$apf_contact = DB_DataObject :: factory('ApfContact');
		
		if (($keyword = trim($_REQUEST['q'])) != "") 
		{
			$apf_contact->whereAdd("name LIKE '%".$apf_contact->escape("{$keyword}") . "%' OR phone LIKE '%".$apf_contact->escape("{$keyword}") . "%' OR mobile LIKE '%".$apf_contact->escape("{$keyword}") . "%' ");
		}
		if (($category = trim($_REQUEST['category'])) != "") 
		{
			$apf_contact->whereAdd(" category = '".$apf_contact->escape("{$category}") . "'  ");
		}
		if (($active = trim($_REQUEST['active'])) != "") 
		{
			$apf_contact->whereAdd(" active = '".$apf_contact->escape("{$active}") . "'  ");
		}
		if (($gender = trim($_REQUEST['gender'])) != "") 
		{
			$apf_contact->whereAdd(" gender = '".$apf_contact->escape("{$gender}") . "'  ");
		}

		$apf_contact->orderBy('id desc');
		$ToltalNum = $apf_contact->count();
		
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_contact->limit($start_num,($start_num+$max_row));
//		$apf_contact->debugLevel(4);
		$apf_contact->find();
		
		$i=0;
		while ($apf_contact->fetch())
		{
			$myData[] = $apf_contact->toArray();
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
			    'category'  => $_REQUEST['category'],
			    'active'  => $_REQUEST['active'],
			    'gender'  => $_REQUEST['gender'],
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
			
			$template->setVar(array ("ID" => $data['id'],"CATEGORY" => $category_arr[$data['category']],"COMPANY_ID" => $data['company_id'],"NAME" => $data['name'],"GENDER" => $GenderOption[$data['gender']],"BIRTHDAY" => $data['birthday'],"ADDREES" => $data['addrees'],"OFFICE_PHONE" => $data['office_phone'],"PHONE" => $data['phone'].$this->getCallIco ($data['phone']),"FAX" => $data['fax'],"MOBILE" => $data['mobile'].$this->getCallIco ($data['mobile'],true),"EMAIL" => $data['email'],"PHOTO" => $data['photo'],"HOMEPAGE" => $data['homepage'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"KEYWORD" => textTag ("q",$_REQUEST['q']),
			"CATEGORYOPTION" => selectTag("category",$category_arr,$_REQUEST['category']),
			"ACTIVEOPTION" => selectTag("active",$ActiveOption,$_REQUEST['active']),
			"GENDEROPTION" => selectTag("gender",$GenderOption,$_REQUEST['gender']),
			"TOLTAL_NUM" => $ToltalNum,
			"PAGINATION" => $links['all']
		));

	}
	
	function getCategory () 
	{
		$apf_contact_category = DB_DataObject :: factory('ApfContactCategory');
		$apf_contact_category->orderBy('id ASC');
		$apf_contact_category->find();
		$myData = array();
		while ($apf_contact_category->fetch())
		{
			$myData[$apf_contact_category->getId()] = $apf_contact_category->getCategoryName();
		}
		return $myData;
	}
	
	function getCallIco ($phone_num,$mobile_phone=false) 
	{
		global $ClassDir,$WebTemplateDir;
		
		include_once($ClassDir."URLHelper.class.php");
		include_once($ClassDir."StringHelper.class.php");
		$phone_num = StringHelper::handleStrNewline ($phone_num);
		$icon = $mobile_phone?"<A HREF='###' ONCLICK=\"remoteCellPhoneSMS.callMobilePhone('{$phone_num}');\" ><IMG SRC='".URLHelper::getWebBaseURL ().$WebTemplateDir."images/cellphone.gif' /></A><A HREF='###' ONCLICK=\"remoteCellPhoneSMS.sendSMS('{$phone_num}');\" ><IMG SRC='".URLHelper::getWebBaseURL ().$WebTemplateDir."images/sms.png' /></A><DIV ID=\"{$phone_num}mobile\" style=\"z-index:10; position:absolute;color:#FFFFFF;\" /><DIV ID=\"{$phone_num}sms\" style=\"z-index:10; position:absolute;color:#FFFFFF;\" />":"<A HREF='###' ONCLICK=\"remoteCellPhoneSMS.callPhone('{$phone_num}');\" ><IMG SRC='".URLHelper::getWebBaseURL ().$WebTemplateDir."images/call.png' /></A><DIV ID=\"{$phone_num}phone\" style=\"z-index:10; position:absolute;\" />";
		if(trim($phone_num))
			return $icon;
		return;
	}
	
}
?>