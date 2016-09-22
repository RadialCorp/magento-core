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

use eBayEnterprise\RetailOrderManagement\Payload\Exception;
use eBayEnterprise\RetailOrderManagement\Payload\OrderEvents\IOrderEvent;

class Radial_Amqp_Model_Runner
{
    protected $_eventPrefix = 'radial_amqp_message';
    /** @var Radial_Amqp_Helper_Data */
    protected $_helper;
    /** @var Radial_Amqp_Helper_Config */
    protected $_amqpConfigHelper;
    /** @var Radial_Core_Helper_Data */
    protected $_coreHelper;
    /** @var EbayEnterprise_MageLog_Helper_Data */
    protected $_logger;
    /** @var EbayEnterprise_MageLog_Helper_Context */
    protected $_context;
    /** @var Mage_Core_Model_Store */
    protected $_store;
    /** @var IAmqpApi */
    protected $_api;

    /**
     * @param array $initParams May accept:
     *                          - 'helper' => Radial_Amqp_Helper_Data
     *                          - 'amqpConfigHelper' => Radial_Amqp_Helper_Config
     *                          - 'core_helper' => Radial_Core_Helper_Data
     *                          - 'logger' => EbayEnterprise_MageLog_Helper_Data
     *                          - 'context' => EbayEnterprise_MageLog_Helper_Context
     */
    public function __construct(array $initParams = array())
    {
        list($this->_helper, $this->_amqpConfigHelper, $this->_coreHelper, $this->_logger, $this->_context) = $this->_checkTypes(
            $this->_nullCoalesce($initParams, 'helper', Mage::helper('radial_amqp')),
            $this->_nullCoalesce($initParams, 'amqp_config_helper', Mage::helper('radial_amqp/config')),
            $this->_nullCoalesce($initParams, 'core_helper', Mage::helper('radial_core')),
            $this->_nullCoalesce($initParams, 'logger', Mage::helper('ebayenterprise_magelog')),
            $this->_nullCoalesce($initParams, 'context', Mage::helper('ebayenterprise_magelog/context'))
        );
    }
    /**
     * Type hinting for self::__construct $initParams
     * @param Radial_Amqp_Helper_Data $helper
     * @param Radial_Amqp_Helper_Config $amqpConfigHelper
     * @param Radial_Core_Helper_Data $coreHelper
     * @param EbayEnterprise_MageLog_Helper_Data $logger
     * @param EbayEnterprise_MageLog_Helper_Context $context
     * @return array
     */
    protected function _checkTypes(
        Radial_Amqp_Helper_Data $helper,
        Radial_Amqp_Helper_Config $amqpConfigHelper,
        Radial_Core_Helper_Data $coreHelper,
        EbayEnterprise_MageLog_Helper_Data $logger,
        EbayEnterprise_MageLog_Helper_Context $context
    ) {
        return array($helper, $amqpConfigHelper, $coreHelper, $logger, $context);
    }
    /**
     * Return the value at field in array if it exists. Otherwise, use the
     * default value.
     * @param array $arr
     * @param string|int $field Valid array key
     * @param mixed $default
     * @return mixed
     */
    protected function _nullCoalesce(array $arr, $field, $default)
    {
        return isset($arr[$field]) ? $arr[$field] : $default;
    }
    /**
     * For each store with a unique AMQP configuration, consume messages from
     * each configured queue.
     * @return self
     */
    public function processQueues()
    {
        // consume queues for each store with a unique set of AMQP configuration
        foreach ($this->_amqpConfigHelper->getQueueConfigurationScopes() as $store) {
	    $this->_store = $store;
            $this->_consumeStoreQueues($store);
        }
        return $this;
    }
    /**
     * Consume messages from all queues, configured for the given store.
     * @param Mage_Core_Model_Store $store
     * @return self
     */
    protected function _consumeStoreQueues(Mage_Core_Model_Store $store)
    {
        // consume messages from each queue configured within the scope of the store
        foreach ($this->_helper->getConfigModel($store)->queueNames as $queueName) {
            $this->_consumeQueue($queueName, $store);
        }
        return $this;
    }
    /**
     * Fetch messages from the queue within the store scope.
     * @param string $queue Name of the AMQP queue
     * @param Mage_Core_Model_Store $store
     * @return self
     */
    protected function _consumeQueue($queue, Mage_Core_Model_Store $store)
    {
        $this->_api = $this->_helper->getSdkAmqp($queue, $store);
        $this->_api->openConnection();
        $this->_api->getChannel()->basic_consume($queue, '', false, false, false, false, array($this, 'process'));

        $timeout = 2;
        while (count($this->_api->getChannel()->callbacks)) {
                try{
                    $this->_api->getChannel()->wait(null, false , $timeout);
                }catch(\PhpAmqpLib\Exception\AMQPTimeoutException $e){
                    $this->_api->getChannel()->close();
                    exit;
                }
        }

        return $this;
    }

    public function process($msg)
    {
	$payload = $this->_api->processMessage($msg);

	if($payload)
	{
        	$msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
		$this->_dispatchPayload($payload, $this->_store);
	}
    }

    /**
     * Dispacth an event in Magento with the payload and store scope it was received in.
     * @param IOrderEvent $payload
     * @param Mage_Core_Model_Store $store
     * @return self
     */
    protected function _dispatchPayload(IOrderEvent $payload, Mage_Core_Model_Store $store)
    {
        $eventName = $this->_eventPrefix . '_' . $this->_coreHelper->underscoreWords($payload->getEventType());
        /** @var \eBayEnterprise\RetailOrderManagement\Payload\IPayload $payload */
        $logData = ['event_name' => $eventName, 'payload' => $payload->serialize()];
        $logMessage = 'Dispatching event "{event_name}" for payload.';
        $this->_logger->info($logMessage, $this->_context->getMetaData(__CLASS__, $logData));
        Mage::dispatchEvent($eventName, array('payload' => $payload, 'store' => $store));
        return $this;
    }
}
