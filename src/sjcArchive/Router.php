<?php
/**
 * API.PHP
 *
 * For Any Archive Request Start Here
 *
 * PHP version 7
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Application
 * @package    Request
 * @author     Kevin Noseworthy <kevin.noseworthy@stjoseph.com>
 * @copyright  1997-2018 St.Joseph Cormmunication
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */

namespace sjcArchive {
    use \sjcArchive\Modules\Manager as M;
    use \sjcArchive\Modules\Entity as E;    
    /**
     * This is MainClass for All Requests
     * 
     * @category Application
     * @package  Request
     * @author   Kevin Noseworthy <kevin.noseworthy@stjoseph.com>
     * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
     * @link     http://pear.php.net/package/PackageName
     */

    class Router
    {
        public $request;
        protected $requestObject;
        /**
         * Construction function for API CLASS
         */
        public function __construct()
        {
            
            $uri = $_SERVER['REQUEST_URI'];
            
            $request = substr(
                $uri,
                strpos($uri, ARCHIVEAPIURL)+
                strlen(ARCHIVEAPIURL),
                strlen($uri)
            );
            $this->request = $request;
            $requests = explode("/", $request);
            switch($requests['0']){
            case 'manage':
                unset($requests[0]);
                $this->requestObject = new M($request);
                break;
            default:
                $this->requestObject = new E($request);
                break;
            }
        }
        /**
         * Processing Route
         *
         * @return void
         */
        public function processRoute() 
        {
            return $this->requestObject->processAPI();
        }
    }
}
?>