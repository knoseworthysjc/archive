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
require_once "bootstrap.php";
echo "Test";
try {
    $ed = new \sjcArchive\Models\Manager\Definition("events");
    //$at = new \sjcArchive\Models\Manager\Attribute($ed, "name");
    //var_dump($ed);
    $ed->name = "projects";
    $ed->save();
    echo json_encode($ed);
    //$at->save();
    //echo json_encode($at);
    /*
    $api = new sjcArchive\Router();

    $r = $api->processRoute();
    echo $r;*/
} catch (exception $e) {
    return false;
}
