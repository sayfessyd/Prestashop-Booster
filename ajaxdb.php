<?php
/**
* @author    SpecialDev
* @copyright SpecialDev 2017
* @license  SpecialDev
* @version 1.0
* @category administration
*/

require_once(dirname(__FILE__).'../../../config/config.inc.php');
require_once(dirname(__FILE__).'../../../init.php');

$is_ajax = $_REQUEST['is_ajax_'];
if (isset($is_ajax) && $is_ajax) {
    $size_db = 0;
    $sql_size_db = "SHOW TABLE STATUS";
    if ($results = Db::getInstance()->ExecuteS($sql_size_db)) {
        foreach ($results as $key) {
            $size_db = $size_db + $key["Data_length"] + $key["Index_length"];
        }
        $size_db = number_format($size_db / 1024 / 1024, 2).'Mb';
        $data = array('final_db_size'=>$size_db);
        echo Tools::jsonEncode($data);
    }
}
