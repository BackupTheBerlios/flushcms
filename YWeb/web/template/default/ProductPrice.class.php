<?php

/**
 *
 * ProductPrice.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: ProductPrice.class.php,v 1.1 2006/10/29 09:21:13 arzen Exp $
 */
class ProductPrice
{

	function doEditProductPrice () 
	{
		global $CurrencyFormat;
		
		require_once 'I18N/Currency.php';
		
		$args = func_get_args();
		$price = $args[0];
		$product_id = $args[1];
		$company_id = $args[2];
		
		$apf_product_price = DB_DataObject :: factory('ApfProductPrice');
		
		$apf_product_price->setCompanyId($company_id);
		$apf_product_price->setProductId($product_id);
		$apf_product_price->setPrice($price);
		$apf_product_price->setCreatedAt(DB_DataObject_Cast::dateTime());
		$apf_product_price->insert();
		
		$currency = new I18N_Currency($CurrencyFormat);

		return "<div ondblclick=\"editPrice('".$product_id."','".$company_id."','".$price."')\" >".$currency->format($price)."</div>";
		
	}


}
?>