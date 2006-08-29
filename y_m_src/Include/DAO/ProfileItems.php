<?php
/**
 * Table Definition for profile_items
 */
class DaoProfileItems extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'profile_items';                   // table name
    public $Itemid;                          // int(11)  not_null primary_key unsigned auto_increment
    public $Artistid;                        // int(11)  not_null multiple_key unsigned
    public $Ordr;                            // int(4)  not_null multiple_key unsigned
    public $ItemName;                       // string(255)  not_null
    public $ItemValue;                      // string(255)  not_null
    public $CreateTime;                     // datetime(19)  not_null
    public $LastUpdated;                    // datetime(19)  not_null

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
        return $this->Itemid;
    }

   /**
    * Getter for $Artistid
    *
    * @return   object
    * @access   public
    */
    function getArtistid() 
    {
        return $this->Artistid;
    }

   /**
    * Getter for $Ordr
    *
    * @return   object
    * @access   public
    */
    function getOrdr() 
    {
        return $this->Ordr;
    }

   /**
    * Getter for $ItemName
    *
    * @return   string
    * @access   public
    */
    function getItemName() 
    {
        return $this->ItemName;
    }

   /**
    * Getter for $ItemValue
    *
    * @return   string
    * @access   public
    */
    function getItemValue() 
    {
        return $this->ItemValue;
    }

   /**
    * Getter for $CreateTime
    *
    * @return   datetime
    * @access   public
    */
    function getCreateTime() 
    {
        return $this->CreateTime;
    }

   /**
    * Getter for $LastUpdated
    *
    * @return   datetime
    * @access   public
    */
    function getLastUpdated() 
    {
        return $this->LastUpdated;
    }


   /**
    * Setter for $Itemid
    *
    * @param    mixed   input value
    * @access   public
    */
     function setItemid($value) 
    {
        $this->Itemid = $value;
    }

   /**
    * Setter for $Artistid
    *
    * @param    mixed   input value
    * @access   public
    */
     function setArtistid($value) 
    {
        $this->Artistid = $value;
    }

   /**
    * Setter for $Ordr
    *
    * @param    mixed   input value
    * @access   public
    */
     function setOrdr($value) 
    {
        $this->Ordr = $value;
    }

   /**
    * Setter for $ItemName
    *
    * @param    mixed   input value
    * @access   public
    */
     function setItemName($value) 
    {
        $this->ItemName = $value;
    }

   /**
    * Setter for $ItemValue
    *
    * @param    mixed   input value
    * @access   public
    */
     function setItemValue($value) 
    {
        $this->ItemValue = $value;
    }

   /**
    * Setter for $CreateTime
    *
    * @param    mixed   input value
    * @access   public
    */
     function setCreateTime($value) 
    {
        $this->CreateTime = $value;
    }

   /**
    * Setter for $LastUpdated
    *
    * @param    mixed   input value
    * @access   public
    */
     function setLastUpdated($value) 
    {
        $this->LastUpdated = $value;
    }


    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
