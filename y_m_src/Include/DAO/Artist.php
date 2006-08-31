<?php
/**
 * Table Definition for artist
 */
class DaoArtist extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'artist';                          // table name
    public $artistid;                        // int(11)  not_null primary_key unsigned auto_increment
    public $artistcode;                      // string(64)  not_null unique_key
    public $artistname;                      // string(255)  not_null multiple_key
    public $artistname_eng;                  // string(255)  not_null
    public $gender;                          // string(1)  not_null multiple_key enum
    public $lang;                            // string(6)  not_null multiple_key enum
    public $initial;                         // string(4)  not_null multiple_key
    public $image;                           // string(255)  not_null
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
    public $popularity;                      // int(5)  not_null multiple_key unsigned

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoArtist',$k,$v);
	}


   /**
    * Getter for $Artistid
    *
    * @return   int
    * @access   public
    */
    function getArtistid() 
    {
        return $this->artistid;
    }

   /**
    * Getter for $Artistcode
    *
    * @return   string
    * @access   public
    */
    function getArtistcode() 
    {
        return $this->artistcode;
    }

   /**
    * Getter for $Artistname
    *
    * @return   object
    * @access   public
    */
    function getArtistname() 
    {
        return $this->artistname;
    }

   /**
    * Getter for $ArtistnameEng
    *
    * @return   string
    * @access   public
    */
    function getArtistnameEng() 
    {
        return $this->artistname_eng;
    }

   /**
    * Getter for $Gender
    *
    * @return   object
    * @access   public
    */
    function getGender() 
    {
        return $this->gender;
    }

   /**
    * Getter for $Lang
    *
    * @return   object
    * @access   public
    */
    function getLang() 
    {
        return $this->lang;
    }

   /**
    * Getter for $Initial
    *
    * @return   object
    * @access   public
    */
    function getInitial() 
    {
        return $this->initial;
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
    * Getter for $Popularity
    *
    * @return   object
    * @access   public
    */
    function getPopularity() 
    {
        return $this->popularity;
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
    * Setter for $Artistcode
    *
    * @param    mixed   input value
    * @access   public
    */
     function setArtistcode($value) 
    {
        $this->artistcode = $value;
    }

   /**
    * Setter for $Artistname
    *
    * @param    mixed   input value
    * @access   public
    */
     function setArtistname($value) 
    {
        $this->artistname = $value;
    }

   /**
    * Setter for $ArtistnameEng
    *
    * @param    mixed   input value
    * @access   public
    */
     function setArtistnameEng($value) 
    {
        $this->artistname_eng = $value;
    }

   /**
    * Setter for $Gender
    *
    * @param    mixed   input value
    * @access   public
    */
     function setGender($value) 
    {
        $this->gender = $value;
    }

   /**
    * Setter for $Lang
    *
    * @param    mixed   input value
    * @access   public
    */
     function setLang($value) 
    {
        $this->lang = $value;
    }

   /**
    * Setter for $Initial
    *
    * @param    mixed   input value
    * @access   public
    */
     function setInitial($value) 
    {
        $this->initial = $value;
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

   /**
    * Setter for $Popularity
    *
    * @param    mixed   input value
    * @access   public
    */
     function setPopularity($value) 
    {
        $this->popularity = $value;
    }


    function table()
    {
         return array(
             'artistid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'artistcode' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'artistname' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'artistname_eng' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'gender' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'lang' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'initial' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'image' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
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
             'popularity' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('artistid');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('artistid', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'artistcode' => '',
             'artistname' => '',
             'artistname_eng' => '',
             'gender' => 'm',
             'lang' => 'chi',
             'initial' => '',
             'image' => '',
             'image_status' => 'new',
             'imageurl' => '',
             'imagex' => 0,
             'imagey' => 0,
             'thumburl' => '',
             'thumbx' => 0,
             'thumby' => 0,
             'status' => 'new',
             'popularity' => 0,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

}
