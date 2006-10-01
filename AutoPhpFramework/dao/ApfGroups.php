<?php
/**
 * Table Definition for apf_groups
 */
class DaoApfGroups extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_groups';                      // table name
    var $group_id;                        // int(11)  multiple_key
    var $group_type;                      // int(11)  
    var $group_define_name;               // string(32)  multiple_key
    var $is_active;                       // int(1)  
    var $owner_user_id;                   // int(11)  
    var $owner_group_id;                  // int(11)  

    /* ZE2 compatibility trick*/
    function __clone() { return $this;}

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoApfGroups',$k,$v);
	}


   /**
    * Getter for $GroupId
    *
    * @return   object
    * @access   public
    */
    function getGroupId() 
    {
        return $this->group_id;
    }

   /**
    * Getter for $GroupType
    *
    * @return   int
    * @access   public
    */
    function getGroupType() 
    {
        return $this->group_type;
    }

   /**
    * Getter for $GroupDefineName
    *
    * @return   object
    * @access   public
    */
    function getGroupDefineName() 
    {
        return $this->group_define_name;
    }

   /**
    * Getter for $IsActive
    *
    * @return   int
    * @access   public
    */
    function getIsActive() 
    {
        return $this->is_active;
    }

   /**
    * Getter for $OwnerUserId
    *
    * @return   int
    * @access   public
    */
    function getOwnerUserId() 
    {
        return $this->owner_user_id;
    }

   /**
    * Getter for $OwnerGroupId
    *
    * @return   int
    * @access   public
    */
    function getOwnerGroupId() 
    {
        return $this->owner_group_id;
    }


   /**
    * Setter for $GroupId
    *
    * @param    mixed   input value
    * @access   public
    */
    function setGroupId($value) 
    {
        $this->group_id = $value;
    }

   /**
    * Setter for $GroupType
    *
    * @param    mixed   input value
    * @access   public
    */
    function setGroupType($value) 
    {
        $this->group_type = $value;
    }

   /**
    * Setter for $GroupDefineName
    *
    * @param    mixed   input value
    * @access   public
    */
    function setGroupDefineName($value) 
    {
        $this->group_define_name = $value;
    }

   /**
    * Setter for $IsActive
    *
    * @param    mixed   input value
    * @access   public
    */
    function setIsActive($value) 
    {
        $this->is_active = $value;
    }

   /**
    * Setter for $OwnerUserId
    *
    * @param    mixed   input value
    * @access   public
    */
    function setOwnerUserId($value) 
    {
        $this->owner_user_id = $value;
    }

   /**
    * Setter for $OwnerGroupId
    *
    * @param    mixed   input value
    * @access   public
    */
    function setOwnerGroupId($value) 
    {
        $this->owner_group_id = $value;
    }


    function table()
    {
         return array(
             'group_id' =>  DB_DATAOBJECT_INT,
             'group_type' =>  DB_DATAOBJECT_INT,
             'group_define_name' =>  DB_DATAOBJECT_STR,
             'is_active' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_BOOL,
             'owner_user_id' =>  DB_DATAOBJECT_INT,
             'owner_group_id' =>  DB_DATAOBJECT_INT,
         );
    }

    function keys()
    {
         return array();
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array(false, false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'group_id' => 0,
             'group_type' => 0,
             'group_define_name' => '',
             'is_active' => 1,
             'owner_user_id' => 0,
             'owner_group_id' => 0,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function validateGroup_define_name()
    {
        return empty($this->group_define_name)?false:true;
    }
}
