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

interface Radial_RiskService_Sdk_IPayload
{
	/**
	 * Return the string form of the payload data for transmission.
	 * Validation is implied.
	 *
	 * @throws Radial_RiskService_Sdk_Exception_Invalid_Payload_Exception
	 * @return string
	 */
	public function serialize();

	/**
	 * Fill out this payload object with data from the supplied string.
	 *
	 * @throws Radial_RiskService_Sdk_Exception_Invalid_Payload_Exception
	 * @param string
	 * @return self
	 */
	public function deserialize($string);
}
