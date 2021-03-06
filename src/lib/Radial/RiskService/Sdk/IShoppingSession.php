<?php
/**
 * Copyright (c) 2015 Radial, Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Radial
 * Magento Extensions End User License Agreement
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * http://www.radial.com/files/pdf/Magento_Connect_Extensions_EULA_050714.pdf
 *
 * @copyright   Copyright (c) 2015 Radial, Inc. (http://www.radial.com/)
 * @license     http://www.radial.com/files/pdf/Magento_Connect_Extensions_EULA_050714.pdf  Radial Magento Extensions End User License Agreement
 *
 */

interface Radial_RiskService_Sdk_IShoppingSession extends Radial_RiskService_Sdk_IPayload
{
    const ROOT_NODE = 'ShoppingSession';
    const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';

    /**
     * xsd restrictions - integer format in hours / minutes
     * @return string
     */
    public function getTimeOnSite();

    /**
     * @param  Integer
     * @return self
     */
    public function setTimeOnSite($timeOnSite);

    /**
     * @return boolean
     */
    public function getReturnCustomer();

    /**
     * @param  boolean
     * @return self
     */
    public function setReturnCustomer($returnCustomer);

    /**
     * boolean
     * @return string
     */
    public function getItemsRemoved();

    /**
     * @param  boolean
     * @return self
     */
    public function setItemsRemoved($itemsRemoved);
}
