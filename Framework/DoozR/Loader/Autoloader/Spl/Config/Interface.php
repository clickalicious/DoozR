<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * DoozR - Loader - Autoloader - Spl - Config - Interface
 *
 * Interface.php - Interface for Config-Classes for DoozR's SPL-Autoloader-Facade.
 *
 * PHP versions 5
 *
 * LICENSE:
 * DoozR - The PHP-Framework
 *
 * Copyright (c) 2005 - 2014, Benjamin Carl - All rights reserved.
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
 * @package    DoozR_Loader
 * @subpackage DoozR_Loader_Autoloader
 * @author     Benjamin Carl <opensource@clickalicious.de>
 * @copyright  2005 - 2014 Benjamin Carl
 * @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version    Git: $Id$
 * @link       http://clickalicious.github.com/DoozR/
 * @see        -
 * @since      -
 */

/**
 * DoozR - Loader - Autoloader - Spl - Config - Interface
 *
 * Interface for Config-Classes for DoozR's SPL-Autoloader-Facade
 *
 * @category   DoozR
 * @package    DoozR_Loader
 * @subpackage DoozR_Loader_Autoloader
 * @author     Benjamin Carl <opensource@clickalicious.de>
 * @copyright  2005 - 2014 Benjamin Carl
 * @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version    Git: $Id$
 * @link       http://clickalicious.github.com/DoozR/
 * @see        -
 * @since      -
 */
interface DoozR_Autoload_Spl_Config_Interface
{
    /**
     * Setter for $_uId
     *
     * This method is intend as setter for $_uId.
     *
     * @param string $uId An unique-Id to identify the Autoloader later from outside the SPL-Facade.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return boolean true if setting was succesful, otherwise false
     * @access public
     */
    public function setUid($uId);

    /**
     * Getter for $_uId
     *
     * This method is intend as getter for $_uId.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return string The previous setted unique-Id of the Autoloader
     * @access public
     */
    public function getUid();

    /**
     * Setter for $_namespace
     *
     * This method is intend as setter for $_namespace.
     *
     * @param string $namespace A namespace for the Autoloader.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return boolean true if setting was succesful, otherwise false
     * @access public
     */
    public function setNamespace($namespace);

    /**
     * Getter for $_namespace
     *
     * This method is intend as getter for $_namespace.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return string The previous setted namespace of the Autoloader
     * @access public
     */
    public function getNamespace();

    /**
     * Setter for $_priority
     *
     * This method is intend as setter for $_priority.
     *
     * @param integer $priority A priority for the Autoloader. An integer between 0 and X (0 = highest priority).
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return boolean true if setting was succesful, otherwise false
     * @access public
     */
    public function setPriority($priority);

    /**
     * Getter for $_priority
     *
     * This method is intend as getter for $_priority.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return integer The previous setted priority of the Autoloader
     * @access public
     */
    public function getPriority();

    /**
     * Setter for $_description
     *
     * This method is intend as setter for $_description.
     *
     * @param string $description A description for the Autoloader.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return boolean true if setting was succesful, otherwise false
     * @access public
     */
    public function setDescription($description);

    /**
     * Getter for $_description
     *
     * This method is intend as getter for $_description.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return string The previous setted description of the Autoloader
     * @access public
     */
    public function getDescription();

    /**
     * Setter for a single file-extension (added to $_extension)
     *
     * This method is intend as setter for a single file-extension (added to $_extension).
     *
     * @param string $extension A file-extension used by the Autoloader.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return boolean true if setting was succesful, otherwise false
     * @access public
     */
    public function addExtension($extension);

    /**
     * Setter for a list of (array) file-extensions (added to $_extension)
     *
     * This method is intend as setter for a list of (array) file-extensions (added to $_extension).
     *
     * @param array $extensions A list of file-extensions used by the Autoloader.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return boolean true if setting was succesful, otherwise false
     * @access public
     */
    public function addExtensions(array $extensions);

    /**
     * Getter for $_extension
     *
     * This method is intend as getter for $_extension.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return array The previous setted extension(s) used by the Autoloader
     * @access public
     */
    public function getExtension();

    /**
     * Setter for $_class
     *
     * This method is intend as setter for a class containing the Autoloader-Method (Function).
     *
     * @param string $class A name of a class containing the Autoloader-Method used by the Autoloader.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return boolean true if setting was succesful, otherwise false
     * @access public
     */
    public function setClass($class);

    /**
     * Getter for $_class
     *
     * This method is intend as getter for $_class.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return string The previous setted class used by the Autoloader
     * @access public
     */
    public function getClass();

    /**
     * Returns is-class status of the Autoloader-Config
     *
     * This method is intend to return the is-class status of the Autoloader-Config.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return boolean true is a Class containing the Autoloader-Method (Function), otherwise false (proced. Function)
     * @access public
     */
    public function isClass();

    /**
     * Setter for $_method
     *
     * This method is intend as setter for a method (function) used as "loader" by the Autoloader.
     *
     * @param string $method A method-name used by the Autoloader.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return boolean true if setting was succesful, otherwise false
     * @access public
     */
    public function setMethod($method);

    /**
     * Getter for $_method
     *
     * This method is intend as getter for $_method.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return string The previous setted method used by the Autoloader
     * @access public
     */
    public function getMethod();

    /**
     * Setter for $_method (alias for setMethod())
     *
     * This method is intend as setter for a method (function) used as "loader" by the Autoloader.
     *
     * @param string $function A function-name used by the Autoloader.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return boolean true if setting was succesful, otherwise false
     * @access public
     */
    public function setFunction($function);

    /**
     * Getter for $_method (alias for getMethod())
     *
     * This method is intend as getter for $_method.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return string The previous setted method used by the Autoloader
     * @access public
     */
    public function getFunction();

    /**
     * Setter for $_path
     *
     * This method is intend as setter for a path or a list of (array) paths used for lookup by the Autoloader.
     *
     * @param mixed $path A single path (string) or a list of paths (array) used by the Autoloader for lookup for files.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return boolean true if setting was succesful, otherwise false
     * @access public
     */
    public function setPath($path);

    /**
     * Alias to Setter for $_path
     *
     * This method is intend as setter for a path. It adds a single path or a list of (array) paths to the already
     * exiting path(s).
     *
     * @param mixed $path A single path (string) or a list of paths (array) used by the Autoloader for lookup for files.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return boolean true if setting was succesful, otherwise false
     * @access public
     */
    public function addPath($path);

    /**
     * Getter for $_path
     *
     * This method is intend as getter for $_path.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return array The previous setted path(s) used by the Autoloader
     * @access public
     */
    public function getPath();

    /**
     * This method is the loader mechanism for this loader config
     *
     * @param string $classname The name of the class to load
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return void
     * @access public
     */
    public function load($classname);

    /**
     * This method returns TRUE if the current instance is a loader,
     * otherwise FALSE.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return boolean TRUE if loader, otherwise FALSE
     * @access public
     */
    public function isLoader();
}
