<?php
/**
 * Table Definition for apf_product_price
 */
class DaoApfProductPrice extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_product_price';               // table name
    var $id;                              // int(11)  not_null primary_key auto_increment
    var $company_id;                      // int(11)  multiple_key
    var $product_id;                      // int(11)  multiple_key
    var $price;                           // real(12)  
    var $add_ip;                          // string(24)  
    var $created_at;                      // datetime(19)  not_null
    var $update_at;                       // datetime(19)  not_null

    /* ZE2 compatibility trick*/
    function __clone() { return $this;}

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoApfProductPrice',$k,$v);
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
    * Getter for $CompanyId
    *
    * @return   object
    * @access   public
    */
    function getCompanyId() 
    {
        return $this->company_id;
    }

   /**
    * Getter for $ProductId
    *
    * @return   object
    * @access   public
    */
    function getProductId() 
    {
        return $this->product_id;
    }

   /**
    * Getter for $Price
    *
    * @return   real
    * @access   public
    */
    function getPrice() 
    {
        return $this->price;
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
    * Setter for $CompanyId
    *
    * @param    mixed   input value
    * @access   public
    */
    function setCompanyId($value) 
    {
        $this->company_id = $value;
    }

   /**
    * Setter for $ProductId
    *
    * @param    mixed   input value
    * @access   public
    */
    function setProductId($value) 
    {
        $this->product_id = $value;
    }

   /**
    * Setter for $Price
    *
    * @param    mixed   input value
    * @access   public
    */
    function setPrice($value) 
    {
        $this->price = $value;
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
             'company_id' =>  DB_DATAOBJECT_INT,
             'product_id' =>  DB_DATAOBJECT_INT,
             'price' =>  DB_DATAOBJECT_INT,
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
             'add_ip' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function validatePrice()
    {
        return empty($this->price)?false:true;
    }
}
