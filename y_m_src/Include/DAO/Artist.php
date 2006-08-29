<?php
/**
 * Table Definition for artist
 */
class DataObjects_Artist extends DB_DataObject 
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
		 return DB_DataObject::staticGet('DataObjects_Artist',$k,$v);
	}

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
