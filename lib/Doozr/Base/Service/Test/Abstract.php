<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Doozr - Service - I18n - Test
 *
 * ServiceTest.php - This is the Test-Controller of a Service Test
 *
 * PHP versions 5.5
 *
 * LICENSE:
 * Doozr - The lightweight PHP-Framework for high-performance websites
 *
 * Copyright (c) 2005 - 2015, Benjamin Carl - All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * - Redistributions of source code must retain the above copyright notice,
 *   this list of conditions and the following disclaimer.
 * - Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 * - All advertising materials mentioning features or use of this software
 *   must display the following acknowledgement: This product includes software
 *   developed by Benjamin Carl and other contributors.
 * - Neither the name Benjamin Carl nor the names of other contributors
 *   may be used to endorse or promote products derived from this
 *   software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * Please feel free to contact us via e-mail: opensource@clickalicious.de
 *
 * @category   Doozr
 * @package    Doozr_Service
 * @subpackage Doozr_Service_I18n
 * @author     Benjamin Carl <opensource@clickalicious.de>
 * @copyright  2005 - 2015 Benjamin Carl
 * @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version    Git: $Id$
 * @link       http://clickalicious.github.com/Doozr/
 */

/**
 * Doozr - Service - I18n - Test
 *
 * This is the Test-Controller of a Service Test
 *
 * @category   Doozr
 * @package    Doozr_Service
 * @subpackage Doozr_Service_I18n
 * @author     Benjamin Carl <opensource@clickalicious.de>
 * @copyright  2005 - 2015 Benjamin Carl
 * @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @link       http://clickalicious.github.com/Doozr/
 */
abstract class Doozr_Base_Service_Test_Abstract extends PHPUnit_Framework_TestCase
{
    /**
     * The Service instance for testing
     *
     * @var Doozr_Base_Service_Interface
     * @access protected
     */
    protected static $service;

    /**
     * The name of the service
     *
     * @var string
     * @access protected
     */
    protected static $serviceName;

    /**
     * 'Doozr_Http_Service'
     *
     * @var
     */
    protected static $serviceClassName;

    /**
     * The Doozr Kernel instance
     *
     * @var Doozr_Kernel
     * @access protected
     */
    protected static $core;

    /**
     * The Doozr Registry
     *
     * @var Doozr_Registry
     * @access protected
     */
    protected static $registry;


    /**
     * Prepares setup for Tests.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return void
     * @access protected
     */
    protected function setUp()
    {
        // Init the Doozr core to execute
        self::$core = Doozr_Kernel::boot();

        // Store classname
        self::$serviceClassName = 'Doozr_' . self::$serviceName . '_Service';

        // Get registry
        self::$registry = Doozr_Registry::getInstance();

        // Load service
        self::$service = Doozr_Loader_Serviceloader::load(self::$serviceName, self::$registry->getConfiguration());
    }

    /**
     * Test: Generic - if the service is loadable and the existing instance matches the required instance.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return void
     * @access public
     */
    public function testEnsureServiceIsLoadable()
    {
        $this->assertInstanceOf(self::$serviceClassName, self::$service);
    }

    /**
     * Cleanup after test execution.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return void
     * @access protected
     */
    protected function tearDown()
    {
        self::$service = null;
    }
}
