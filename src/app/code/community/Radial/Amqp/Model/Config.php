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

class Radial_Amqp_Model_Config extends Radial_Core_Model_Config_Abstract
{
    protected $_configPaths = array(
        'last_test_message_timestamp' => 'radial_amqp/general/last_test_message_timestamp',
        'number_of_messages_to_process' => 'radial_amqp/general/number_of_messages_to_process',

        'connection_context' => 'radial_amqp/connection/context',
        'connection_insist' => 'radial_amqp/connection/insist',
        'connection_locale' => 'radial_amqp/connection/locale',
        'connection_login_method' => 'radial_amqp/connection/login_method',
        'connection_read_write_timeout' => 'radial_amqp/connection/read_write_timeout',
        'connection_timeout' => 'radial_amqp/connection/timeout',
        'connection_type' => 'radial_amqp/connection/type',
        'hostname' => 'radial_amqp/connection/hostname',
        'password' => 'radial_amqp/connection/password',
        'port' => 'radial_amqp/connection/port',
        'username' => 'radial_amqp/connection/username',
        'vhost' => 'radial_amqp/connection/vhost',

        'queue_auto_delete' => 'radial_amqp/queue/auto_delete',
        'queue_binding_nowait' => 'radial_amqp/queue/binding_nowait',
        'queue_durable' => 'radial_amqp/queue/durable',
        'queue_exclusive' => 'radial_amqp/queue/exclusive',
        'queue_names' => 'radial_amqp/queue/queue_names',
        'queue_nowait' => 'radial_amqp/queue/nowait',
        'queue_passive' => 'radial_amqp/queue/passive',
    );
}
