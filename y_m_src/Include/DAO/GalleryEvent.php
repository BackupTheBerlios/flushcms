<?php
/**
 * Copyright Yahoo! Hong Kong Limited. (c) 2006. All rights reserved.
 *
 * Table Definition for gallery_event
 *  
 * Created on 2006-9-1
 * Modify List as below:
 * Date        Author    Version  Changes
 * 2006-09-01  Harry Lu  1.0      Initial    
 * 
 */
 	
class DaoGalleryEvent extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'gallery_event';                   // table name
    public $gal_eventid;                     // int(11)  not_null primary_key unsigned auto_increment
    public $artistid;                        // int(11)  not_null multiple_key unsigned
    public $gal_eventname;                   // string(255)  not_null
    public $create_time;                     // datetime(19)  not_null binary
    public $last_updated;                    // datetime(19)  not_null binary

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoGalleryEvent',$k,$v);
	}


   /**
    * Getter for $GalEventid
    *
    * @return   int
    * @access   public
    */
    function getGalEventid() 
    {
        return $this->gal_eventid;
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
    * Getter for $GalEventname
    *
    * @return   string
    * @access   public
    */
    function getGalEventname() 
    {
        return $this->gal_eventname;
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
    * Setter for $GalEventid
    *
    * @param    mixed   input value
    * @access   public
    */
     function setGalEventid($value) 
    {
        $this->gal_eventid = $value;
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
    * Setter for $GalEventname
    *
    * @param    mixed   input value
    * @access   public
    */
     function setGalEventname($value) 
    {
        $this->gal_eventname = $value;
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
             'gal_eventid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'artistid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'gal_eventname' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'create_time' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'last_updated' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('gal_eventid');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('gal_eventid', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'gal_eventname' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function validateGal_eventid()
    {
        return true;
    }

    function validateArtistid()
    {
        return true;
    }

    function validateGal_eventname()
    {
        return empty($this->gal_eventname)? false : true;
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
