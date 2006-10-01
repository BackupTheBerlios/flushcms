<?php
/**
 * Table Definition for apf_rights
 */
class DaoApfRights extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_rights';                      // table name
    var $right_id;                        // int(11)  multiple_key
    var $area_id;                         // int(11)  multiple_key
    var $right_define_name;               // string(32)  
    var $has_implied;                     // int(1)  

    /* ZE2 compatibility trick*/
    function __clone() { return $this;}

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoApfRights',$k,$v);
	}


   /**
    * Getter for $RightId
    *
    * @return   object
    * @access   public
    */
    function getRightId() 
    {
        return $this->right_id;
    }

   /**
    * Getter for $AreaId
    *
    * @return   object
    * @access   public
    */
    function getAreaId() 
    {
        return $this->area_id;
    }

   /**
    * Getter for $RightDefineName
    *
    * @return   string
    * @access   public
    */
    function getRightDefineName() 
    {
        return $this->right_define_name;
    }

   /**
    * Getter for $HasImplied
    *
    * @return   int
    * @access   public
    */
    function getHasImplied() 
    {
        return $this->has_implied;
    }


   /**
    * Setter for $RightId
    *
    * @param    mixed   input value
    * @access   public
    */
    function setRightId($value) 
    {
        $this->right_id = $value;
    }

   /**
    * Setter for $AreaId
    *
    * @param    mixed   input value
    * @access   public
    */
    function setAreaId($value) 
    {
        $this->area_id = $value;
    }

   /**
    * Setter for $RightDefineName
    *
    * @param    mixed   input value
    * @access   public
    */
    function setRightDefineName($value) 
    {
        $this->right_define_name = $value;
    }

   /**
    * Setter for $HasImplied
    *
    * @param    mixed   input value
    * @access   public
    */
    function setHasImplied($value) 
    {
        $this->has_implied = $value;
    }


    function table()
    {
         return array(
             'right_id' =>  DB_DATAOBJECT_INT,
             'area_id' =>  DB_DATAOBJECT_INT,
             'right_define_name' =>  DB_DATAOBJECT_STR,
             'has_implied' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_BOOL,
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
             'right_id' => 0,
             'area_id' => 0,
             'right_define_name' => '',
             'has_implied' => 1,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function validateRight_define_name()
    {
        return empty($this->right_define_name)?false:true;
    }
}
