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

class Radial_Core_Model_Config extends Radial_Core_Model_Config_Abstract
{
    protected $_configPaths = [
        'ack_resend_time_limit'          => 'radial_core/feed/export/ack/resend_time_limit',
        'api_hostname'                   => 'radial_core/api/hostname',
        'api_key'                        => 'radial_core/api/key',
        'api_major_version'              => 'radial_core/api/major_version',
        'api_minor_version'              => 'radial_core/api/minor_version',
        'api_namespace'                  => 'radial_core/api/xml_namespace',
        'api_timeout'                    => 'radial_core/api/timeout',
        'api_xsd_path'                   => 'radial_core/api/xsd_path',
        'catalog_id'                     => 'radial_core/general/catalog_id',
        'client_customer_id_length'      => 'radial_core/general/client_customer_id_length',
        'client_customer_id_prefix'      => 'radial_core/general/client_customer_id_prefix',
        'client_id'                      => 'radial_core/general/client_id',
        'client_order_id_prefix'         => 'radial_core/general/client_order_id_prefix',
        'delete_remote_feed_files'       => 'radial_core/feed/delete_remote_feed_files',
        'error_feed'                     => 'radial_core/feed/filetransfer_exports/error_confirmations',
        'error_feed_filename_format'     => 'radial_core/feed/filetransfer_exports/error_confirmations/filename_format',
        // ack filetransfer imports for acks from eb2c for feeds we've sent
        'feed_ack_inbox'                 => 'radial_core/feed/filetransfer_imports/acknowledgements/local_directory',
        'feed_ack_error_directory'       => 'radial_core/feed/filetransfer_imports/acknowledgements/local_error_directory',
        // ack filetransfer exports for acks we send for files eb2c sent us
        'feed_ack_export'                => 'radial_core/feed/filetransfer_exports/acknowledgements',
        'feed_ack_filename_format'       => 'radial_core/feed/filetransfer_exports/acknowledgements/filename_format',
        'feed_ack_outbox'                => 'radial_core/feed/filetransfer_exports/acknowledgements/local_directory',
        'feed_ack_timestamp_format'      => 'radial_core/feed/filetransfer_exports/acknowledgements/timestamp_format',
        'feed_ack_xsd'                   => 'radial_core/feed/filetransfer_exports/acknowledgements/xsd',
        'feed_available_models'          => 'radial_core/feed/available_models',
        'feed_destination_type'          => 'radial_core/feed/destination_type',
        'feed_enabled_reindex'           => 'radial_core/feed/enabled_reindex',
        'feed_export_archive'            => 'radial_core/feed/export_archive',
        'feed_header_template'           => 'radial_core/feed/header_template',
        'feed_import_archive'            => 'radial_core/feed/import_archive',
        'feed_outbox'                    => 'radial_core/feed/filetransfer_exports/eb2c_outbox',
        'feed_outbox_directory'          => 'radial_core/feed/filetransfer_exports/eb2c_outbox/local_directory',
        'feed_processing_directory'      => 'radial_core/feed/processing_directory',
        'feed_sent_directory'            => 'radial_core/feed/filetransfer_exports/eb2c_outbox/sent_directory',
        'is_backorderable'               => 'radial_core/service/inventory/is_backorderable',
        'is_use_street_date_as_edd_date' => 'radial_core/service/inventory/is_use_street_date_as_edd_date',
        'language_code'                  => 'radial_core/general/language_code',
        'service_order_timeout'          => 'radial_core/service/order/timeout',
        'service_payment_timeout'        => 'radial_core/service/payment/timeout',
        'sftp_config'                    => 'radial_core/feed',
        'sftp_auth_type'                 => 'radial_core/feed/filetransfer_sftp_auth_type',
        'sftp_location'                  => 'radial_core/feed/filetransfer_sftp_host',
        'sftp_password'                  => 'radial_core/feed/filetransfer_sftp_password',
        'sftp_port'                      => 'radial_core/feed/filetransfer_sftp_port',
        'sftp_private_key'               => 'radial_core/feed/filetransfer_sftp_ssh_prv_key',
        'sftp_username'                  => 'radial_core/feed/filetransfer_sftp_username',
        'store_id'                       => 'radial_core/general/store_id',
        'to_street_date_range'           => 'radial_core/service/inventory/to_street_date_range',
        'shipping_method_map'            => 'radial_core/shipmap',
        'virtual_shipping_method_id'     => 'radial_core/shipping/virtual_shipping_method_id',
        'virtual_shipping_method_description' => 'radial_core/shipping/virtual_shipping_method_description',
    ];
}
