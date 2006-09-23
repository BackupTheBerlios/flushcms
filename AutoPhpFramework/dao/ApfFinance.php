<?php
/**
 * Table Definition for apf_finance
 */
class DaoApfFinance extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_finance';                     // table name
    var $id;                              // int(11)  not_null primary_key auto_increment
    var $category;                        // int(5)  
    var $create_date;                     // date(10)  
    var $amount;                          // int(4)  
    var $debit;                           // int(2)  
    var $money;                           // real(12)  
    var $memo;                            // blob(65535)  blob
    var $active;                          // string(8)  not_null
    var $add_ip;                          // string(24)  
    var $created_at;                      // datetime(19)  not_null
    var $update_at;                       // datetime(19)  not_null

    /* ZE2 compatibility trick*/
    function __clone() { return $this;}

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoApfFinance',$k,$v);
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
    * Getter for $CreateDate
    *
    * @return   date
    * @access   public
    */
    function getCreateDate() 
    {
        return $this->create_date;
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
    * Getter for $Debit
    *
    * @return   int
    * @access   public
    */
    function getDebit() 
    {
        return $this->debit;
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
    * Setter for $CreateDate
    *
    * @param    mixed   input value
    * @access   public
    */
    function setCreateDate($value) 
    {
        $this->create_date = $value;
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
    * Setter for $Debit
    *
    * @param    mixed   input value
    * @access   public
    */
    function setDebit($value) 
    {
        $this->debit = $value;
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
             'category' =>  DB_DATAOBJECT_INT,
             'create_date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE,
             'amount' =>  DB_DATAOBJECT_INT,
             'debit' =>  DB_DATAOBJECT_INT,
             'money' =>  DB_DATAOBJECT_INT,
             'memo' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
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
             'memo' => '',
             'active' => 'new',
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
