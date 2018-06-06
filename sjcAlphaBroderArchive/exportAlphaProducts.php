<?php

/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   CategoryName
 * @package    PackageName
 * @author     Original Author <author@example.com>
 * @author     Another Author <another@example.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */
header('Content-type: Text/HTML; Charset=UTF-8');
ini_set('memory_limit', '512M');
ini_set('default_charset', 'utf-8');
ini_set('max_execution_time', 0);

try {
    $prod = new MySqli(
        "sjcthearchive.cb1qb4plxjpf.us-east-1.rds.amazonaws.com", 
        "SJCarchiveAdmin", '5jcAdmin!', 'alphabrodermaster', '3306' 
    );
    $dev = new MySqli(
        "sjc-archive-prod.cluster-cpi3jpipzm32.us-east-1.rds.amazonaws.com", 
        "sjcArchiveAdmin", "5jcAdmin!", "sjcAlphaBroderArchive", '3306'
    );
    $prod->set_charset("utf8mb4");
    $dev->set_charset("utf8mb4");
    $prod->query("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
    $dev->query("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");

    $styleSql = "select * from `abstyles`";
    $colorSql = "select * from `abcolors`";

    $sqry = $prod->query($styleSql);
    $cqry = $prod->query($colorSql);

    while( $s = $sqry->fetch_assoc() ){
        echo JSON_ENCODE($s);
    }
    while( $c = $cqry->fetch_assoc() ){
        
        echo JSON_ENCODE($c);
    
    }

}
catch(exception $e){
    print_r($e);
}
 
?>