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

class Radial_RiskService_Sdk_Payment_Card
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_Payment_ICard
{
	/** @var string */
	protected $_cardHolderName;
	/** @var string */
	protected $_paymentAccountUniqueId;
	/** @var bool */
	protected $_isToken;
	/** @var string */
	protected $_paymentAccountBin;
	/** @var string */
	protected $_expireDate;
	/** @var string */
	protected $_cardType;
	/** @var string */
	protected $_gatewayKey;
	/** @var string */
	protected $_orderAppId;
	/** @var string */
	protected $_paymentSessionId;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_optionalExtractionPaths = array(
			'setCardHolderName' => 'x:CardHolderName',
			'setPaymentAccountUniqueId' => 'x:PaymentAccountUniqueId',
			'setPaymentAccountBin' => 'x:PaymentAccountBin',
			'setExpireDate' => 'x:ExpireDate',
			'setOrderAppId' => 'x:OrderAppId',
			'setPaymentSessionId' => 'x:PaymentSessionId',
			'setGatewayKey' => 'x:GatewayKey',
			'setCardType' => 'x:CardType',
		);
		$this->_booleanExtractionPaths = array(
			'setIsToken' => 'string(x:PaymentAccountUniqueId/@isToken)',
		);
	}

	/**
	 * @see Radial_RiskService_Sdk_Payment_ICard::getCardHolderName()
	 */
	public function getCardHolderName()
	{
		return $this->_cardHolderName;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payment_ICard::setCardHolderName()
	 */
	public function setCardHolderName($cardHolderName)
	{
		$this->_cardHolderName = $cardHolderName;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payment_ICard::getPaymentAccountUniqueId()
	 */
	public function getPaymentAccountUniqueId()
	{
		return $this->_paymentAccountUniqueId;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payment_ICard::setPaymentAccountUniqueId()
	 */
	public function setPaymentAccountUniqueId($paymentAccountUniqueId)
	{
		$this->_paymentAccountUniqueId = $paymentAccountUniqueId;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payment_ICard::getIsToken()
	 */
	public function getIsToken()
	{
		return $this->_isToken;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payment_ICard::setIsToken()
	 */
	public function setIsToken($isToken)
	{
		$this->_isToken = $isToken;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payment_ICard::getPaymentAccountBin()
	 */
	public function getPaymentAccountBin()
	{
		return $this->_paymentAccountBin;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payment_ICard::setPaymentAccountBin()
	 */
	public function setPaymentAccountBin($paymentAccountBin)
	{
		$this->_paymentAccountBin = $paymentAccountBin;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payment_ICard::getExpireDate()
	 */
	public function getExpireDate()
	{
		return $this->_expireDate;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payment_ICard::setExpireDate()
	 */
	public function setExpireDate($expireDate)
	{
		$this->_expireDate = $expireDate;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payment_ICard::getCardType()
	 */
	public function getCardType()
	{
		return $this->_cardType;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payment_ICard::setCardType()
	 */
	public function setCardType($cardType)
	{
		$this->_cardType = $cardType;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payment_ICard::getGatewayKey()
	 */
	public function getGatewayKey()
	{
		return $this->_gatewayKey;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payment_ICard::setGatewayKey()
	 */
	public function setGatewayKey($gatewayKey)
	{
		$this->_gatewayKey = $gatewayKey;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_Payment_ICard::getOrderAppId()
         */
        public function getOrderAppId()
        {
                return $this->_orderAppId;
        }

        /**
         * @see Radial_RiskService_Sdk_Payment_ICard::setOrderAppId()
         */
        public function setOrderAppId($orderAppId)
        {
                $this->_orderAppId = $orderAppId;
                return $this;
        }

	/**
         * @see Radial_RiskService_Sdk_Payment_ICard::getPaymentSessionId()
         */
        public function getPaymentSessionId()
        {
                return $this->_paymentSessionId;
        }

        /**
         * @see Radial_RiskService_Sdk_Payment_ICard::setPaymentSessionId()
         */
        public function setPaymentSessionId($paymentSessionId)
        {
                $this->_paymentSessionId = $paymentSessionId;
                return $this;
        }

	/**
	 * @see Radial_RiskService_Sdk_Payload::_canSerialize()
	 */
	protected function _canSerialize()
	{
		return (trim($this->_serializeContents()) !== '');
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_getRootNodeName()
	 */
	protected function _getRootNodeName()
	{
		return static::ROOT_NODE;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_getXmlNamespace()
	 */
	protected function _getXmlNamespace()
	{
		return self::XML_NS;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_serializeContents()
	 */
	protected function _serializeContents()
	{
		return $this->_serializeOptionalValue('CardHolderName', $this->getCardHolderName())
			. $this->_serializePaymentAccountUniqueId()
			. $this->_serializeOptionalValue('ExpireDate', $this->getExpireDate())
			. $this->_serializeOptionalValue('OrderAppId', $this->getOrderAppId())
			. $this->_serializeOptionalValue('PaymentSessionId', $this->getPaymentSessionId())
			. $this->_serializeOptionalValue('GatewayKey', $this->getGatewayKey())
			. $this->_serializeOptionalValue('CardType', $this->getCardType());
	}

	/**
	 * Serialize the payment account unique id node if there's a valid value.
	 *
	 * @return string
	 */
	protected function _serializePaymentAccountUniqueId()
	{
		$isToken = $this->getIsToken();
                $paymentAccountUniqueId = $this->getPaymentAccountUniqueId();

                if( $isToken && $isToken != false && $isToken != "false" )
                {
                         return $paymentAccountUniqueId ? "<PaymentAccountUniqueId isToken=\"true\">{$paymentAccountUniqueId}</PaymentAccountUniqueId>" : '';
                } else {
                         return $paymentAccountUniqueId ? "<PaymentAccountUniqueId isToken=\"0\">{$paymentAccountUniqueId}</PaymentAccountUniqueId>" : '';
                }
	}
}
