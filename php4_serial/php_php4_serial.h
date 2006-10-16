/*
   +----------------------------------------------------------------------+
   | unknown license:                                                      |
   +----------------------------------------------------------------------+
   +----------------------------------------------------------------------+
*/

/* $ Id: $ */ 

#ifndef PHP_PHP4_SERIAL_H
#define PHP_PHP4_SERIAL_H


#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include <php.h>

#ifdef HAVE_PHP4_SERIAL

#include <php_ini.h>
#include <SAPI.h>
#include <ext/standard/info.h>


extern zend_module_entry php4_serial_module_entry;
#define phpext_php4_serial_ptr &php4_serial_module_entry

#ifdef PHP_WIN32
#define PHP_PHP4_SERIAL_API __declspec(dllexport)
#else
#define PHP_PHP4_SERIAL_API
#endif

PHP_MINIT_FUNCTION(php4_serial);
PHP_MSHUTDOWN_FUNCTION(php4_serial);
PHP_RINIT_FUNCTION(php4_serial);
PHP_RSHUTDOWN_FUNCTION(php4_serial);
PHP_MINFO_FUNCTION(php4_serial);

#ifdef ZTS
#include "TSRM.h"
#endif



#endif /* PHP_HAVE_PHP4_SERIAL */

#endif /* PHP_PHP4_SERIAL_H */


/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
