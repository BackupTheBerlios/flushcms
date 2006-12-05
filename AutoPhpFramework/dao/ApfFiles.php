<?php
/**
 * Table Definition for apf_files
 */
class DaoApfFiles extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_files';                       // table name
    var $id;                              // int(4)  not_null primary_key unique_key auto_increment
    var $name;                            // string(255)  
    var $parent;                          // int(4)  not_null multiple_key
    var $filename;                        // string(255)  not_null
    var $f_size;                          // int(20)  not_null
    var $userid;                          // int(4)  not_null
    var $created;                         // datetime(19)  not_null
    var $description;                     // blob(65535)  not_null blob
    var $metadata;                        // blob(65535)  not_null blob
    var $groupid;                         // string(11)  not_null
    var $checked_out;                     // int(4)  not_null
    var $major_revision;                  // int(4)  not_null
    var $minor_revision;                  // int(4)  not_null
    var $url;                             // int(4)  not_null multiple_key
    var $password;                        // string(50)  not_null

    /* ZE2 compatibility trick*/
    function __clone() { return $this;}

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoApfFiles',$k,$v);
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
    * @return   string
    * @access   public
    */
    function getName() 
    {
        return $this->name;
    }

   /**
    * Getter for $Parent
    *
    * @return   object
    * @access   public
    */
    function getParent() 
    {
        return $this->parent;
    }

   /**
    * Getter for $Filename
    *
    * @return   string
    * @access   public
    */
    function getFilename() 
    {
        return $this->filename;
    }

   /**
    * Getter for $FSize
    *
    * @return   int
    * @access   public
    */
    function getFSize() 
    {
        return $this->f_size;
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
    * Getter for $Created
    *
    * @return   datetime
    * @access   public
    */
    function getCreated() 
    {
        return $this->created;
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
    * Getter for $Metadata
    *
    * @return   blob
    * @access   public
    */
    function getMetadata() 
    {
        return $this->metadata;
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
    * Getter for $CheckedOut
    *
    * @return   int
    * @access   public
    */
    function getCheckedOut() 
    {
        return $this->checked_out;
    }

   /**
    * Getter for $MajorRevision
    *
    * @return   int
    * @access   public
    */
    function getMajorRevision() 
    {
        return $this->major_revision;
    }

   /**
    * Getter for $MinorRevision
    *
    * @return   int
    * @access   public
    */
    function getMinorRevision() 
    {
        return $this->minor_revision;
    }

   /**
    * Getter for $Url
    *
    * @return   object
    * @access   public
    */
    function getUrl() 
    {
        return $this->url;
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
    * Setter for $Filename
    *
    * @param    mixed   input value
    * @access   public
    */
    function setFilename($value) 
    {
        $this->filename = $value;
    }

   /**
    * Setter for $FSize
    *
    * @param    mixed   input value
    * @access   public
    */
    function setFSize($value) 
    {
        $this->f_size = $value;
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
    * Setter for $Created
    *
    * @param    mixed   input value
    * @access   public
    */
    function setCreated($value) 
    {
        $this->created = $value;
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
    * Setter for $Metadata
    *
    * @param    mixed   input value
    * @access   public
    */
    function setMetadata($value) 
    {
        $this->metadata = $value;
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
    * Setter for $CheckedOut
    *
    * @param    mixed   input value
    * @access   public
    */
    function setCheckedOut($value) 
    {
        $this->checked_out = $value;
    }

   /**
    * Setter for $MajorRevision
    *
    * @param    mixed   input value
    * @access   public
    */
    function setMajorRevision($value) 
    {
        $this->major_revision = $value;
    }

   /**
    * Setter for $MinorRevision
    *
    * @param    mixed   input value
    * @access   public
    */
    function setMinorRevision($value) 
    {
        $this->minor_revision = $value;
    }

   /**
    * Setter for $Url
    *
    * @param    mixed   input value
    * @access   public
    */
    function setUrl($value) 
    {
        $this->url = $value;
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


    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'name' =>  DB_DATAOBJECT_STR,
             'parent' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'filename' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'f_size' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'userid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'created' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'description' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'metadata' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'groupid' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'checked_out' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'major_revision' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'minor_revision' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'url' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'password' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
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
             'parent' => 0,
             'filename' => '',
             'f_size' => 0,
             'userid' => 0,
             'description' => '',
             'metadata' => '',
             'groupid' => '',
             'checked_out' => 0,
             'major_revision' => 0,
             'minor_revision' => 1,
             'url' => 0,
             'password' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function validateName()
    {
        return empty($this->name)?false:true;
    }
}
