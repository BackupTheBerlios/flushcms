<?php
/**
 * Table Definition for apf_company_product
 */
class DaoApfCompanyProduct extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_company_product';             // table name
    var $id;                              // int(11)  not_null primary_key auto_increment
    var $company_id;                      // int(11)  multiple_key
    var $product_id;                      // int(11)  multiple_key

    /* ZE2 compatibility trick*/
    function __clone() { return $this;}

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoApfCompanyProduct',$k,$v);
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


    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'company_id' =>  DB_DATAOBJECT_INT,
             'product_id' =>  DB_DATAOBJECT_INT,
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

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    function buildProductJoin () 
	{
		$this->_join .= " LEFT JOIN apf_product ON apf_product.id=".$this->__table.".product_id ";
	}
}
