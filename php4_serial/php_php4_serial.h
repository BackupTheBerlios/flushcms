/*
   +----------------------------------------------------------------------+
   | PHP Version 4                                                        |
   +----------------------------------------------------------------------+
   | Copyright (c) 1997-2006 The PHP Group                                |
   +----------------------------------------------------------------------+
   | This source file is subject to version 3.01 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | http://www.php.net/license/3_01.txt                                  |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
   | Author: John Meng <arzen1013@gmail.com>                               |
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
