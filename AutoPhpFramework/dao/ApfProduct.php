<?php
/**
 * Table Definition for apf_product
 */
class DaoApfProduct extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_product';                     // table name
    var $id;                              // int(11)  not_null primary_key auto_increment
    var $category;                        // int(5)  
    var $company_id;                      // int(5)  
    var $name;                            // string(60)  
    var $price;                           // real(12)  
    var $photo;                           // string(60)  
    var $memo;                            // blob(65535)  blob
    var $active;                          // string(8)  not_null
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
		return DB_DataObject::staticGet('DaoApfProduct',$k,$v);
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
    * @return   int
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
    * Getter for $Price
    *
    * @return   real
    * @access   public
    */
    function getPrice() 
    {
        return $this->price;
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
    * Setter for $Price
    *
    * @param    mixed   input value
    * @access   public
    */
    function setPrice($value) 
    {
        $this->price = $value;
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
             'price' =>  DB_DATAOBJECT_INT,
             'photo' =>  DB_DATAOBJECT_STR,
             'memo' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'active' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
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
             'photo' => '',
             'memo' => '',
             'active' => 'new',
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
