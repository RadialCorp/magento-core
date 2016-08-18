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

class Radial_Order_Model_Observer
{
    /**
     * enforce dependency types
     *
     * @param Radial_Core_Helper_Data
     * @return array
     */
    protected function checkTypes(Radial_Core_Helper_Data $helper)
    {
        return func_get_args();
    }

    /**
     * get the value of $arr[$key] if it is set; $default otherwise.
     *
     * @param array
     * @param mixed
     * @param mixed
     * @return mixed
     */
    protected function nullCoalesce(array $arr, $key, $default)
    {
        return isset($arr[$key]) ? $arr[$key] : $default;
    }

    /**
     * Copy discount data from Quote Item to Order Item (when quote converts to order)
     *
     * @param  Varien_Event_Observer
     * @return self
     */
    public function handleSalesConvertQuoteItemToOrderItem(Varien_Event_Observer $observer)
    {
        $quote = $observer->getEvent()->getQuote();
        $orderC = Mage::getModel('sales/order')->getCollection()
                                        ->addFieldToFilter('quote_id', array('eq' => $quote->getId()))->getAllIds();

	foreach( $quote->getAllItems() as $quoteItem )
	{
	 	$itemC = Mage::getModel('sales/order_item')->getCollection()
                                ->addFieldToFilter('product_id', array('eq' => $quoteItem->getProductId()))
                                ->addFieldToFilter('order_id', array('in' => $orderC));

		if( $itemC->getSize() > 0 )
		{
			$discountData = $quoteItem->getData('ebayenterprise_order_discount_data');

			if($discountData)
			{
				foreach( $itemC as $item )
				{
					$item->setData('ebayenterprise_order_discount_data', $discountData);
					$item->save();
				}
			}
		}
	}
    }
}
