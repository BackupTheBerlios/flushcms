/*
   +----------------------------------------------------------------------+
   | unknown license:                                                      |
   +----------------------------------------------------------------------+
   +----------------------------------------------------------------------+
*/

/* $ Id: $ */ 

#include "php_php4_serial.h"

#if HAVE_PHP4_SERIAL

/* {{{ php4_serial_functions[] */
function_entry php4_serial_functions[] = {
	{ NULL, NULL, NULL }
};
/* }}} */


/* {{{ php4_serial_module_entry
 */
zend_module_entry php4_serial_module_entry = {
	STANDARD_MODULE_HEADER,
	"php4_serial",
	php4_serial_functions,
	PHP_MINIT(php4_serial),     /* Replace with NULL if there is nothing to do at php startup   */ 
	PHP_MSHUTDOWN(php4_serial), /* Replace with NULL if there is nothing to do at php shutdown  */
	PHP_RINIT(php4_serial),         /* Replace with NULL if there is nothing to do at request start */
	PHP_RSHUTDOWN(php4_serial),   /* Replace with NULL if there is nothing to do at request end   */
	PHP_MINFO(php4_serial),
	"0.0.7", 
	STANDARD_MODULE_PROPERTIES
};
/* }}} */

#ifdef COMPILE_DL_PHP4_SERIAL
ZEND_GET_MODULE(php4_serial)
#endif


/* {{{ globals and ini entries */
/* }}} */


/* {{{ PHP_MINIT_FUNCTION */
PHP_MINIT_FUNCTION(php4_serial)
{

	/* add your stuff here */

	return SUCCESS;
}
/* }}} */


/* {{{ PHP_MSHUTDOWN_FUNCTION */
PHP_MSHUTDOWN_FUNCTION(php4_serial)
{

	/* add your stuff here */

  
	return SUCCESS;
}
/* }}} */


/* {{{ PHP_RINIT_FUNCTION */
PHP_RINIT_FUNCTION(php4_serial)
{
	/* add your stuff here */

	return SUCCESS;
}
/* }}} */


/* {{{ PHP_RSHUTDOWN_FUNCTION */
PHP_RSHUTDOWN_FUNCTION(php4_serial)
{
	/* add your stuff here */

	return SUCCESS;
}
/* }}} */


/* {{{ PHP_MINFO_FUNCTION */
PHP_MINFO_FUNCTION(php4_serial)
{
	//php_info_print_box_start(0);
	//php_printf("<p>The unknown extension</p>\n");
	//php_printf("<p>Version 0.0.7unknown (2006-10-16)</p>\n");
	//php_info_print_box_end();

	php_info_print_table_start();
	php_info_print_table_row(2, "PHP4 Serial Support", "enabled");
	php_info_print_table_end();
	/* add your stuff here */

}
/* }}} */

#endif /* HAVE_PHP4_SERIAL */


/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
