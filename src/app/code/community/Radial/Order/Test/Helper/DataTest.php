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

class Radial_Order_Test_Helper_DataTest extends Radial_Core_Test_Base
{
    const API_CLASS = '\eBayEnterprise\RetailOrderManagement\Api\HttpApi';

        /**
     * Test removing the order increment id prefix.
     */
    public function testRemoveOrderIncrementPrefix()
    {
        $admin = Mage::getModel('core/store', ['store_id' => 0]);
        $default = Mage::getModel('core/store', ['store_id' => 1]);

        $adminConfig = $this->buildCoreConfigRegistry(['clientOrderIdPrefix' => '555']);
        $storeConfig = $this->buildCoreConfigRegistry(['clientOrderIdPrefix' => '7777']);
        $coreHelper = $this->getHelperMock('radial_core/data', ['getConfigModel']);
        $coreHelper->expects($this->any())
            ->method('getConfigModel')
            ->will($this->returnValueMap([
                [0, $adminConfig],
                [1, $storeConfig],
            ]));
        $this->replaceByMock('helper', 'radial_core', $coreHelper);
        /** @var Radial_Order_Helper_Data */
        $helper = $this->getHelperMock('radial_order/data', ['_getAllStores']);
        $helper->expects($this->any())
            ->method('_getAllStores')
            ->will($this->returnValue([$admin, $default]));

        // should be able to replace the order id prefix from any config scope
        $this->assertSame('8888888', $helper->removeOrderIncrementPrefix('77778888888'));
        $this->assertSame('8888888', $helper->removeOrderIncrementPrefix('5558888888'));
        // when no matching prefix on the original increment id, should return unmodified value
        $this->assertSame('1238888888', $helper->removeOrderIncrementPrefix('1238888888'));
        // must work with null as when the first increment id for a store is
        // created, the "last id" will be given as null
        $this->assertSame('', $helper->removeOrderIncrementPrefix(null));
    }
}
