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
 * @version    SVN: Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */ 
namespace sjcArchive\EntityManager{
    use \RedBeanPHP\R as R;
    use Repositories as Repo;
     /**
      * Base class for EntityManage requests
      * 
      * @category Application
      * @package  API
      * @author   Kevin Noseworthy <kevin.noseworthy@stjoseph.com>
      * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
      * @link     http://url.com
      */ 
    class Parents extends Repo\EntityManagement implements Contracts\Control 
    {
        
        public $ed;
        
        /**
         * Undocumented function
         */
        public function __construct()
        {
            R::selectDatabase('datadb');
        }
        /**
         * Create
         *
         * @param array $rawdata json records of entitytypes
         * 
         * @return void
         */
        public function create(array $rawdata) 
        {            
            $name = $this->ed['name'];
            $parent = $rawdata['name'];
            
            R::selectDatabase('datadb');
            R::begin();
            try{
                $this->addField(
                    $name, 
                    $parent."_id", 
                    'INT(11) UNSIGNED NOT NULL AFTER'
                );
                $this->addIndex(
                    $name, 
                    "idx_$name"."_".$parent, 
                    "INDEX",
                    "`$parent"."_id` asc" 
                );
                $this->addForeignKey(
                    $name,
                    "fk_$name"."_".$parent, 
                    $parent."_id", 
                    $parent,
                    'id'
                );
                R::commit();
            }
            catch(Exception $e){
                R::rollback();
            }
            
        }
        /**
         * Read
         *
         * @param string $name archive entity type
         * 
         * @return void
         */
        public function read(string $name=null) 
        {  
           
        }
        /**
         * Undocumented function
         *
         * @param array $rawdata a array of attributes about entitytypes
         * 
         * @return void
         */
        public function update(array $rawdata)
        {

        }
        /**
         * Delete Functions
         * 
         * @param array $rawdata objects to delete and update
         * 
         * @return void
         */
        public function delete(array $rawdata) 
        {
            
        }
      
    }   
}
?>