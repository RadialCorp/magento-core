<?php
/**
 * Copyright (c) 2013-2016 Radial, Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @copyright   Copyright (c) 2013-2016 Radial, Inc. (http://www.radial.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 */
class Radial_Core_Model_Adminhtml_System_Config_Backend_ROMxmlinstalled extends Mage_Core_Model_Config_Data
{
    /**
     * @return self
     * @codeCoverageIgnore Magento promises to display the value; glob promises to deliver an array of matching files.
     */
    public function _afterLoad()
    {
	//Dipstick Test

        $filePattern = Mage::getBaseDir() . '/app/etc/rom.xml';
       	$jsFiles = glob($filePattern);

	if (!$jsFiles) {
        	$publicDisplay = 'Radial PTF Extension rom.xml missing! Please contact Radial Helpdesk!';
        } else {
		$shipArray = Mage::getStoreConfig('radial_core/shipmap');
		$count = count($shipArray);
		$tenderArray = Mage::getStoreConfig('radial_creditcard/tender_types');	
		$count += count($tenderArray);
		
		if( !$count ) 
		{
			$publicDisplay = 'No, /app/etc/rom.xml found! But, shipmap and Radial CC Tender Types Not Found!';
		} else {
                	$publicDisplay = 'Yes, ' . $count . ' shipmap / tender_type mappings in rom.xml installed!';
		}
        }

	$this->setValue($publicDisplay);
        return $this;
    }

    /**
     * Simply turn of data saving. This is a display-only field in admin dependent upon presence of
     *  files in the filesystem, not any configuration data.
     * @return self
     * @codeCoverageIgnore Magento promises to not save anything if _dataSaveAllowed is false.
     */
    public function _beforeSave()
    {
        $this->_dataSaveAllowed = false;
        return $this;
    }
}
