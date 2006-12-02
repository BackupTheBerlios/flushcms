<?php
/**
 * Table Definition for apf_schedule
 */
class DaoApfSchedule extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_schedule';                    // table name
    var $id;                              // int(11)  not_null primary_key unsigned auto_increment
    var $title;                           // string(255)  not_null
    var $description;                     // blob(65535)  blob
    var $publish_date;                    // date(10)  not_null multiple_key
    var $publish_starttime;               // time(8)  not_null multiple_key
    var $publish_endtime;                 // time(8)  not_null
    var $image;                           // string(255)  not_null
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
		return DB_DataObject::staticGet('DaoApfSchedule',$k,$v);
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
    * Getter for $PublishDate
    *
    * @return   object
    * @access   public
    */
    function getPublishDate() 
    {
        return $this->publish_date;
    }

   /**
    * Getter for $PublishStarttime
    *
    * @return   object
    * @access   public
    */
    function getPublishStarttime() 
    {
        return $this->publish_starttime;
    }

   /**
    * Getter for $PublishEndtime
    *
    * @return   time
    * @access   public
    */
    function getPublishEndtime() 
    {
        return $this->publish_endtime;
    }

   /**
    * Getter for $Image
    *
    * @return   string
    * @access   public
    */
    function getImage() 
    {
        return $this->image;
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
    * Setter for $PublishDate
    *
    * @param    mixed   input value
    * @access   public
    */
    function setPublishDate($value) 
    {
        $this->publish_date = $value;
    }

   /**
    * Setter for $PublishStarttime
    *
    * @param    mixed   input value
    * @access   public
    */
    function setPublishStarttime($value) 
    {
        $this->publish_starttime = $value;
    }

   /**
    * Setter for $PublishEndtime
    *
    * @param    mixed   input value
    * @access   public
    */
    function setPublishEndtime($value) 
    {
        $this->publish_endtime = $value;
    }

   /**
    * Setter for $Image
    *
    * @param    mixed   input value
    * @access   public
    */
    function setImage($value) 
    {
        $this->image = $value;
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
             'title' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'description' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'publish_date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_NOTNULL,
             'publish_starttime' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'publish_endtime' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'image' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
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
             'title' => '',
             'description' => '',
             'image' => '',
             'active' => 'live',
             'groupid' => '0',
             'userid' => 0,
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
