<?php
/**
 * Table Definition for artist
 */
class DaoArtist extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'artist';                          // table name
    public $Artistid;                        // int(11)  not_null primary_key unsigned auto_increment
    public $Artistcode;                      // string(64)  not_null unique_key
    public $Artistname;                      // string(255)  not_null multiple_key
    public $ArtistnameEng;                  // string(255)  not_null
    public $Gender;                          // string(1)  not_null multiple_key enum
    public $Lang;                            // string(6)  not_null multiple_key enum
    public $Initial;                         // string(4)  not_null multiple_key
    public $Image;                           // string(255)  not_null
    public $ImageStatus;                    // string(7)  not_null multiple_key enum
    public $Imageurl;                        // blob(65535)  not_null blob
    public $Imagex;                          // int(5)  not_null unsigned
    public $Imagey;                          // int(5)  not_null unsigned
    public $Thumburl;                        // blob(65535)  not_null blob
    public $Thumbx;                          // int(5)  not_null unsigned
    public $Thumby;                          // int(5)  not_null unsigned
    public $CreateTime;                     // datetime(19)  not_null
    public $LastUpdated;                    // datetime(19)  not_null
    public $Status;                          // string(7)  not_null multiple_key enum
    public $Popularity;                      // int(5)  not_null multiple_key unsigned

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
        return $this->Artistid;
    }

   /**
    * Getter for $Artistcode
    *
    * @return   string
    * @access   public
    */
    function getArtistcode() 
    {
        return $this->Artistcode;
    }

   /**
    * Getter for $Artistname
    *
    * @return   object
    * @access   public
    */
    function getArtistname() 
    {
        return $this->Artistname;
    }

   /**
    * Getter for $ArtistnameEng
    *
    * @return   string
    * @access   public
    */
    function getArtistnameEng() 
    {
        return $this->ArtistnameEng;
    }

   /**
    * Getter for $Gender
    *
    * @return   object
    * @access   public
    */
    function getGender() 
    {
        return $this->Gender;
    }

   /**
    * Getter for $Lang
    *
    * @return   object
    * @access   public
    */
    function getLang() 
    {
        return $this->Lang;
    }

   /**
    * Getter for $Initial
    *
    * @return   object
    * @access   public
    */
    function getInitial() 
    {
        return $this->Initial;
    }

   /**
    * Getter for $Image
    *
    * @return   string
    * @access   public
    */
    function getImage() 
    {
        return $this->Image;
    }

   /**
    * Getter for $ImageStatus
    *
    * @return   object
    * @access   public
    */
    function getImageStatus() 
    {
        return $this->ImageStatus;
    }

   /**
    * Getter for $Imageurl
    *
    * @return   blob
    * @access   public
    */
    function getImageurl() 
    {
        return $this->Imageurl;
    }

   /**
    * Getter for $Imagex
    *
    * @return   int
    * @access   public
    */
    function getImagex() 
    {
        return $this->Imagex;
    }

   /**
    * Getter for $Imagey
    *
    * @return   int
    * @access   public
    */
    function getImagey() 
    {
        return $this->Imagey;
    }

   /**
    * Getter for $Thumburl
    *
    * @return   blob
    * @access   public
    */
    function getThumburl() 
    {
        return $this->Thumburl;
    }

   /**
    * Getter for $Thumbx
    *
    * @return   int
    * @access   public
    */
    function getThumbx() 
    {
        return $this->Thumbx;
    }

   /**
    * Getter for $Thumby
    *
    * @return   int
    * @access   public
    */
    function getThumby() 
    {
        return $this->Thumby;
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
    * Getter for $Status
    *
    * @return   object
    * @access   public
    */
    function getStatus() 
    {
        return $this->Status;
    }

   /**
    * Getter for $Popularity
    *
    * @return   object
    * @access   public
    */
    function getPopularity() 
    {
        return $this->Popularity;
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
    * Setter for $Artistcode
    *
    * @param    mixed   input value
    * @access   public
    */
     function setArtistcode($value) 
    {
        $this->Artistcode = $value;
    }

   /**
    * Setter for $Artistname
    *
    * @param    mixed   input value
    * @access   public
    */
     function setArtistname($value) 
    {
        $this->Artistname = $value;
    }

   /**
    * Setter for $ArtistnameEng
    *
    * @param    mixed   input value
    * @access   public
    */
     function setArtistnameEng($value) 
    {
        $this->ArtistnameEng = $value;
    }

   /**
    * Setter for $Gender
    *
    * @param    mixed   input value
    * @access   public
    */
     function setGender($value) 
    {
        $this->Gender = $value;
    }

   /**
    * Setter for $Lang
    *
    * @param    mixed   input value
    * @access   public
    */
     function setLang($value) 
    {
        $this->Lang = $value;
    }

   /**
    * Setter for $Initial
    *
    * @param    mixed   input value
    * @access   public
    */
     function setInitial($value) 
    {
        $this->Initial = $value;
    }

   /**
    * Setter for $Image
    *
    * @param    mixed   input value
    * @access   public
    */
     function setImage($value) 
    {
        $this->Image = $value;
    }

   /**
    * Setter for $ImageStatus
    *
    * @param    mixed   input value
    * @access   public
    */
     function setImageStatus($value) 
    {
        $this->ImageStatus = $value;
    }

   /**
    * Setter for $Imageurl
    *
    * @param    mixed   input value
    * @access   public
    */
     function setImageurl($value) 
    {
        $this->Imageurl = $value;
    }

   /**
    * Setter for $Imagex
    *
    * @param    mixed   input value
    * @access   public
    */
     function setImagex($value) 
    {
        $this->Imagex = $value;
    }

   /**
    * Setter for $Imagey
    *
    * @param    mixed   input value
    * @access   public
    */
     function setImagey($value) 
    {
        $this->Imagey = $value;
    }

   /**
    * Setter for $Thumburl
    *
    * @param    mixed   input value
    * @access   public
    */
     function setThumburl($value) 
    {
        $this->Thumburl = $value;
    }

   /**
    * Setter for $Thumbx
    *
    * @param    mixed   input value
    * @access   public
    */
     function setThumbx($value) 
    {
        $this->Thumbx = $value;
    }

   /**
    * Setter for $Thumby
    *
    * @param    mixed   input value
    * @access   public
    */
     function setThumby($value) 
    {
        $this->Thumby = $value;
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

   /**
    * Setter for $Status
    *
    * @param    mixed   input value
    * @access   public
    */
     function setStatus($value) 
    {
        $this->Status = $value;
    }

   /**
    * Setter for $Popularity
    *
    * @param    mixed   input value
    * @access   public
    */
     function setPopularity($value) 
    {
        $this->Popularity = $value;
    }


    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
