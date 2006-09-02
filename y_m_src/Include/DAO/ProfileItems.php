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


    function table()
    {
         return array(
             'itemid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'artistid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'ordr' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'item_name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'item_value' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'create_time' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'last_updated' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('itemid');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('itemid', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'ordr' => 0,
             'item_name' => '',
             'item_value' => '',
         );
    }
    
	function buildArtistJoin() 
	{
		$this->_join = " LEFT JOIN artist ON artist.artistid=profile_items.artistid ";
	}
	

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function validateItem_name()
    {
        return empty($this->item_name)?false:true;
    }

    function validateItem_value()
    {
        return empty($this->item_value)?false:true;
    }
}
