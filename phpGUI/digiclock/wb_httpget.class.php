<?php

/* 
* wb_httpget class - version 0.8
* 
* wb_httpget is a class that should make it more simpler
* to make HTTP connections from PHP.
*
* Copyright (C) 2005 by Jonas John. 
* 
* This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU Lesser General Public
* License as published by the Free Software Foundation; either
* version 2.1 of the License, or (at your option) any later version.
* 
* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
* Lesser General Public License for more details.
* 
* You should have received a copy of the GNU Lesser General Public
* License along with this library; if not, write to the Free Software
* Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
* ----------------------------------------------------------------------
* If you have any suggestions of new features or further questions 
* feel free to contact the author.
*
* Author:   Jonas John, Steinberg (Germany)
* Homepage: http://www.jonasjohn.de/
* Email:    my firstname @ my domainname
* ICQ:      70186045
*
* I would like to thank all the people who made this possible!
* 
*/

class wb_httpget {

    /*
    ** wb_httpget related stuff:
    */

    // wb_httpget version number
    var $version = 0.8;
    
    // true hides error messages, false shows them
    var $silent = false;

    /*
    ** connection settings:
    */

    // default url:
    // example: http://winbinder.jonasjohn.de/.../wb_httpget_v0.X.zip
    var $url     = '';
    
    // default Referer
    // example: http://www.google.com/
    var $referer = '';
    
    // default browser-id:
    // example: Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)
    var $browser = 'wb_httpget/0.8';
    
    // here you can specify the target path of the
    // downloaded file
    // example: downloads/file.zip
    var $target_file = '';
    
    // wb_httpget status (active, error, ...)
    var $status = 'active';

    // download status (init, preparing, downloading, finishing, done, error)
    var $download_status = 'init';
    
    // request timeout
    var $timeout = 30;
    
    // key to stop transfer 
    // default is 27 (-> ESC-Key)
    // NULL => None 
    var $stop_key = 27;
    
    // header ->delimiter<- content
    var $end_of_header = '';
    
    // these variables are filled by wb_httpget
    var $filename = '';
    var $file_ext = '';

    var $file_contents = NULL;
    
    var $url_parsed = array();
    
    var $header_str = '';
    
    // contains the cookies to send
    var $cookies = array();
    
    /*
    ** winbinder settings & handles
    */
    
    var $wb_parent_window = NULL;
    
    var $wb_status_active = false;
    var $wb_status_field = NULL;
    
    var $wb_progressbar_active = false;
    var $wb_progressbar = NULL;

    /*
    ** caching
    */
    
    var $caching = false;
    
    var $cache_path = "";
    
    // hours
    var $cache_timeout = 24;
    
    /*
    ** wb_httpget
    ** the constructor
    */

    function wb_httpget($url='', $target_file=''){
    
        // important - please dont remove
        $this->end_of_header = chr(13).chr(10).chr(13).chr(10);
        
        // set values:
        if ($url != ''){ $this->set_url($url); }
        if ($target_file != ''){ $this->set_target_file($target_file); }

    }
    
    /*
    ** get_url
    ** 
    */

    function get_url(){
    
        return $this->url;

    }
    
    /*
    ** reset_vars
    ** resets the variables
    */
    
    function reset_vars(){
    
        $this->url = '';
        $this->referer = '';
        $this->browser = 'wb_httpget/0.4 (PHP 4.3.10; WB 0.41)';
        $this->target_file = '';
        $this->status = 'active';
        $this->download_status = 'init';
        
        $this->filename = '';
        $this->file_ext = '';
        
        $this->file_contents = NULL;
        
        $this->url_parsed = array();
    
    }
    
    /*
    ** reset_wb_bindings
    ** resets the winbinder bindings
    */
    
    function reset_wb_bindings(){
    
        $this->wb_parent_window = NULL;
        
        $this->wb_status_active = false;
        $this->wb_status_field = NULL;
        
        $this->wb_progressbar_active = false;
        $this->wb_progressbar = NULL;
    
    }
    
    /*
    ** set_url
    ** sets the download url
    */
    
    function set_url($url, $source=''){
    
        if ($source=='wb_text'){
                
            $ctrl = @wb_get_control($this->wb_parent_window, $url);
            
            if ($ctrl == 0){
                $this->_error('set_url','The given control was not found!');
                return false;
            }
            
            $value = wb_get_text($ctrl);
            
            if (!empty($value) and $value != '') { 
                $url = $value;
            }
        }
        
        if (!preg_match('/http:\/\//', $url)){
            $this->_error('set_url', 'Sorry only "http://" urls are supported at the moment');
        }
        else {
            $this->url = $url;
        }
    }
    
    /*
    ** set_ref
    ** sets the Referer
    */
    
    function set_ref($referer, $source=''){
        if ($source == ''){
            $this->referer = $referer;
        }
        else if ($source=='wb_text'){
        
            $ctrl = @wb_get_control($this->wb_parent_window, $referer);
            
            if ($ctrl == 0){
                $this->_error('set_ref','The given control was not found!');
                return false;
            }
            
            $value = wb_get_text($ctrl);

            if (!empty($value) and $value != '') { 
                $this->referer = $value;
            }
        }
    }
    
    /*
    ** set_target_file
    ** sets the target file, where the file is downloaded to
    */
    
    function set_target_file($target_file, $source=''){

        if ($source=='wb_text'){
        
            $ctrl = @wb_get_control($this->wb_parent_window, $target_file);
            
            if ($ctrl == 0){
                $this->_error('set_target_file','The given control was not found!');
                return false;
            }
            
            $value = wb_get_text($ctrl);

            if (!empty($value) and $value != '') { 
                $target_file = $value;
            }
            else {
                $this->_error('set_target_file', 'The given target file is empty!');
            }
        }
        
        $target_file = trim($target_file);
        
        if (empty($target_file) or $target_file == ''){
            $this->_error('set_target_file', 'The given target file is empty!');
        }
        else {
            $this->target_file = $target_file;
        }
    }
    
    /*
    ** set_browser
    ** sets the browser
    */
    
    function set_browser($browser, $source=''){
        if ($source == ''){
            $this->browser = $browser;
        }
        else if ($source=='wb_text'){
        
            $ctrl = @wb_get_control($this->wb_parent_window, $browser);
            
            if ($ctrl == 0){
                $this->_error('set_browser','The given control was not found!');
                return false;
            }
            
            $value = wb_get_text($ctrl);

            if (!empty($value) and $value != '') { 
                $this->browser = $value;
            }
        }
    }
    
    /*
    ** set_status
    ** no desc
    */
    
    function set_status($status){
        $this->status = $status;
    }
    
    
    /**
    * set_timeout
    * no desc
    */
    
    function set_timeout($timeout, $source=''){
    
        if ($source == 'wb_text'){
        
            $ctrl = @wb_get_control($this->wb_parent_window, $timeout);
            
            if ($ctrl == 0){
                $this->_error('set_timeout','The given control was not found!');
                return false;
            }
            
            $value = wb_get_text($ctrl);

            if (!empty($value) and $value != '') { 
                $timeout = $value;
            }
        }
        
        $timeout = intval($timeout);
        
        // default timeout:
        if ($timeout <= 0){
            $this->_error('set_timeout','Timeout value is invalid (must be more than 0)');
            return false;
        }
        else {
            $this->timeout = $timeout;
        }
        
        return true;
    }
    
    /**
    * bind_status
    * no desc
    */
    
    function bind_status($wb_status, $source='id'){
        
        if ($source == 'id'){
            $wb_status = wb_get_control($this->wb_parent_window, $wb_status);
        }
        
        $this->wb_status_active = true;
        $this->wb_status_field = $wb_status;
    }
    
    /*
    ** bind_window
    ** no desc
    */
    
    function bind_window(&$wb_parent_window){
    
        if (!is_numeric($wb_parent_window)){
            $this->_error('wb_httpget','parent window handle is not valid!');
        }
        else {
            // bind parent window:
            $this->wb_parent_window = $wb_parent_window;
        }
    }
    
    /**
    * _update_status
    * no desc
    * @example examples/status.php Example
    * @param string $str
    * @return void
    */
    
    function _update_status($str){
        if ($this->wb_status_active){
            wb_set_text($this->wb_status_field,  $str);
        }
    }
    
    
    /*
    ** bind_progressbar
    ** no desc
    */
    
    function bind_progressbar(&$wb_progressbar){
        $this->wb_progressbar_active = true;
        $this->wb_progressbar = $wb_progressbar;
    }
    
    
    /*
    ** get_content_length
    ** no desc
    */
    
    function get_content_length(){
        
        $size = preg_match('/Content-Length: ([0-9]+)/i', $this->header_str, $m);
        $size = (isset($m[1])) ? intval($m[1]) : 0;
        
        return $size;
        
    }
    
    /**       
    * get_headers       
    *        
    * example of using @return with a class name
    * 
    * @example /path/to/example.php How to use this function
    * @param 
    * @return string    
    */
 
    function get_headers(){
        
        return $this->header_str;
        
    }
    
    /*
    ** get_target_file
    ** no desc
    */
    
    function get_target_file(){
        
        return $this->target_file;
        
    }
    
    /*
    ** get_filename
    ** no desc
    */
    
    function get_filename(){
        
        $this->_parse_filename();
        
        return $this->filename;
        
    }
    
    
    /*
    ** get_ext
    ** returns the extension of the downloaded file
    */
     
    function get_ext(){
        
        $this->_parse_filename();
        
        return $this->file_ext;
        
    }
    
    
    /*
    ** _parse_filename
    ** no desc
    */
    
    function _parse_filename() {

        $r = explode('/', $this->url);
        $l = count($r)-1;
        
        $this->filename = $r[$l];
        $r[$l] = '';
        
        $r = explode('.', $this->filename);
        $l = count($r)-1;
        
        if ($l != 0){ 
            $this->file_ext = $r[$l];
        }
        else {
            $this->file_ext = '';
        }
        
    }
    
    
    /*
    ** error
    ** error handler
    */
    
    function _error($function, $str){
    
        if (!$this->silent){
    
            $errmsg  = 'wb_httpget error in function "'.$function.'":';
            $errmsg .= "\n\n";
            $errmsg .= $str;
        
            if (is_numeric($this->wb_parent_window)){
                wb_message_box($this->wb_parent_window, $errmsg, APPNAME, WBC_INFO);
            }
            else {
                print $errmsg;
            }
        
        }
    
        $this->status = 'error';
    }
    
    
    /*
    ** show_save_dialog
    ** no desc
    */
    
    function show_save_dialog($title){
    
        // get file extension
        $ext = trim($this->get_ext());
        
        // set filter
        $file_filter = array();
        if ($ext != ''){ 
            $file_filter[] = array("$ext file", "*.$ext");
        }
        $file_filter[] = array('All files', '*.*');

        // get filename
        $filename = $this->get_filename();

        // show save dialog
        $filepath = wb_sys_dlg_save($this->wb_parent_window, $title, $file_filter, '', $filename);
        
        if (!empty($filepath) and $filepath!=''){
        
            // set the path of the new file
            $this->set_target_file($filepath);
            
            return true;
        }
        else {
            return false;
        }
                            
    }
    
    /*
    ** _parse_url
    ** no desc
    */
    
    function _parse_url(){
    
        if (!is_array($this->url_parsed) or count($this->url_parsed)==0){
            $this->url_parsed = parse_url($this->url);
        }
    
    }
    
    /*
    ** _check_url
    ** no desc
    */
    
    function _check_url(){
    
        if (empty($this->url) or $this->url==''){ 
            $this->_error('_check_url','URL is empty!');
            return false;
        }
        else if (!preg_match("/^http:\/\//i", $this->url)){
            $this->_error('_check_url','URL is invalid (it does not start with "http://")');
            return false;
        }
        return true;
        
    }
    
    /*
    ** get_host
    ** no desc
    */
    
    function get_host(){
    
        $host = "";
    
        if ($this->_check_url()){
        
            $this->_parse_url();
            
            $host = (isset($this->url_parsed['host'])) ? $this->url_parsed['host'] : '';
            if (empty($host) or $host == ""){ 
                $this->_error('get_host','The hostname is empty!');
            }
        
        }
        
        return $host;
        
    }
    
    /*
    ** get_port
    ** returns the port
    */
    
    function get_port(){
    
        $port = "";
    
        if ($this->_check_url()){
        
            $this->_parse_url();
            
            $port = (isset($this->url_parsed['port'])) ? intval($this->url_parsed['port']) : 80;
            $port = ($port==0) ? 80 : $port;
            
        }
        
        return $port;
        
    }
    
    /*
    ** get_path
    ** no desc
    */
    
    function get_path(){
    
        $path = "";
    
        if ($this->_check_url()){
        
            $this->_parse_url();
            
            $path = (isset($this->url_parsed['path'])) ? $this->url_parsed['path'] : '';
            
            // append a ending slash if path is empty
            $path = (empty($path) or $path=='') ? '/' : $path;
            
        }
        
        return $path;
        
    }
    
    /*
    ** get_query
    ** no desc
    */
    
    function get_query(){
    
        $query = "";
    
        if ($this->_check_url()){
        
            $this->_parse_url();
            
            // add query string
            if (isset($this->url_parsed['query'])){
               $query = $this->url_parsed['query'];
            }
            
        }
        
        return $query;
        
    }
    
    /*
    ** set_cookie
    ** adds a cookie
    */
    
    function set_cookie($name, $value){
        $this->cookies[$name] = $value;
    }
    
    /*
    ** get_cookie
    ** returns a cookie
    */
    
    function get_cookie($name){
        return (isset($this->cookies[$name])) ? $this->cookies[$name] : '';
    }
    
    /*
    ** delete_cookie
    ** deletes a cookie
    */
    
    function delete_cookie($name){
        if (isset($this->cookies[$name])) {
            unset($this->cookies[$name]);
        }
    }
    
    /*
    ** get_http_request
    ** returns the http header
    */
    
    function get_http_request(){
    
        /**
        *** parsing url ... 
        **/
                
        $host = $this->get_host();
        $port = $this->get_port();
        $path = $this->get_path();
        $query = $this->get_query();

        // append query to the path if exists
        if ($query != ''){
            $path = $path.'?'.$query;
        }
    
        // build cookie array
        $cookies = array();
        reset($this->cookies);
        while(list($cookie_name, $val) = each($this->cookies)){
            $cookies[] = $cookie_name.'='.$val;
        }
    
        // building request
        $http_request = "GET $path HTTP/1.0\r\n";
        $http_request .= "Host: $host\r\n";
        $http_request .= 'User-Agent: '.$this->browser."\r\n";
        
        // if a referer is given, add it:
        if ($this->referer!='') {
            $http_request .= 'Referer: '.$this->referer."\r\n";
        }
        
        // if there are cookies, append them:
        if (count($cookies) != 0){
            $http_request .= 'Cookie: ' . implode('; ', $cookies) . "\r\n";
        }
        
        $http_request .= "\r\n";
        
        return $http_request;
    }
    
    /*
    ** download_file
    ** downloads a url to a file
    */
    
    function download_file($save_to_var=false){
    
        $this->_update_download_status('connecting');
    
        // did a error happen? then stop the process!
        if ($this->status == 'error'){ return false; }
    
        // build request:
        $http_request = $this->get_http_request();
        
        $host = $this->get_host();
        $port = $this->get_port();

        // did a error happen? then stop the process!
        if ($this->status == 'error'){ return false; }
        
        // open connection:
        $errno = 0;
        $errstr = "";
        
        $connection = @fsockopen($host, $port, $errno, $errstr, 1);
        
        if (!$connection){
            $this->_error('download_file', "connection failed: $errstr (#$errno)");
            return false;
        }
        
        // send http header:
        if (!fwrite($connection, $http_request)){
            $this->_error('download_file', 'could not send the http header!');
            return false;
        }
    
        // did a error happen? then stop the process!
        if ($this->status == 'error'){ return false; }
        
        if (!$save_to_var){
        
            // save content to this file:
            if (!$dll_file_handle = fopen($this->target_file, 'wb')){
                $this->_error('download_file', 'could not write to file!');
                return false;
            }
        
        }
        
        // needed variables:
        $content_size = 0;     
        $current_size = 0;     
        $reached_content = 0; 
        $header = '';
        $buffer = '';
        $percent = 0;
        
        // set progressbar range to 100
        if ($this->wb_progressbar_active){
            wb_set_range($this->wb_progressbar, 0, 100);
        }

        $this->_update_download_status('getting_header');

        while (!feof($connection) and $this->status != 'error') {
            
            if ($reached_content == 1){
                        
                //
                // getting data
                //
            
                // fill buffer
                $buffer = fgets($connection, 1024);
                
                // append buffer to file or variable
                if ($save_to_var){ $this->file_contents .= $buffer; }
                else { fwrite($dll_file_handle, $buffer); }
                
                // update cur size
                $current_size += strlen($buffer);
           
                // did the user hit ESC?
                if($this->stop_key != NULL and wb_wait() == $this->stop_key) {
                    // then break
                    break;
                }
                
                if ($content_size != 0){
                
                    $percent = round((100/$content_size)*$current_size);
                    
                    if ($this->wb_progressbar_active){
                        wb_set_value($this->wb_progressbar, $percent);
                    }
                }
                
            }
            else {
                
                // get header
                $buffer = fgets($connection, 2);
                $header .= $buffer;
                
                // end of header?
                if (strstr($header, $this->end_of_header)){ 
                
                    $this->_update_download_status('downloading');

                    // save header
                    $this->header_str = $header;

                    // extract content size from header
                    $content_size = $this->get_content_length();
                
                    // update vars
                    $reached_content = 1; 
                    $buffer = '';
                }
                
            }
    
            
        }
        
        // close download file
        if (!$save_to_var){ fclose($dll_file_handle); }
        
        // close connection
        if (!@fclose($connection)){
            $this->_error('download_file', 'could not close the connection!');
        }
        
        $this->_update_download_status('finished');

        return true;
        
    }

    
    
    /*
    ** get_file
    ** returns the downloaded file as string
    */
    
    function get_file(&$content){
    
        // init variable 
        $this->file_contents = "";
        
        // download file 
        
        // cache:
        if ($this->cache() and $this->is_cached()){
        
            $content = $this->get_cached_content();
            return true;
            
        }
        else {
        
            $status = $this->download_file(true);
        
        }
    
        // update content:
        $content = $this->file_contents;
        
        // cache:
        if ($this->cache() and $status == true){
            $this->cache_content();
        }
        
        // empty the variable
        $this->file_contents = NULL;
        
        return $status;
    }
    
    
    /*
    ** _update_download_status
    ** no desc
    */
    
    function _update_download_status($str){
    
        $this->_update_status($str);

        $this->download_status = $str;
        
    }

    
    /*
    ** get_download_status
    ** no desc
    */
    
    function get_download_status(){
    
        return $this->download_status;
        
    }
    
    /*
    ** is_downloading
    ** no desc
    */
    
    function is_downloading(){
    
        return ($this->download_status == 'downloading') ? true : false;
    
    }
    
    /*
    ** cache
    ** just testing...
    */
    
    function cache($flag=NULL){
    
        if ($flag == NULL){ return $this->caching; }
        
        $this->caching = ($flag) ? true : false;

    }
    
    function cache_path($path){
    
        if (is_dir($path) and !is_file($path)){
            $this->cache_path = $path;
        }
        else { 
            $this->_error('cache_path', 'The given cache path is not a directory!');
        }
    
    }
    
    function is_cached(){
    
        $temp_file_name = $this->cache_path . "cache_" . md5($this->get_url()) . "_" . date("ymd") . ".txt";

        if (file_exists($temp_file_name)){
        
            return true;
        
        }
    
        return false;
    
    }
    
    
    function get_cached_content(){
    
        $temp_file_name = $this->cache_path . "cache_" . md5($this->get_url()) . "_" . date("ymd") . ".txt";
    
        return load_file($temp_file_name);
    
    }
    
    function cache_content(){
    
        $temp_file_name = $this->cache_path . "cache_" . md5($this->get_url()) . "_" . date("ymd") . ".txt";
    
        if ($fp = fopen($temp_file_name, "w+")){
            fwrite($fp, $this->file_contents);
            fclose($fp);
            return true;
        }
        else {
            return false; 
        }
        
    }
    
    // eoc
    
}

