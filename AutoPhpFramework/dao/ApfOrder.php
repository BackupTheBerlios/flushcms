<?php
/**
 * Table Definition for apf_order
 */
class DaoApfOrder extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_order';                       // table name
    var $id;                              // int(11)  not_null primary_key unsigned auto_increment
    var $noid;                            // string(255)  not_null multiple_key
    var $category;                        // int(5)  
    var $contactid;                       // int(8)  
    var $product;                         // string(60)  
    var $amount;                          // int(8)  
    var $money;                           // real(12)  
    var $discount;                        // int(2)  
    var $payway;                          // string(30)  not_null
    var $deliveryway;                     // string(30)  not_null
    var $deliverydatetime;                // datetime(19)  not_null
    var $state;                           // string(8)  not_null
    var $memo;                            // blob(65535)  blob
    var $groupid;                         // string(11)  not_null
    var $userid;                          // int(4)  not_null
    var $access;                          // string(8)  not_null
    var $active;                          // string(8)  not_null
    var $add_ip;                          // string(24)  
    var $created_at;                      // datetime(19)  not_null
    var $update_at;                       // datetime(19)  not_null

    /* ZE2 compatibility trick*/
    function __clone() { return $this;}

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoApfOrder',$k,$v);
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
    * Getter for $Noid
    *
    * @return   object
    * @access   public
    */
    function getNoid() 
    {
        return $this->noid;
    }

   /**
    * Getter for $Category
    *
    * @return   int
    * @access   public
    */
    function getCategory() 
    {
        return $this->category;
    }

   /**
    * Getter for $Contactid
    *
    * @return   int
    * @access   public
    */
    function getContactid() 
    {
        return $this->contactid;
    }

   /**
    * Getter for $Product
    *
    * @return   string
    * @access   public
    */
    function getProduct() 
    {
        return $this->product;
    }

   /**
    * Getter for $Amount
    *
    * @return   int
    * @access   public
    */
    function getAmount() 
    {
        return $this->amount;
    }

   /**
    * Getter for $Money
    *
    * @return   real
    * @access   public
    */
    function getMoney() 
    {
        return $this->money;
    }

   /**
    * Getter for $Discount
    *
    * @return   int
    * @access   public
    */
    function getDiscount() 
    {
        return $this->discount;
    }

   /**
    * Getter for $Payway
    *
    * @return   string
    * @access   public
    */
    function getPayway() 
    {
        return $this->payway;
    }

   /**
    * Getter for $Deliveryway
    *
    * @return   string
    * @access   public
    */
    function getDeliveryway() 
    {
        return $this->deliveryway;
    }

   /**
    * Getter for $Deliverydatetime
    *
    * @return   datetime
    * @access   public
    */
    function getDeliverydatetime() 
    {
        return $this->deliverydatetime;
    }

   /**
    * Getter for $State
    *
    * @return   string
    * @access   public
    */
    function getState() 
    {
        return $this->state;
    }

   /**
    * Getter for $Memo
    *
    * @return   blob
    * @access   public
    */
    function getMemo() 
    {
        return $this->memo;
    }

   /**
    * Getter for $Groupid
    *
    * @return   string
    * @access   public
    */
    function getGroupid() 
    {
        return $this->groupid;
    }

   /**
    * Getter for $Userid
    *
    * @return   int
    * @access   public
    */
    function getUserid() 
    {
        return $this->userid;
    }

   /**
    * Getter for $Access
    *
    * @return   string
    * @access   public
    */
    function getAccess() 
    {
        return $this->access;
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
    * Setter for $Noid
    *
    * @param    mixed   input value
    * @access   public
    */
    function setNoid($value) 
    {
        $this->noid = $value;
    }

   /**
    * Setter for $Category
    *
    * @param    mixed   input value
    * @access   public
    */
    function setCategory($value) 
    {
        $this->category = $value;
    }

   /**
    * Setter for $Contactid
    *
    * @param    mixed   input value
    * @access   public
    */
    function setContactid($value) 
    {
        $this->contactid = $value;
    }

   /**
    * Setter for $Product
    *
    * @param    mixed   input value
    * @access   public
    */
    function setProduct($value) 
    {
        $this->product = $value;
    }

   /**
    * Setter for $Amount
    *
    * @param    mixed   input value
    * @access   public
    */
    function setAmount($value) 
    {
        $this->amount = $value;
    }

   /**
    * Setter for $Money
    *
    * @param    mixed   input value
    * @access   public
    */
    function setMoney($value) 
    {
        $this->money = $value;
    }

   /**
    * Setter for $Discount
    *
    * @param    mixed   input value
    * @access   public
    */
    function setDiscount($value) 
    {
        $this->discount = $value;
    }

   /**
    * Setter for $Payway
    *
    * @param    mixed   input value
    * @access   public
    */
    function setPayway($value) 
    {
        $this->payway = $value;
    }

   /**
    * Setter for $Deliveryway
    *
    * @param    mixed   input value
    * @access   public
    */
    function setDeliveryway($value) 
    {
        $this->deliveryway = $value;
    }

   /**
    * Setter for $Deliverydatetime
    *
    * @param    mixed   input value
    * @access   public
    */
    function setDeliverydatetime($value) 
    {
        $this->deliverydatetime = $value;
    }

   /**
    * Setter for $State
    *
    * @param    mixed   input value
    * @access   public
    */
    function setState($value) 
    {
        $this->state = $value;
    }

   /**
    * Setter for $Memo
    *
    * @param    mixed   input value
    * @access   public
    */
    function setMemo($value) 
    {
        $this->memo = $value;
    }

   /**
    * Setter for $Groupid
    *
    * @param    mixed   input value
    * @access   public
    */
    function setGroupid($value) 
    {
        $this->groupid = $value;
    }

   /**
    * Setter for $Userid
    *
    * @param    mixed   input value
    * @access   public
    */
    function setUserid($value) 
    {
        $this->userid = $value;
    }

   /**
    * Setter for $Access
    *
    * @param    mixed   input value
    * @access   public
    */
    function setAccess($value) 
    {
        $this->access = $value;
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
             'noid' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'category' =>  DB_DATAOBJECT_INT,
             'contactid' =>  DB_DATAOBJECT_INT,
             'product' =>  DB_DATAOBJECT_STR,
             'amount' =>  DB_DATAOBJECT_INT,
             'money' =>  DB_DATAOBJECT_INT,
             'discount' =>  DB_DATAOBJECT_INT,
             'payway' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'deliveryway' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'deliverydatetime' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'state' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'memo' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'groupid' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'userid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'access' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
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
             'noid' => '',
             'product' => '',
             'payway' => '',
             'deliveryway' => '',
             'state' => 'new',
             'memo' => '',
             'groupid' => '',
             'userid' => 0,
             'access' => 'public',
             'active' => 'live',
             'add_ip' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function validateMoney()
    {
        return empty($this->money)?false:true;
    }
}
