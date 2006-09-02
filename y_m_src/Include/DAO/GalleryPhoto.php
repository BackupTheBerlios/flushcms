<?php
/**
 * Copyright Yahoo! Hong Kong Limited. (c) 2006. All rights reserved.
 *
 * Table Definition for gallery_photo
 *  
 * Created on 2006-9-1
 * Modify List as below:
 * Date        Author    Version  Changes
 * 2006-09-01  Harry Lu  1.0      Initial    
 * 
 */
 
class DaoGalleryPhoto extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'gallery_photo';                   // table name
    public $gal_photoid;                     // int(11)  not_null primary_key unsigned auto_increment
    public $gal_eventid;                     // int(11)  not_null multiple_key unsigned
    public $artistid;                        // int(11)  not_null multiple_key unsigned
    public $image;                           // string(255)  not_null
    public $caption;                         // blob(65535)  not_null blob
    public $image_status;                    // string(7)  not_null multiple_key enum
    public $imageurl;                        // blob(65535)  not_null blob
    public $imagex;                          // int(5)  not_null unsigned
    public $imagey;                          // int(5)  not_null unsigned
    public $thumburl;                        // blob(65535)  not_null blob
    public $thumbx;                          // int(5)  not_null unsigned
    public $thumby;                          // int(5)  not_null unsigned
    public $create_time;                     // datetime(19)  not_null binary
    public $last_updated;                    // datetime(19)  not_null binary
    public $status;                          // string(7)  not_null multiple_key enum

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoGalleryPhoto',$k,$v);
	}


   /**
    * Getter for $GalPhotoid
    *
    * @return   int
    * @access   public
    */
    function getGalPhotoid() 
    {
        return $this->gal_photoid;
    }

   /**
    * Getter for $GalEventid
    *
    * @return   object
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
    * Getter for $Caption
    *
    * @return   blob
    * @access   public
    */
    function getCaption() 
    {
        return $this->caption;
    }

   /**
    * Getter for $ImageStatus
    *
    * @return   object
    * @access   public
    */
    function getImageStatus() 
    {
        return $this->image_status;
    }

   /**
    * Getter for $Imageurl
    *
    * @return   blob
    * @access   public
    */
    function getImageurl() 
    {
        return $this->imageurl;
    }

   /**
    * Getter for $Imagex
    *
    * @return   int
    * @access   public
    */
    function getImagex() 
    {
        return $this->imagex;
    }

   /**
    * Getter for $Imagey
    *
    * @return   int
    * @access   public
    */
    function getImagey() 
    {
        return $this->imagey;
    }

   /**
    * Getter for $Thumburl
    *
    * @return   blob
    * @access   public
    */
    function getThumburl() 
    {
        return $this->thumburl;
    }

   /**
    * Getter for $Thumbx
    *
    * @return   int
    * @access   public
    */
    function getThumbx() 
    {
        return $this->thumbx;
    }

   /**
    * Getter for $Thumby
    *
    * @return   int
    * @access   public
    */
    function getThumby() 
    {
        return $this->thumby;
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
    * Getter for $Status
    *
    * @return   object
    * @access   public
    */
    function getStatus() 
    {
        return $this->status;
    }


   /**
    * Setter for $GalPhotoid
    *
    * @param    mixed   input value
    * @access   public
    */
     function setGalPhotoid($value) 
    {
        $this->gal_photoid = $value;
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
    * Setter for $Caption
    *
    * @param    mixed   input value
    * @access   public
    */
     function setCaption($value) 
    {
        $this->caption = $value;
    }

   /**
    * Setter for $ImageStatus
    *
    * @param    mixed   input value
    * @access   public
    */
     function setImageStatus($value) 
    {
        $this->image_status = $value;
    }

   /**
    * Setter for $Imageurl
    *
    * @param    mixed   input value
    * @access   public
    */
     function setImageurl($value) 
    {
        $this->imageurl = $value;
    }

   /**
    * Setter for $Imagex
    *
    * @param    mixed   input value
    * @access   public
    */
     function setImagex($value) 
    {
        $this->imagex = $value;
    }

   /**
    * Setter for $Imagey
    *
    * @param    mixed   input value
    * @access   public
    */
     function setImagey($value) 
    {
        $this->imagey = $value;
    }

   /**
    * Setter for $Thumburl
    *
    * @param    mixed   input value
    * @access   public
    */
     function setThumburl($value) 
    {
        $this->thumburl = $value;
    }

   /**
    * Setter for $Thumbx
    *
    * @param    mixed   input value
    * @access   public
    */
     function setThumbx($value) 
    {
        $this->thumbx = $value;
    }

   /**
    * Setter for $Thumby
    *
    * @param    mixed   input value
    * @access   public
    */
     function setThumby($value) 
    {
        $this->thumby = $value;
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

   /**
    * Setter for $Status
    *
    * @param    mixed   input value
    * @access   public
    */
     function setStatus($value) 
    {
        $this->status = $value;
    }


    function table()
    {
         return array(
             'gal_photoid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'gal_eventid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'artistid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'image' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'caption' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'image_status' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'imageurl' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'imagex' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'imagey' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'thumburl' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'thumbx' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'thumby' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'create_time' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'last_updated' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'status' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('gal_photoid');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('gal_photoid', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'gal_eventid' => 0,
             'image' => '',
             'caption' => '',
             'image_status' => 'new',
             'imageurl' => '',
             'imagex' => 0,
             'imagey' => 0,
             'thumburl' => '',
             'thumbx' => 0,
             'thumby' => 0,
             'status' => 'new',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function validateGal_photoid()
    {
        return true;
    }

    function validateGal_eventid()
    {
        return true;
    }

    function validateArtistid()
    {
        return true;
    }

    function validateImage()
    {
        return true;
    }

    function validateCaption()
    {
        return true;
    }

    function validateImage_status()
    {
        return true;
    }

    function validateImageurl()
    {
        return true;
    }

    function validateImagex()
    {
        return true;
    }

    function validateImagey()
    {
        return true;
    }

    function validateThumburl()
    {
        return true;
    }

    function validateThumbx()
    {
        return true;
    }

    function validateThumby()
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

    function validateStatus()
    {
        return true;
    }
    
    function buildArtistJoin() 
	{
		$this->_join = " LEFT JOIN artist ON artist.artistid = gallery_photo.artistid ";
	}
}
