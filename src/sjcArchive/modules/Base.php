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
 * @copyright  1997-2018 St.Joseph Communication
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */

namespace sjcArchive\Modules
{
    /**
     * Abstract base class for API requests
     * 
     * @category Application
     * @package  API
     * @author   Kevin Noseworthy <kevin.noseworthy@stjoseph.com>
     * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
     * @link     http://url.com
     */
    abstract class Base
    {
        /**
         * Property: method
         * The HTTP method this request was made in, 
         * either GET, POST, PUT, PATCH or DELETE
         */
        protected $method = '';
        /**
         * Property: endpoint
         * The Model requested in the URI. eg: /files
         */
        protected $endpoint = '';
        /**
         * Property: verb
         * An optional additional descriptor about the endpoint, 
         * used for things that can
         * not be handled by the basic methods. eg: /files/process
         */
        protected $verb = '';
        /**
         * Property: args
         * Any additional URI components after the endpoint 
         * and verb have been removed, in our
         * case, an integer ID for the resource. eg: /<endpoint>/<verb>/<arg0>/<arg1>
         * or /<endpoint>/<arg0>
         */
        protected $args = array();
        /**
         * Property: file
         * Stores the input of the PUT request
         */
        protected $file = null;
        /**
         * Undocumented function
         *
         * @param [string] $request url parameters seperated after 
         *                          "API" into slashed values and 
         *                          get get query params
         */
        public function __construct(string $request)
        {
            header("Access-Control-Allow-Orgin: *");
            header("Access-Control-Allow-Methods: *");
            header("Content-Type: application/json");

            $this->args = explode('/', rtrim($request, '/'));
            $this->endpoint = array_shift($this->args);
            if (array_key_exists(0, $this->args) && !is_numeric($this->args[0])) {
                $this->verb = array_shift($this->args);
            }

            $this->method = $_SERVER['REQUEST_METHOD'];
            if ($this->method == 'POST' 
                && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER) 
            ) {
                if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                    $this->method = 'DELETE';
                } elseif ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                    $this->method = 'PUT';
                } else {
                    throw new Exception("Unexpected Header");
                }
            }

            switch ($this->method) {
            case 'DELETE':
            case 'POST':
                $this->request = $this->_cleanInputs($_POST);
                break;
            case 'GET':
                $this->request = $this->_cleanInputs($_GET);
                break;
            case 'PUT':
                $this->request = $this->_cleanInputs($_GET);
                $this->file = file_get_contents("php://input");
                break;
            default:
                $this->_response('Invalid Method', 405);
                break;
            }
        }
        /**
         * Undocumented function
         *
         * @return void
         */
        public function processAPI()
        {
            if (method_exists($this, $this->endpoint)) {
                return $this->_response($this->{$this->endpoint}($this->args));
            }
            return $this->_response(["No Endpoint"=>$this->endpoint], 404);
        }
        /**
         * _Response Process the requested responses
         *
         * @param [array] $data   current response data turn
         * @param integer $status status code for the response
         * 
         * @return array resulting array from the responses
         */
        private function _response(array $data, $status = 200)
        {
            header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
            return json_encode($data);
        }
        /**
         * CleanInputs Returns the filtered version of url 
         * encoded data removing html tags etc
         *
         * @param [type] $data cleans up the input values and removes html tags etc
         * 
         * @return string 
         */
        private function _cleanInputs($data)
        {
            $clean_input = array();
            if (is_array($data)) {
                foreach ($data as $k => $v) {
                    $clean_input[$k] = $this->_cleanInputs($v);
                }
            } else {
                $clean_input = trim(strip_tags($data));
            }
            return $clean_input;
        }
        /**
         * Undocumented function
         *
         * @param [type] $code response for each of the codes
         * 
         * @return void
         */
        private function _requestStatus($code) 
        {
            $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error');

            return ($status[$code])?$status[$code]:$status[500];
        }
    }
}

?>