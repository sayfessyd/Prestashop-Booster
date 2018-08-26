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

$total_checked = $_REQUEST['total_checked'];
$is_ajax = $_REQUEST['is_ajax'];
$table = $_REQUEST['table'];

if (isset($is_ajax) && $is_ajax  && $total_checked > 0) {
    switch ($table) {
        case 'ps_cart':
        // clean cart_product table
            $sql = 'SELECT id_cart FROM `'._DB_PREFIX_.'cart` WHERE `id_customer`= 0';
            if ($results = Db::getInstance()->ExecuteS($sql)) {
                foreach ($results as $key => $value) {
                    $execute = Db::getInstance()->Execute('DELETE FROM `'._DB_PREFIX_
                    .'cart_product` WHERE `id_cart`='.$value['id_cart']);
                    if ($execute == false) {
                        return $execute;
                    }
                }
            }
        // clean cart table
            $sql = _DB_PREFIX_.'cart` WHERE `id_customer` = 0';
            $execute = Db::getInstance()->Execute('DELETE FROM `'.$sql);
            test($execute, $sql);
            break;
        // clean specific_price table
        case 'ps_specific_price':
            $currentDate = date('Y-m-d H:i:s');
            $sql = _DB_PREFIX_.'specific_price` WHERE `to` < "'.$currentDate.'" AND `to` != "0000-00-00 00:00:00"';
            $execute = Db::getInstance()->Execute('DELETE FROM `'.$sql);
            test($execute, $sql);
            break;
        // clean page_viewed and date_range table
        case 'ps_page_viewed':
            $sql = _DB_PREFIX_.'page_viewed`';
            $execute = Db::getInstance()->Execute('TRUNCATE TABLE `'.$sql)
             && Db::getInstance()->Execute('TRUNCATE TABLE `'._DB_PREFIX_.'date_range`');
            test($execute, $sql);
            break;
        // truncate table of choice
        default:
            $table = Tools::substr($table, 3);
            $sql = _DB_PREFIX_.$table.'`';
            $execute = Db::getInstance()->Execute('TRUNCATE TABLE `'.$sql);
            test($execute, $sql);
            break;
    }
}

function test($execute, $sql)
{
    $fail = 'failed';
    $success = 'perfect';
    if ($execute == false) {
        $data = array('state'=>$fail);
        echo Tools::jsonEncode($data);
    } else {
        $records = 'SELECT COUNT(*) as total FROM `'.$sql;
        $records = Db::getInstance()->getRow($records);
        $data = array('state'=>$success, 'record'=>$records['total']);
        echo Tools::jsonEncode($data);
    }
}
