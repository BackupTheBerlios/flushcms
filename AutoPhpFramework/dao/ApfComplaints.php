<?php
/**
 * Table Definition for apf_complaints
 */
class DaoApfComplaints extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_complaints';                  // table name
    var $id;                              // int(11)  not_null primary_key unsigned auto_increment
    var $category;                        // int(5)  
    var $complainanter;                   // string(120)  
    var $title;                           // string(120)  not_null
    var $content;                         // blob(65535)  blob
    var $reply;                           // string(2)  not_null
    var $handleman;                       // string(40)  not_null
    var $handledate;                      // datetime(19)  not_null
    var $state;                           // string(8)  not_null
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
		return DB_DataObject::staticGet('DaoApfComplaints',$k,$v);
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
    * Getter for $Complainanter
    *
    * @return   string
    * @access   public
    */
    function getComplainanter() 
    {
        return $this->complainanter;
    }

   /**
    * Getter for $Title
    *
    * @return   string
    * @access   public
    */
    function getTitle() 
    {
        return $this->title;
    }

   /**
    * Getter for $Content
    *
    * @return   blob
    * @access   public
    */
    function getContent() 
    {
        return $this->content;
    }

   /**
    * Getter for $Reply
    *
    * @return   string
    * @access   public
    */
    function getReply() 
    {
        return $this->reply;
    }

   /**
    * Getter for $Handleman
    *
    * @return   string
    * @access   public
    */
    function getHandleman() 
    {
        return $this->handleman;
    }

   /**
    * Getter for $Handledate
    *
    * @return   datetime
    * @access   public
    */
    function getHandledate() 
    {
        return $this->handledate;
    }

   /**
    * Getter for $State
    *
    * @return   string
    * @access   public
    */
    function getState() 
    {
        return $this->state;
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
    * Setter for $Complainanter
    *
    * @param    mixed   input value
    * @access   public
    */
    function setComplainanter($value) 
    {
        $this->complainanter = $value;
    }

   /**
    * Setter for $Title
    *
    * @param    mixed   input value
    * @access   public
    */
    function setTitle($value) 
    {
        $this->title = $value;
    }

   /**
    * Setter for $Content
    *
    * @param    mixed   input value
    * @access   public
    */
    function setContent($value) 
    {
        $this->content = $value;
    }

   /**
    * Setter for $Reply
    *
    * @param    mixed   input value
    * @access   public
    */
    function setReply($value) 
    {
        $this->reply = $value;
    }

   /**
    * Setter for $Handleman
    *
    * @param    mixed   input value
    * @access   public
    */
    function setHandleman($value) 
    {
        $this->handleman = $value;
    }

   /**
    * Setter for $Handledate
    *
    * @param    mixed   input value
    * @access   public
    */
    function setHandledate($value) 
    {
        $this->handledate = $value;
    }

   /**
    * Setter for $State
    *
    * @param    mixed   input value
    * @access   public
    */
    function setState($value) 
    {
        $this->state = $value;
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
             'category' =>  DB_DATAOBJECT_INT,
             'complainanter' =>  DB_DATAOBJECT_STR,
             'title' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'content' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'reply' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'handleman' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'handledate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'state' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
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
             'complainanter' => '',
             'title' => '',
             'content' => '',
             'reply' => 'n',
             'handleman' => '',
             'state' => 'new',
             'groupid' => '',
             'userid' => 0,
             'access' => 'public',
             'active' => 'live',
             'add_ip' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function validateTitle()
    {
        return empty($this->title)?false:true;
    }
}
