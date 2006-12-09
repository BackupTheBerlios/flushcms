<?php
/**
 * Table Definition for apf_review
 */
class DaoApfReview extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_review';                      // table name
    var $id;                              // int(11)  not_null primary_key unsigned auto_increment
    var $company;                         // string(120)  
    var $linkman;                         // string(120)  
    var $reviewdate;                      // datetime(19)  not_null
    var $CONTENT;                         // blob(65535)  blob
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
		return DB_DataObject::staticGet('DaoApfReview',$k,$v);
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
    * Getter for $Company
    *
    * @return   string
    * @access   public
    */
    function getCompany() 
    {
        return $this->company;
    }

   /**
    * Getter for $Linkman
    *
    * @return   string
    * @access   public
    */
    function getLinkman() 
    {
        return $this->linkman;
    }

   /**
    * Getter for $Reviewdate
    *
    * @return   datetime
    * @access   public
    */
    function getReviewdate() 
    {
        return $this->reviewdate;
    }

   /**
    * Getter for $Content
    *
    * @return   blob
    * @access   public
    */
    function getContent() 
    {
        return $this->CONTENT;
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
    * Setter for $Company
    *
    * @param    mixed   input value
    * @access   public
    */
    function setCompany($value) 
    {
        $this->company = $value;
    }

   /**
    * Setter for $Linkman
    *
    * @param    mixed   input value
    * @access   public
    */
    function setLinkman($value) 
    {
        $this->linkman = $value;
    }

   /**
    * Setter for $Reviewdate
    *
    * @param    mixed   input value
    * @access   public
    */
    function setReviewdate($value) 
    {
        $this->reviewdate = $value;
    }

   /**
    * Setter for $Content
    *
    * @param    mixed   input value
    * @access   public
    */
    function setContent($value) 
    {
        $this->CONTENT = $value;
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
             'company' =>  DB_DATAOBJECT_STR,
             'linkman' =>  DB_DATAOBJECT_STR,
             'reviewdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'CONTENT' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
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
             'company' => '',
             'linkman' => '',
             'CONTENT' => '',
             'groupid' => '',
             'userid' => 0,
             'access' => 'public',
             'active' => 'live',
             'add_ip' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function validateContent()
    {
        return empty($this->CONTENT)?false:true;
    }
}
