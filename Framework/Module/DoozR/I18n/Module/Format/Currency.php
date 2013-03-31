<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * DoozR - I18n - Module - Format - Currency
 *
 * Currency.php - Currency formatter
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
 * @package    DoozR_Module
 * @subpackage DoozR_Module_I18n
 * @author     Benjamin Carl <opensource@clickalicious.de>
 * @copyright  2005 - 2013 Benjamin Carl
 * @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version    Git: $Id$
 * @link       http://clickalicious.github.com/DoozR/
 * @see        -
 * @since      -
 */

require_once DOOZR_DOCUMENT_ROOT.'Module/DoozR/I18n/Module/Format/Abstract.php';

/**
 * DoozR - I18n - Module - Format - Currency
 *
 * Currency.php - Currency formatter
 *
 * @category   DoozR
 * @package    DoozR_Module
 * @subpackage DoozR_Module_I18n
 * @author     Benjamin Carl <opensource@clickalicious.de>
 * @copyright  2005 - 2013 Benjamin Carl
 * @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version    Git: $Id$
 * @link       http://clickalicious.github.com/DoozR/
 * @see        -
 * @since      -
 */
class DoozR_I18n_Module_Format_Currency extends DoozR_I18n_Module_Format_Abstract
{
    /*******************************************************************************************************************
     * // BEGIN PUBLIC INTERFACES
     ******************************************************************************************************************/

    /**
     * This method is intend to format a given value as correct currency.
     *
     * @param string $value          The value to format as currency
     * @param mixed  $notation       Notation to be shown - can be either (null = no), long, short, symbol
     * @param string $country        The countrycode of the country of the current processed currency
     * @param string $encoding       The encoding use to display the currency - null, html, ascii, unicode (ansi)
     * @param string $symbolPosition Set to "l" to show symbols on the left, or to "r" to show on right side
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return string The correct formatted currency
     * @access public
     */
    public function format(
        $value,
        $notation = null,
        $country = null,
        $encoding = null,
        $symbolPosition = null
    ) {
        // get country
        $country = (!$country) ? $this->locale : $country;

        // format the given value
        $formatted = number_format(
            $value,
            $this->configL10n->CURRENCY->MINOR_UNIT(),
            $this->configL10n->CURRENCY->DECIMAL_POINT(),
            $this->configL10n->CURRENCY->THOUSANDS_SEPERATOR()
        );

        // is value = major (1) or minor (0)
        $type = ($value < 1) ? 'minor' : 'major';

        // check for position override
        if (!$symbolPosition) {
            $symbolPosition = $this->configL10n->CURRENCY->SYMBOL_POSITION();
        }

        // if notation set overwrite it with the concrete notation
        if ($notation) {
            // get notation from CURRENCY-table
            $encoding = ($notation == 'symbol' && $encoding) ? '_'.strtoupper($encoding) : '';

            // get notation
            $notation = $this->getConfig()->{strtoupper($country)}->MAJOR_SYMBOL();

            // spacing between curreny-symbol and value
            $notationSpace = $this->configL10n->CURRENCY->NOTATION_SPACE();

            // check where to add the symbol ...
            if ($symbolPosition == 'l') {
                $formatted = $notation.$notationSpace.$formatted;
            } else {
                $formatted = $formatted.$notationSpace.$notation;
            }
        }

        // return formatted (currency) result
        return $formatted;
    }

    /**
     * This method is intend to return the currency-code for the current active locale.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return integer The currency-code
     * @access public
     * @throws DoozR_I18n_Module_Exception
     */
    public function getCurrencyCode()
    {
        try {
            return $this->configL10n->CURRENCY->CODE();
        } catch (Exception $e) {
            throw new DoozR_I18n_Module_Exception('Error reading currency code from L10N config.', null, $e);
        }

        return null;
    }

    /*******************************************************************************************************************
     * \\ END PUBLIC INTERFACES
     ******************************************************************************************************************/

    /*******************************************************************************************************************
     * // BEGIN TOOLS + HELPER
     ******************************************************************************************************************/

    /*******************************************************************************************************************
     * \\ BEGIN TOOLS + HELPER
     ******************************************************************************************************************/

    /*******************************************************************************************************************
     * // BEGIN MAIN CONTROL METHODS (CONSTRUCTOR AND INIT)
     ******************************************************************************************************************/

    /**
     * This method is intend to act as constructor.
     *
     * @param DoozR_Registry_Interface $registry  The DoozR_Registry instance
     * @param string                   $locale     The locale this instance is working with
     * @param string                   $namespace  The active namespace of this format-class
     * @param object                   $configI18n An instance of DoozR_Config_Ini holding the I18n-config
     * @param object                   $configL10n An instance of DoozR_Config_Ini holding the I10n-config (for locale)
     * @param object                   $translator An instance of a translator (for locale)
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @return object Instance of this class
     * @access public
     */
    public function __construct(
        DoozR_Registry_Interface $registry = null,
        $locale = null,
        $namespace = null,
        $configI18n = null,
        $configL10n = null,
        $translator = null
    ) {
        // set type of format-class
        $this->type = 'Currency';

        // call parents construtor
        parent::__construct($registry, $locale, $namespace, $configI18n, $configL10n, $translator);
    }

    /*******************************************************************************************************************
     * \\ END MAIN CONTROL METHODS (CONSTRUCTOR AND INIT)
     ******************************************************************************************************************/
}

?>
