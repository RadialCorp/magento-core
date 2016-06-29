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
class Radial_Core_Model_Adminhtml_System_Config_Backend_PTFinstalled extends Mage_Core_Model_Config_Data
{
    /**
     * @return self
     * @codeCoverageIgnore Magento promises to display the value; glob promises to deliver an array of matching files.
     */
    public function _afterLoad()
    {
	//Dipstick Test

        $filePattern[] = Mage::getBaseDir() . '/js/radial_creditcard/';
	$filePattern[] = Mage::getBaseDir() . '/js/radial_eb2cfraud/';
	$filePattern[] = Mage::getBaseDir() . '/js/radial_core/';
	$filePattern[] = Mage::getBaseDir() . '/app/design/adminhtml/default/default/template/radial_creditcard/';
	$filePattern[] = Mage::getBaseDir() . '/app/design/frontend/base/default/template/radial_paypal';
	$filePattern[] = Mage::getBaseDir() . '/app/design/adminhtml/default/default/template/radial_amqp/'; 
	$filePattern[] = Mage::getBaseDir() . '/app/design/frontend/base/default/template/eb2cfraud/';  
	$filePattern[] = Mage::getBaseDir() . '/lib/Radial/RiskService/';
	$filePattern[] = Mage::getBaseDir() . '/app/code/community/Radial/';
	$filePattern[] = Mage::getBaseDir() . '/vendor/radial/retail-order-management';

	$fileCount = 0;
	$bytestotal = 0;
 
	foreach($filePattern as $fileP)
	{
		if( file_exists( $fileP ))
		{
			$objects = new RecursiveDirectoryIterator($fileP);
	
			foreach(new RecursiveIteratorIterator($objects) as $filename=>$cur)
			{
				$filesize = $cur->getSize();
				$bytestotal += $filesize;
				$fileCount++;
			}	
    		}
	}

	$bytestotal = number_format($bytestotal);

	if (!$fileCount) {
        	$publicDisplay = 'Radial PTF Extension Not Installed Correctly! Please contact Radial Helpdesk!';
        } else {
                $publicDisplay = 'Yes, ' . $fileCount . ' installed files found - CHECKSUM: '. $bytestotal;
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
