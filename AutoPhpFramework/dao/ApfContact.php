<?php
/**
 * Table Definition for apf_contact
 */
class DaoApfContact extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_contact';                     // table name
    var $id;                              // int(11)  not_null primary_key auto_increment
    var $category;                        // int(5)  multiple_key
    var $company_id;                      // int(5)  
    var $name;                            // string(50)  
    var $gender;                          // string(2)  
    var $birthday;                        // date(10)  
    var $addrees;                         // string(150)  
    var $office_phone;                    // string(80)  
    var $phone;                           // string(80)  
    var $fax;                             // string(80)  
    var $mobile;                          // string(80)  
    var $email;                           // string(80)  
    var $photo;                           // string(60)  
    var $homepage;                        // string(90)  
    var $memo;                            // blob(65535)  not_null blob
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
		return DB_DataObject::staticGet('DaoApfContact',$k,$v);
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
    * Getter for $Category
    *
    * @return   object
    * @access   public
    */
    function getCategory() 
    {
        return $this->category;
    }

   /**
    * Getter for $CompanyId
    *
    * @return   int
    * @access   public
    */
    function getCompanyId() 
    {
        return $this->company_id;
    }

   /**
    * Getter for $Name
    *
    * @return   string
    * @access   public
    */
    function getName() 
    {
        return $this->name;
    }

   /**
    * Getter for $Gender
    *
    * @return   string
    * @access   public
    */
    function getGender() 
    {
        return $this->gender;
    }

   /**
    * Getter for $Birthday
    *
    * @return   date
    * @access   public
    */
    function getBirthday() 
    {
        return $this->birthday;
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
    * Getter for $OfficePhone
    *
    * @return   string
    * @access   public
    */
    function getOfficePhone() 
    {
        return $this->office_phone;
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
    * Getter for $Mobile
    *
    * @return   string
    * @access   public
    */
    function getMobile() 
    {
        return $this->mobile;
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
    * Setter for $Category
    *
    * @param    mixed   input value
    * @access   public
    */
    function setCategory($value) 
    {
        $this->category = $value;
    }

   /**
    * Setter for $CompanyId
    *
    * @param    mixed   input value
    * @access   public
    */
    function setCompanyId($value) 
    {
        $this->company_id = $value;
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
    * Setter for $Gender
    *
    * @param    mixed   input value
    * @access   public
    */
    function setGender($value) 
    {
        $this->gender = $value;
    }

   /**
    * Setter for $Birthday
    *
    * @param    mixed   input value
    * @access   public
    */
    function setBirthday($value) 
    {
        $this->birthday = $value;
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
    * Setter for $OfficePhone
    *
    * @param    mixed   input value
    * @access   public
    */
    function setOfficePhone($value) 
    {
        $this->office_phone = $value;
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
    * Setter for $Mobile
    *
    * @param    mixed   input value
    * @access   public
    */
    function setMobile($value) 
    {
        $this->mobile = $value;
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
             'category' =>  DB_DATAOBJECT_INT,
             'company_id' =>  DB_DATAOBJECT_INT,
             'name' =>  DB_DATAOBJECT_STR,
             'gender' =>  DB_DATAOBJECT_STR,
             'birthday' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE,
             'addrees' =>  DB_DATAOBJECT_STR,
             'office_phone' =>  DB_DATAOBJECT_STR,
             'phone' =>  DB_DATAOBJECT_STR,
             'fax' =>  DB_DATAOBJECT_STR,
             'mobile' =>  DB_DATAOBJECT_STR,
             'email' =>  DB_DATAOBJECT_STR,
             'photo' =>  DB_DATAOBJECT_STR,
             'homepage' =>  DB_DATAOBJECT_STR,
             'memo' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
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
             'gender' => '',
             'addrees' => '',
             'office_phone' => '',
             'phone' => '',
             'fax' => '',
             'mobile' => '',
             'email' => '',
             'photo' => '',
             'homepage' => '',
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
