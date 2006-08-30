<?php
/**
 * Table Definition for profile_items
 */
class DaoProfileItems extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'profile_items';                   // table name
    public $itemid;                          // int(11)  not_null primary_key unsigned auto_increment
    public $artistid;                        // int(11)  not_null multiple_key unsigned
    public $ordr;                            // int(4)  not_null multiple_key unsigned
    public $item_name;                       // string(255)  not_null
    public $item_value;                      // string(255)  not_null
    public $create_time;                     // datetime(19)  not_null binary
    public $last_updated;                    // datetime(19)  not_null binary

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoProfileItems',$k,$v);
	}


   /**
    * Getter for $Itemid
    *
    * @return   int
    * @access   public
    */
    function getItemid() 
    {
        return $this->itemid;
    }

   /**
    * Getter for $Artistid
    *
    * @return   object
    * @access   public
    */
    function getArtistid() 
    {
        return $this->artistid;
    }

   /**
    * Getter for $Ordr
    *
    * @return   object
    * @access   public
    */
    function getOrdr() 
    {
        return $this->ordr;
    }

   /**
    * Getter for $ItemName
    *
    * @return   string
    * @access   public
    */
    function getItemName() 
    {
        return $this->item_name;
    }

   /**
    * Getter for $ItemValue
    *
    * @return   string
    * @access   public
    */
    function getItemValue() 
    {
        return $this->item_value;
    }

   /**
    * Getter for $CreateTime
    *
    * @return   datetime
    * @access   public
    */
    function getCreateTime() 
    {
        return $this->create_time;
    }

   /**
    * Getter for $LastUpdated
    *
    * @return   datetime
    * @access   public
    */
    function getLastUpdated() 
    {
        return $this->last_updated;
    }


   /**
    * Setter for $Itemid
    *
    * @param    mixed   input value
    * @access   public
    */
     function setItemid($value) 
    {
        $this->itemid = $value;
    }

   /**
    * Setter for $Artistid
    *
    * @param    mixed   input value
    * @access   public
    */
     function setArtistid($value) 
    {
        $this->artistid = $value;
    }

   /**
    * Setter for $Ordr
    *
    * @param    mixed   input value
    * @access   public
    */
     function setOrdr($value) 
    {
        $this->ordr = $value;
    }

   /**
    * Setter for $ItemName
    *
    * @param    mixed   input value
    * @access   public
    */
     function setItemName($value) 
    {
        $this->item_name = $value;
    }

   /**
    * Setter for $ItemValue
    *
    * @param    mixed   input value
    * @access   public
    */
     function setItemValue($value) 
    {
        $this->item_value = $value;
    }

   /**
    * Setter for $CreateTime
    *
    * @param    mixed   input value
    * @access   public
    */
     function setCreateTime($value) 
    {
        $this->create_time = $value;
    }

   /**
    * Setter for $LastUpdated
    *
    * @param    mixed   input value
    * @access   public
    */
     function setLastUpdated($value) 
    {
        $this->last_updated = $value;
    }


    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function validateItemid()
    {
        return true;
    }

    function validateArtistid()
    {
        return true;
    }

    function validateOrdr()
    {
        return true;
    }

    function validateItem_name()
    {
        return true;
    }

    function validateItem_value()
    {
        return true;
    }

    function validateCreate_time()
    {
        return true;
    }

    function validateLast_updated()
    {
        return true;
    }
}
