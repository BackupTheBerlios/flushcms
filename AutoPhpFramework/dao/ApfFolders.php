<?php
/**
 * Table Definition for apf_folders
 */
class DaoApfFolders extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_folders';                     // table name
    var $id;                              // int(11)  not_null primary_key unsigned auto_increment
    var $name;                            // string(255)  not_null multiple_key
    var $dirpath;                         // string(255)  not_null
    var $parent;                          // int(4)  
    var $description;                     // blob(65535)  blob
    var $password;                        // string(50)  not_null
    var $groupid;                         // string(11)  not_null
    var $userid;                          // int(4)  not_null
    var $accessing;                       // string(8)  not_null
    var $active;                          // string(8)  not_null
    var $add_ip;                          // string(24)  
    var $created_at;                      // datetime(19)  not_null
    var $update_at;                       // datetime(19)  not_null

    /* ZE2 compatibility trick*/
    function __clone() { return $this;}

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoApfFolders',$k,$v);
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
    * Getter for $Dirpath
    *
    * @return   string
    * @access   public
    */
    function getDirpath() 
    {
        return $this->dirpath;
    }

   /**
    * Getter for $Parent
    *
    * @return   int
    * @access   public
    */
    function getParent() 
    {
        return $this->parent;
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
    * Getter for $Password
    *
    * @return   string
    * @access   public
    */
    function getPassword() 
    {
        return $this->password;
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
    * Getter for $Accessing
    *
    * @return   string
    * @access   public
    */
    function getAccessing() 
    {
        return $this->accessing;
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
    * Setter for $Dirpath
    *
    * @param    mixed   input value
    * @access   public
    */
    function setDirpath($value) 
    {
        $this->dirpath = $value;
    }

   /**
    * Setter for $Parent
    *
    * @param    mixed   input value
    * @access   public
    */
    function setParent($value) 
    {
        $this->parent = $value;
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
    * Setter for $Password
    *
    * @param    mixed   input value
    * @access   public
    */
    function setPassword($value) 
    {
        $this->password = $value;
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
    * Setter for $Accessing
    *
    * @param    mixed   input value
    * @access   public
    */
    function setAccessing($value) 
    {
        $this->accessing = $value;
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
             'name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'dirpath' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'parent' =>  DB_DATAOBJECT_INT,
             'description' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'password' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'groupid' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'userid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'accessing' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
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
             'name' => '',
             'dirpath' => '',
             'description' => '',
             'password' => '',
             'groupid' => '',
             'userid' => 0,
             'accessing' => '',
             'active' => 'live',
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
