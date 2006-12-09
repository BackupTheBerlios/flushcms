<?php
/**
 * Table Definition for apf_agreement
 */
class DaoApfAgreement extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_agreement';                   // table name
    var $id;                              // int(11)  not_null primary_key unsigned auto_increment
    var $noid;                            // string(255)  not_null multiple_key
    var $category;                        // int(5)  
    var $effectdate;                      // datetime(19)  not_null
    var $expireddate;                     // datetime(19)  not_null
    var $buyer;                           // string(120)  
    var $vender;                          // string(120)  
    var $buyersignature;                  // string(120)  
    var $vendersignature;                 // string(120)  
    var $description;                     // blob(65535)  blob
    var $groupid;                         // string(11)  not_null
    var $userid;                          // int(4)  not_null
    var $access;                          // string(8)  not_null
    var $active;                          // string(8)  not_null
    var $add_ip;                          // string(24)  
    var $created_at;                      // datetime(19)  not_null
    var $update_at;                       // datetime(19)  not_null

    /* ZE2 compatibility trick*/
    function __clone() { return $this;}

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoApfAgreement',$k,$v);
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
    * Getter for $Noid
    *
    * @return   object
    * @access   public
    */
    function getNoid() 
    {
        return $this->noid;
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
    * Getter for $Effectdate
    *
    * @return   datetime
    * @access   public
    */
    function getEffectdate() 
    {
        return $this->effectdate;
    }

   /**
    * Getter for $Expireddate
    *
    * @return   datetime
    * @access   public
    */
    function getExpireddate() 
    {
        return $this->expireddate;
    }

   /**
    * Getter for $Buyer
    *
    * @return   string
    * @access   public
    */
    function getBuyer() 
    {
        return $this->buyer;
    }

   /**
    * Getter for $Vender
    *
    * @return   string
    * @access   public
    */
    function getVender() 
    {
        return $this->vender;
    }

   /**
    * Getter for $Buyersignature
    *
    * @return   string
    * @access   public
    */
    function getBuyersignature() 
    {
        return $this->buyersignature;
    }

   /**
    * Getter for $Vendersignature
    *
    * @return   string
    * @access   public
    */
    function getVendersignature() 
    {
        return $this->vendersignature;
    }

   /**
    * Getter for $Description
    *
    * @return   blob
    * @access   public
    */
    function getDescription() 
    {
        return $this->description;
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
    * Setter for $Noid
    *
    * @param    mixed   input value
    * @access   public
    */
    function setNoid($value) 
    {
        $this->noid = $value;
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
    * Setter for $Effectdate
    *
    * @param    mixed   input value
    * @access   public
    */
    function setEffectdate($value) 
    {
        $this->effectdate = $value;
    }

   /**
    * Setter for $Expireddate
    *
    * @param    mixed   input value
    * @access   public
    */
    function setExpireddate($value) 
    {
        $this->expireddate = $value;
    }

   /**
    * Setter for $Buyer
    *
    * @param    mixed   input value
    * @access   public
    */
    function setBuyer($value) 
    {
        $this->buyer = $value;
    }

   /**
    * Setter for $Vender
    *
    * @param    mixed   input value
    * @access   public
    */
    function setVender($value) 
    {
        $this->vender = $value;
    }

   /**
    * Setter for $Buyersignature
    *
    * @param    mixed   input value
    * @access   public
    */
    function setBuyersignature($value) 
    {
        $this->buyersignature = $value;
    }

   /**
    * Setter for $Vendersignature
    *
    * @param    mixed   input value
    * @access   public
    */
    function setVendersignature($value) 
    {
        $this->vendersignature = $value;
    }

   /**
    * Setter for $Description
    *
    * @param    mixed   input value
    * @access   public
    */
    function setDescription($value) 
    {
        $this->description = $value;
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
             'noid' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'category' =>  DB_DATAOBJECT_INT,
             'effectdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'expireddate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'buyer' =>  DB_DATAOBJECT_STR,
             'vender' =>  DB_DATAOBJECT_STR,
             'buyersignature' =>  DB_DATAOBJECT_STR,
             'vendersignature' =>  DB_DATAOBJECT_STR,
             'description' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'groupid' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'userid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'access' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'active' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
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
             'noid' => '',
             'buyer' => '',
             'vender' => '',
             'buyersignature' => '',
             'vendersignature' => '',
             'description' => '',
             'groupid' => '',
             'userid' => 0,
             'access' => 'public',
             'active' => 'live',
             'add_ip' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
