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

class Radial_Amqp_Test_Model_Adminhtml_System_Config_Backend_LasttestmessageTest extends Radial_Core_Test_Base
{
    /**
     * Provide the last captured timestamp and the resulting value of the model
     * @return array
     */
    public function provideLastTimestamp()
    {
        return array(
            array(null, 'Radial_Amqp_No_Test_Message_Received'),
            array('not a timestamp', 'Radial_Amqp_No_Test_Message_Received'),
            array('2000-01-01T00:00:00+12:00', '2000-01-01T00:00:00+12:00'),
        );
    }
    /**
     * Test getting the last saved test message timestamp to be displayed in the
     * admin.
     * @param string|null $timestamp
     * @param string $value
     * @dataProvider provideLastTimestamp
     */
    public function testAfterLoad($lastTimestamp, $value)
    {
        // suppression the real session from starting
        $session = $this->getModelMockBuilder('core/session')
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();
        $this->replaceByMock('singleton', 'core/session', $session);

        $helper = $this->getHelperMock('radial_amqp/data');

        $helper->expects($this->any())
            ->method('__')
            ->will($this->returnArgument(0));
        $lasttestmessage = Mage::getModel(
            'radial_amqp/adminhtml_system_config_backend_lasttestmessage',
            array('value' => $lastTimestamp, 'helper' => $helper)
        );

        EcomDev_Utils_Reflection::invokeRestrictedMethod($lasttestmessage, '_afterLoad');
        $this->assertSame($value, $lasttestmessage->getValue());
    }
}
