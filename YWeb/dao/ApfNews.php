<?php
/**
 * Table Definition for apf_news
 */
class DaoApfNews extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_news';                        // table name
    var $id;                              // int(11)  not_null primary_key auto_increment
    var $category_id;                     // int(8)  not_null
    var $title;                           // string(60)  
    var $content;                         // blob(65535)  blob
    var $active;                          // string(8)  not_null
    var $add_ip;                          // string(24)  
    var $created_at;                      // datetime(19)  not_null
    var $update_at;                       // datetime(19)  not_null

    /* ZE2 compatibility trick*/
    function __clone() { return $this;}

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoApfNews',$k,$v);
	}


   /**
    * Getter for $Id
    *
    * @return   int
    * @access   public
    */
    function getId() 
    {
        return $this->id;
    }

   /**
    * Getter for $CategoryId
    *
    * @return   int
    * @access   public
    */
    function getCategoryId() 
    {
        return $this->category_id;
    }

   /**
    * Getter for $Title
    *
    * @return   string
    * @access   public
    */
    function getTitle() 
    {
        return $this->title;
    }

   /**
    * Getter for $Content
    *
    * @return   blob
    * @access   public
    */
    function getContent() 
    {
        return $this->content;
    }

   /**
    * Getter for $Active
    *
    * @return   string
    * @access   public
    */
    function getActive() 
    {
        return $this->active;
    }

   /**
    * Getter for $AddIp
    *
    * @return   string
    * @access   public
    */
    function getAddIp() 
    {
        return $this->add_ip;
    }

   /**
    * Getter for $CreatedAt
    *
    * @return   datetime
    * @access   public
    */
    function getCreatedAt() 
    {
        return $this->created_at;
    }

   /**
    * Getter for $UpdateAt
    *
    * @return   datetime
    * @access   public
    */
    function getUpdateAt() 
    {
        return $this->update_at;
    }


   /**
    * Setter for $Id
    *
    * @param    mixed   input value
    * @access   public
    */
    function setId($value) 
    {
        $this->id = $value;
    }

   /**
    * Setter for $CategoryId
    *
    * @param    mixed   input value
    * @access   public
    */
    function setCategoryId($value) 
    {
        $this->category_id = $value;
    }

   /**
    * Setter for $Title
    *
    * @param    mixed   input value
    * @access   public
    */
    function setTitle($value) 
    {
        $this->title = $value;
    }

   /**
    * Setter for $Content
    *
    * @param    mixed   input value
    * @access   public
    */
    function setContent($value) 
    {
        $this->content = $value;
    }

   /**
    * Setter for $Active
    *
    * @param    mixed   input value
    * @access   public
    */
    function setActive($value) 
    {
        $this->active = $value;
    }

   /**
    * Setter for $AddIp
    *
    * @param    mixed   input value
    * @access   public
    */
    function setAddIp($value) 
    {
        $this->add_ip = $value;
    }

   /**
    * Setter for $CreatedAt
    *
    * @param    mixed   input value
    * @access   public
    */
    function setCreatedAt($value) 
    {
        $this->created_at = $value;
    }

   /**
    * Setter for $UpdateAt
    *
    * @param    mixed   input value
    * @access   public
    */
    function setUpdateAt($value) 
    {
        $this->update_at = $value;
    }


    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'category_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'title' =>  DB_DATAOBJECT_STR,
             'content' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'active' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'add_ip' =>  DB_DATAOBJECT_STR,
             'created_at' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'update_at' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('id', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'category_id' => 0,
             'title' => '',
             'content' => '',
             'active' => 'new',
             'add_ip' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    function buildCategroyJoin () 
	{
		$this->_join .= " LEFT JOIN apf_news_category ON apf_news_category.id=apf_news.category_id ";
	}

    function validateTitle()
    {
        return empty($this->title)?false:true;
    }
}
