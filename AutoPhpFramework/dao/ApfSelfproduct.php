<?php
/**
 * Table Definition for apf_selfproduct
 */
class DaoApfSelfproduct extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_selfproduct';                 // table name
    var $id;                              // int(11)  not_null primary_key auto_increment
    var $productname;                     // string(60)  
    var $retailprice;                     // real(12)  
    var $wholesaleprice;                  // real(12)  
    var $costprice;                       // real(12)  
    var $photo;                           // string(60)  
    var $releasedate;                     // datetime(19)  not_null
    var $memo;                            // blob(65535)  blob
    var $access;                          // string(8)  not_null
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
		return DB_DataObject::staticGet('DaoApfSelfproduct',$k,$v);
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
    * Getter for $Productname
    *
    * @return   string
    * @access   public
    */
    function getProductname() 
    {
        return $this->productname;
    }

   /**
    * Getter for $Retailprice
    *
    * @return   real
    * @access   public
    */
    function getRetailprice() 
    {
        return $this->retailprice;
    }

   /**
    * Getter for $Wholesaleprice
    *
    * @return   real
    * @access   public
    */
    function getWholesaleprice() 
    {
        return $this->wholesaleprice;
    }

   /**
    * Getter for $Costprice
    *
    * @return   real
    * @access   public
    */
    function getCostprice() 
    {
        return $this->costprice;
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
    * Getter for $Releasedate
    *
    * @return   datetime
    * @access   public
    */
    function getReleasedate() 
    {
        return $this->releasedate;
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
    * Setter for $Productname
    *
    * @param    mixed   input value
    * @access   public
    */
    function setProductname($value) 
    {
        $this->productname = $value;
    }

   /**
    * Setter for $Retailprice
    *
    * @param    mixed   input value
    * @access   public
    */
    function setRetailprice($value) 
    {
        $this->retailprice = $value;
    }

   /**
    * Setter for $Wholesaleprice
    *
    * @param    mixed   input value
    * @access   public
    */
    function setWholesaleprice($value) 
    {
        $this->wholesaleprice = $value;
    }

   /**
    * Setter for $Costprice
    *
    * @param    mixed   input value
    * @access   public
    */
    function setCostprice($value) 
    {
        $this->costprice = $value;
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
    * Setter for $Releasedate
    *
    * @param    mixed   input value
    * @access   public
    */
    function setReleasedate($value) 
    {
        $this->releasedate = $value;
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
             'productname' =>  DB_DATAOBJECT_STR,
             'retailprice' =>  DB_DATAOBJECT_INT,
             'wholesaleprice' =>  DB_DATAOBJECT_INT,
             'costprice' =>  DB_DATAOBJECT_INT,
             'photo' =>  DB_DATAOBJECT_STR,
             'releasedate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'memo' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'access' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
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
             'productname' => '',
             'photo' => '',
             'memo' => '',
             'access' => 'public',
             'active' => 'new',
             'groupid' => '0',
             'userid' => 0,
             'add_ip' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function validateProductname()
    {
        return empty($this->productname)?false:true;
    }
}
