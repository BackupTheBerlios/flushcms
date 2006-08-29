<?php
/**
 * Table Definition for profile_items
 */
class DataObjects_Profile_items extends DB_DataObject 
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
		 return DB_DataObject::staticGet('DataObjects_Profile_items',$k,$v);
	}

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
