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
 *
 * @var Mage_Sales_Model_Resource_Setup $installer
 */
$installer = $this;
$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS {$installer->getTable('radial_core/retryqueue')};
CREATE TABLE {$installer->getTable('radial_core/retryqueue')} (
  `retryqueue_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Answer Id',
  `created_at` datetime NOT NULL COMMENT 'Created At',
  `event_name` varchar(255) DEFAULT NULL COMMENT 'Event Name',
  `message_content` text COMMENT 'Message Content',
  `delivery_status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Delivery Status',
  PRIMARY KEY (`retryqueue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='PTF CURL Message Retry Queue';");

$installer->endSetup();
