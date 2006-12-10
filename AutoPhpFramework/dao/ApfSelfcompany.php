<?php
/**
 * Table Definition for apf_selfcompany
 */
class DaoApfSelfcompany extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_selfcompany';                 // table name
    var $id;                              // int(11)  not_null primary_key auto_increment
    var $name;                            // string(50)  multiple_key
    var $addrees;                         // string(150)  
    var $phone;                           // string(80)  
    var $fax;                             // string(80)  
    var $email;                           // string(80)  
    var $photo;                           // string(60)  
    var $homepage;                        // string(90)  
    var $employee;                        // int(5)  
    var $bankroll;                        // real(12)  
    var $link_man;                        // string(50)  
    var $incorporator;                    // string(50)  
    var $industry;                        // string(50)  
    var $taxaccounts;                     // string(120)  
    var $bankaccounts;                    // blob(65535)  blob
    var $products;                        // blob(65535)  blob
    var $memo;                            // blob(65535)  blob
    var $active;                          // string(8)  not_null
    var $access;                          // string(8)  not_null
    var $groupid;                         // string(11)  not_null
    var $userid;                          // int(11)  not_null
    var $add_ip;                          // string(24)  
    var $created_at;                      // datetime(19)  not_null
    var $update_at;                       // datetime(19)  not_null

    /* ZE2 compatibility trick*/
    function __clone() { return $this;}

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoApfSelfcompany',$k,$v);
	}


   /**
    * Getter for $Id
    *
    * @return   int
    * @access   public
    */
    function getId() 
    {
        return $this->id;
    }

   /**
    * Getter for $Name
    *
    * @return   object
    * @access   public
    */
    function getName() 
    {
        return $this->name;
    }

   /**
    * Getter for $Addrees
    *
    * @return   string
    * @access   public
    */
    function getAddrees() 
    {
        return $this->addrees;
    }

   /**
    * Getter for $Phone
    *
    * @return   string
    * @access   public
    */
    function getPhone() 
    {
        return $this->phone;
    }

   /**
    * Getter for $Fax
    *
    * @return   string
    * @access   public
    */
    function getFax() 
    {
        return $this->fax;
    }

   /**
    * Getter for $Email
    *
    * @return   string
    * @access   public
    */
    function getEmail() 
    {
        return $this->email;
    }

   /**
    * Getter for $Photo
    *
    * @return   string
    * @access   public
    */
    function getPhoto() 
    {
        return $this->photo;
    }

   /**
    * Getter for $Homepage
    *
    * @return   string
    * @access   public
    */
    function getHomepage() 
    {
        return $this->homepage;
    }

   /**
    * Getter for $Employee
    *
    * @return   int
    * @access   public
    */
    function getEmployee() 
    {
        return $this->employee;
    }

   /**
    * Getter for $Bankroll
    *
    * @return   real
    * @access   public
    */
    function getBankroll() 
    {
        return $this->bankroll;
    }

   /**
    * Getter for $LinkMan
    *
    * @return   string
    * @access   public
    */
    function getLinkMan() 
    {
        return $this->link_man;
    }

   /**
    * Getter for $Incorporator
    *
    * @return   string
    * @access   public
    */
    function getIncorporator() 
    {
        return $this->incorporator;
    }

   /**
    * Getter for $Industry
    *
    * @return   string
    * @access   public
    */
    function getIndustry() 
    {
        return $this->industry;
    }

   /**
    * Getter for $Taxaccounts
    *
    * @return   string
    * @access   public
    */
    function getTaxaccounts() 
    {
        return $this->taxaccounts;
    }

   /**
    * Getter for $Bankaccounts
    *
    * @return   blob
    * @access   public
    */
    function getBankaccounts() 
    {
        return $this->bankaccounts;
    }

   /**
    * Getter for $Products
    *
    * @return   blob
    * @access   public
    */
    function getProducts() 
    {
        return $this->products;
    }

   /**
    * Getter for $Memo
    *
    * @return   blob
    * @access   public
    */
    function getMemo() 
    {
        return $this->memo;
    }

   /**
    * Getter for $Active
    *
    * @return   string
    * @access   public
    */
    function getActive() 
    {
        return $this->active;
    }

   /**
    * Getter for $Access
    *
    * @return   string
    * @access   public
    */
    function getAccess() 
    {
        return $this->access;
    }

   /**
    * Getter for $Groupid
    *
    * @return   string
    * @access   public
    */
    function getGroupid() 
    {
        return $this->groupid;
    }

   /**
    * Getter for $Userid
    *
    * @return   int
    * @access   public
    */
    function getUserid() 
    {
        return $this->userid;
    }

   /**
    * Getter for $AddIp
    *
    * @return   string
    * @access   public
    */
    function getAddIp() 
    {
        return $this->add_ip;
    }

   /**
    * Getter for $CreatedAt
    *
    * @return   datetime
    * @access   public
    */
    function getCreatedAt() 
    {
        return $this->created_at;
    }

   /**
    * Getter for $UpdateAt
    *
    * @return   datetime
    * @access   public
    */
    function getUpdateAt() 
    {
        return $this->update_at;
    }


   /**
    * Setter for $Id
    *
    * @param    mixed   input value
    * @access   public
    */
    function setId($value) 
    {
        $this->id = $value;
    }

   /**
    * Setter for $Name
    *
    * @param    mixed   input value
    * @access   public
    */
    function setName($value) 
    {
        $this->name = $value;
    }

   /**
    * Setter for $Addrees
    *
    * @param    mixed   input value
    * @access   public
    */
    function setAddrees($value) 
    {
        $this->addrees = $value;
    }

   /**
    * Setter for $Phone
    *
    * @param    mixed   input value
    * @access   public
    */
    function setPhone($value) 
    {
        $this->phone = $value;
    }

   /**
    * Setter for $Fax
    *
    * @param    mixed   input value
    * @access   public
    */
    function setFax($value) 
    {
        $this->fax = $value;
    }

   /**
    * Setter for $Email
    *
    * @param    mixed   input value
    * @access   public
    */
    function setEmail($value) 
    {
        $this->email = $value;
    }

   /**
    * Setter for $Photo
    *
    * @param    mixed   input value
    * @access   public
    */
    function setPhoto($value) 
    {
        $this->photo = $value;
    }

   /**
    * Setter for $Homepage
    *
    * @param    mixed   input value
    * @access   public
    */
    function setHomepage($value) 
    {
        $this->homepage = $value;
    }

   /**
    * Setter for $Employee
    *
    * @param    mixed   input value
    * @access   public
    */
    function setEmployee($value) 
    {
        $this->employee = $value;
    }

   /**
    * Setter for $Bankroll
    *
    * @param    mixed   input value
    * @access   public
    */
    function setBankroll($value) 
    {
        $this->bankroll = $value;
    }

   /**
    * Setter for $LinkMan
    *
    * @param    mixed   input value
    * @access   public
    */
    function setLinkMan($value) 
    {
        $this->link_man = $value;
    }

   /**
    * Setter for $Incorporator
    *
    * @param    mixed   input value
    * @access   public
    */
    function setIncorporator($value) 
    {
        $this->incorporator = $value;
    }

   /**
    * Setter for $Industry
    *
    * @param    mixed   input value
    * @access   public
    */
    function setIndustry($value) 
    {
        $this->industry = $value;
    }

   /**
    * Setter for $Taxaccounts
    *
    * @param    mixed   input value
    * @access   public
    */
    function setTaxaccounts($value) 
    {
        $this->taxaccounts = $value;
    }

   /**
    * Setter for $Bankaccounts
    *
    * @param    mixed   input value
    * @access   public
    */
    function setBankaccounts($value) 
    {
        $this->bankaccounts = $value;
    }

   /**
    * Setter for $Products
    *
    * @param    mixed   input value
    * @access   public
    */
    function setProducts($value) 
    {
        $this->products = $value;
    }

   /**
    * Setter for $Memo
    *
    * @param    mixed   input value
    * @access   public
    */
    function setMemo($value) 
    {
        $this->memo = $value;
    }

   /**
    * Setter for $Active
    *
    * @param    mixed   input value
    * @access   public
    */
    function setActive($value) 
    {
        $this->active = $value;
    }

   /**
    * Setter for $Access
    *
    * @param    mixed   input value
    * @access   public
    */
    function setAccess($value) 
    {
        $this->access = $value;
    }

   /**
    * Setter for $Groupid
    *
    * @param    mixed   input value
    * @access   public
    */
    function setGroupid($value) 
    {
        $this->groupid = $value;
    }

   /**
    * Setter for $Userid
    *
    * @param    mixed   input value
    * @access   public
    */
    function setUserid($value) 
    {
        $this->userid = $value;
    }

   /**
    * Setter for $AddIp
    *
    * @param    mixed   input value
    * @access   public
    */
    function setAddIp($value) 
    {
        $this->add_ip = $value;
    }

   /**
    * Setter for $CreatedAt
    *
    * @param    mixed   input value
    * @access   public
    */
    function setCreatedAt($value) 
    {
        $this->created_at = $value;
    }

   /**
    * Setter for $UpdateAt
    *
    * @param    mixed   input value
    * @access   public
    */
    function setUpdateAt($value) 
    {
        $this->update_at = $value;
    }


    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'name' =>  DB_DATAOBJECT_STR,
             'addrees' =>  DB_DATAOBJECT_STR,
             'phone' =>  DB_DATAOBJECT_STR,
             'fax' =>  DB_DATAOBJECT_STR,
             'email' =>  DB_DATAOBJECT_STR,
             'photo' =>  DB_DATAOBJECT_STR,
             'homepage' =>  DB_DATAOBJECT_STR,
             'employee' =>  DB_DATAOBJECT_INT,
             'bankroll' =>  DB_DATAOBJECT_INT,
             'link_man' =>  DB_DATAOBJECT_STR,
             'incorporator' =>  DB_DATAOBJECT_STR,
             'industry' =>  DB_DATAOBJECT_STR,
             'taxaccounts' =>  DB_DATAOBJECT_STR,
             'bankaccounts' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'products' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'memo' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'active' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'access' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'groupid' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'userid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'add_ip' =>  DB_DATAOBJECT_STR,
             'created_at' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'update_at' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('id', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'name' => '',
             'addrees' => '',
             'phone' => '',
             'fax' => '',
             'email' => '',
             'photo' => '',
             'homepage' => '',
             'link_man' => '',
             'incorporator' => '',
             'industry' => '',
             'taxaccounts' => '',
             'bankaccounts' => '',
             'products' => '',
             'memo' => '',
             'active' => 'new',
             'access' => '',
             'groupid' => '0',
             'userid' => 0,
             'add_ip' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function validateName()
    {
        return empty($this->name)?false:true;
    }
}
