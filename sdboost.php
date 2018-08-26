<?php
/**
* @author    SpecialDev
* @copyright SpecialDev 2017
* @license  SpecialDev
* @version 1.0
* @category administration
*/

if (!defined('_PS_VERSION_')) {
    exit;
}
 
class SdBoost extends Module
{
    public function __construct()
    {
        $this->name = 'sdboost';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'SpecialDev';
        $this->module_key = "";
        $this->need_instance = 0;
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('PrestaShop Booster');
        $this->description = $this->l('Turn your website much faster by deleting worthless data.');
        $this->confirmUninstall = $this->l('Warning: Are you sure you want uninstall this module?');
    }
 
    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }
        if (!parent::install() || !$this->registerHook('backOfficeHeader')) {
            return false;
        }
        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall()) {
            return false;
        }
        return true;
    }
      
    public function getContent()
    {
        $version = Tools::substr(_PS_VERSION_, 0, 3);
        $db_name = _DB_NAME_;
        $size_db = 0;
        $sql_size_db = "SHOW TABLE STATUS";
        if ($results = Db::getInstance()->ExecuteS($sql_size_db)) {
            foreach ($results as $key) {
                $size_db = $size_db + $key["Data_length"] + $key["Index_length"];
            }
            $total_size = number_format($size_db / 1024 / 1024, 2).'Mb';
            $this->context->smarty->assign('size_db', $total_size);
        }

        $sql_cart = 'SELECT COUNT(*) as total FROM `'._DB_PREFIX_.'cart` WHERE `id_customer` = 0';
        $sql_cart = Db::getInstance()->getRow($sql_cart);
        
        $sql_cart_product = 'SELECT COUNT(cp.id_cart) as total FROM `'._DB_PREFIX_.'cart_product` cp LEFT JOIN `'
        ._DB_PREFIX_.'cart` c ON cp.id_cart = c.id_cart WHERE c.id_customer = 0';
        $sql_cart_product = db::getInstance()->getRow($sql_cart_product);

        $currentDate = date('Y-m-d H:i:s');
        $sql_specific_price = 'SELECT COUNT(*) as total FROM `'._DB_PREFIX_.'specific_price` WHERE `to` < "'
        .$currentDate.'" AND `to` != "0000-00-00 00:00:00"';
        $sql_specific_price = Db::getInstance()->getRow($sql_specific_price);

        $sql_page_viewed = 'SELECT COUNT(*) as total FROM `'._DB_PREFIX_.'page_viewed`';
        $sql_page_viewed = Db::getInstance()->getRow($sql_page_viewed);

        $sql_date_range = 'SELECT COUNT(*) as total FROM `'._DB_PREFIX_.'date_range`';
        $sql_date_range = Db::getInstance()->getRow($sql_date_range);

        $sql_pagenotfound = 'SELECT COUNT(*) as total FROM `'._DB_PREFIX_.'pagenotfound`';
        $sql_pagenotfound = Db::getInstance()->getRow($sql_pagenotfound);
        
        $sql_connections = 'SELECT COUNT(*) as total FROM `'._DB_PREFIX_.'connections`';
        $sql_connections = Db::getInstance()->getRow($sql_connections);

        $sql_connections_source = 'SELECT COUNT(*) as total FROM `'._DB_PREFIX_.'connections_source`';
        $sql_connections_source = Db::getInstance()->getRow($sql_connections_source);

        $sql_connections_page = 'SELECT COUNT(*) as total FROM `'._DB_PREFIX_.'connections_page`';
        $sql_connections_page = Db::getInstance()->getRow($sql_connections_page);

        $sql_guest = 'SELECT COUNT(*) as total FROM `'._DB_PREFIX_.'guest`';
        $sql_guest = Db::getInstance()->getRow($sql_guest);

        $this->context->smarty->assign(array(
          'sql_connections_source'    => $sql_connections_source['total'],
          'sql_connections_page'      => $sql_connections_page['total'],
          'sql_cart'    => $sql_cart['total'] + $sql_cart_product['total'],
          'sql_connections'       => $sql_connections['total'],
          'sql_guest'    => $sql_guest['total'],
          'sql_page_viewed' => $sql_page_viewed['total'] + $sql_date_range['total'],
          'sql_specific_price'  => $sql_specific_price['total'],
          'sql_pagenotfound' => $sql_pagenotfound['total'],
          'ps_version'  => $version,
          'db_name' => $db_name,
        ));

        $this->context->controller->addCSS($this->_path.'views/css/sdboost.css', 'all');
        $this->context->controller->addJS($this->_path.'views/js/sdboost.js');
        return $this->display(__FILE__, 'views/templates/admin/sdboost.tpl');
    }
}
