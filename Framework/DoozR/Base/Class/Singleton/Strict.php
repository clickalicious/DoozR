<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * DoozR Base-Singleton-Class (Strict)
 *
 * Strict.php - Strict Base-Singleton-Class of the DoozR Framework
 * Strict stands for the difference to the loose Version of this class
 * (DoozRBaseSingleton.php) which do not use the given parameter at instanciation
 * to check for singleton instance
 *
 * PHP versions 5
 *
 * LICENSE:
 * DoozR - The PHP-Framework
 *
 * Copyright (c) 2005 - 2013, Benjamin Carl - All rights reserved.
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
 * @category   DoozR
 * @package    DoozR_Base
 * @subpackage DoozR_Base_Class_Singleton_Strict
 * @author     Benjamin Carl <opensource@clickalicious.de>
 * @copyright  2005 - 2013 Benjamin Carl
 * @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version    Git: $Id$
 * @link       http://clickalicious.github.com/DoozR/
 * @see        -
 * @since      -
 */

require_once DOOZR_DOCUMENT_ROOT.'DoozR/Base/Class/Singleton/Generic.php';

/**
 * DoozR Base-Singleton-Class (Strict)
 *
 * Strict Base-Singleton-Class of the DoozR Framework
 *
 * @category   DoozR
 * @package    DoozR_Base
 * @subpackage DoozR_Base_Class_Singleton_Strict
 * @author     Benjamin Carl <opensource@clickalicious.de>
 * @copyright  2005 - 2013 Benjamin Carl
 * @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version    Git: $Id$
 * @link       http://clickalicious.github.com/DoozR/
 * @see        -
 * @since      -
 */
class DoozR_Base_Class_Singleton_Strict extends DoozR_Base_Class_Singleton_Generic
{
    protected static $instance = null;

    /**
     * instance getter for strict (including parameter!) singleton
     *
     * This method is intend to setup and call generic singleton-getter and return an instance
     * of the requested class.
     *
     * @return  object instance/object of this class
     * @access  public
     * @author  Benjamin Carl <opensource@clickalicious.de>
     * @since   Method available since Release 1.0.0
     * @version 1.0
     */
    public static function getInstance()
    {
        // set strict to false
        // -> meaning: no matter which parameter given we return the same instance
        self::$strict = true;

        // get possible parameter passed to this class
        $arguments = func_get_args();

        // decide call-type by given parameter
        if (empty($arguments)) {
            $instance = parent::getInstance();
        } else {
            $instance = parent::getInstance($arguments);
        }

        // return instance
        return $instance;

/*
        // check for instance (requires loading?)
        if (!self::$instance) {
            // decide call-type by given parameter
            if (empty($arguments)) {
                self::$instance = parent::getInstance();
            } else {
                self::$instance = parent::getInstance($arguments);
            }
        }

        // return instance
        return self::$instance;
*/
    }
}

?>
