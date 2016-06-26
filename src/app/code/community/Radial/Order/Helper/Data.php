<?php
/**
 * Copyright (c) 2013-2014 eBay Enterprise, Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @copyright   Copyright (c) 2013-2014 eBay Enterprise, Inc. (http://www.ebayenterprise.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Radial_Order_Helper_Data extends Mage_Core_Helper_Abstract implements Radial_Core_Helper_Interface
{
    /** @var Radial_Core_Helper_Data */
    protected $_coreHelper;
    /** @var Radial_Order_Helper_Factory */
    protected $_factory;

    public function __construct()
    {
        $this->_coreHelper = Mage::helper('radial_core');
    }

    /**
     * Gets a combined configuration model from core and order
     * @see Radial_Core_Helper_Interface::getConfigModel
     * @param mixed $store
     * @return Radial_Core_Model_Config_Registry
     */
    public function getConfigModel($store = null)
    {
        return Mage::getModel('radial_core/config_registry')
            ->setStore($store)
            ->addConfigModel(Mage::getSingleton('radial_order/config'));
    }

    /**
     * Remove a client order id prefix from the increment id. As the prefix on the
     * increment id may have been any of the configured order id prefixes, need
     * to check through all possible prefixes configured to find the one to remove.
     * @param  string
     * @return string
     */
    public function removeOrderIncrementPrefix($incrementId)
    {
        $stores = $this->_getAllStores();
        foreach ($stores as $store) {
            $prefix = $this->_coreHelper->getConfigModel($store->getId())->clientOrderIdPrefix;
            // if the configured prefix matches the start of the increment id, strip
            // off the prefix from the increment
            if (strpos($incrementId, $prefix) === 0) {
                return substr($incrementId, strlen($prefix));
            }
        }
        // must return a string
        return (string) $incrementId;
    }

    /**
     * Get all stores
     *
     * @return array
     */
    protected function _getAllStores()
    {
        return Mage::app()->getStores(true);
    }

    /**
     * Get a singleton adminhtml/session_quote object.
     *
     * @return Mage_Adminhtml_Model_Session_Quote
     */
    public function getAdminQuoteSessionModel()
    {
        return Mage::getSingleton('adminhtml/session_quote');
    }
}
