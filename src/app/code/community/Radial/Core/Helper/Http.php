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

class Radial_Core_Helper_Http extends Mage_Core_Helper_Http
{
    /**
     * Retrieve Client Remote Address
     *
     * @param bool $ipToLong converting IP to long format
     * @return string IPv4|long
     */
    public function getRemoteAddr($ipToLong = false)
    {
        if (is_null($this->_remoteAddr)) {
            $headers = $this->getRemoteAddrHeaders();
            foreach ($headers as $var) {
                if ($this->_getRequest()->getServer($var, false)) {
                        $ip_array=explode(',',$this->_getRequest()->getServer($var, false));

                        foreach( $ip_array as $ipAddress )
                        {
                                //Some routers are inserting characters after the IP, trim it. -RK
                                preg_match_all('/\d{1,3}/',$ipAddress,$r);
                                $this->_remoteAddr = $r[0][0].'.'.$r[0][1].'.'.$r[0][2].'.'.$r[0][3];

                                if( $this->_remoteAddr )
                                {
                                        if( !$this->ip_is_private($this->_remoteAddr))
                                        {
                                                break;
                                        } else {
                                                $this->_remoteAddr = '';
                                        }
                                }
                        }
                }

                if( $this->_remoteAddr )
                {
                        break;
                }
            }

            if (!$this->_remoteAddr) {
                $this->_remoteAddr = $this->_getRequest()->getServer('REMOTE_ADDR');
            }
        }

        if (!$this->_remoteAddr) {
            return false;
        }

        return $ipToLong ? inet_pton($this->_remoteAddr) : $this->_remoteAddr;
    }

    /**
     * Determine if IP Address is of a private subnet
     *
     * @param IPv4 IP Address
     * @return bool
     */
    private function ip_is_private($ip)
    {
        $privateAddresses = [ '10.0.0.0|10.255.255.255', '172.16.0.0|172.31.255.255', '192.168.0.0|192.168.255.255', '169.254.0.0|169.254.255.255', '127.0.0.0|127.255.255.255' ];
        $long_ip = ip2long($ip);
        if($long_ip != -1)
        {
            foreach($privateAddresses as $pri_addr)
            {
                list($start, $end) = explode('|', $pri_addr);
                // IF IS PRIVATE
                if($long_ip >= ip2long($start) && $long_ip <= ip2long($end))
                {
                        return true;
                }
            }
        }
        return false;
    }

    /**
     * Retrieve the remote client's host name
     *
     * @return string
     */
    public function getRemoteHost()
    {
        return gethostbyaddr($this->getRemoteAddr(false));
    }
}
