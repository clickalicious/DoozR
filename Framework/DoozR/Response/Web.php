<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * DoozR Response Web
 *
 * Web.php - Response Web - Response-Handler to pass responses to WEB
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
 * @package    DoozR_Response
 * @subpackage DoozR_Response_Web
 * @author     Benjamin Carl <opensource@clickalicious.de>
 * @copyright  2005 - 2013 Benjamin Carl
 * @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version    Git: $Id$
 * @link       http://clickalicious.github.com/DoozR/
 * @see        -
 * @since      -
 */

require_once DOOZR_DOCUMENT_ROOT.'DoozR/Base/Response.php';

/**
 * DoozR Response Web
 *
 * Response Web - Response-Handler to pass responses to WEB
 *
 * @category   DoozR
 * @package    DoozR_Response
 * @subpackage DoozR_Response_Web
 * @author     Benjamin Carl <opensource@clickalicious.de>
 * @copyright  2005 - 2013 Benjamin Carl
 * @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version    Git: $Id$
 * @link       http://clickalicious.github.com/DoozR/
 * @see        -
 * @since      -
 */
class DoozR_Response_Web extends DoozR_Base_Response
{
    /**
     * The GZIP compression status of the current connection
     *
     * @var boolean
     * @access private
     */
    private $_isGzipCompressed = false;

    /**
     * holds the status of GZIP-Initializing
     * to prevent calling 'ob_gzhandler' twice!
     *
     * @var boolean
     * @access private
     * @static
     */
    private static $_initialized = array(
        'gzip' => false
    );

    /**
     * const REDIRECT_TYPE_HTML
     *
     * need to identify HTML Redirect Type
     *
     * @var string
     */
    const REDIRECT_TYPE_HTML = 'html';

    /**
     * const REDIRECT_TYPE_HEADER
     *
     * need to identify Header Redirect Type
     *
     * @var string
     */
    const REDIRECT_TYPE_HEADER = 'header';

    /**
     * const REDIRECT_TYPE_JS
     *
     * need to identify HTML Redirect Type
     *
     * @var string
     */
    const REDIRECT_TYPE_JS = 'js';

    /**
     * The type of this response
     *
     * @var string
     * @access const
     */
    const TYPE = 'web';

    /**
     * The protocol-version used for current
     * HTTP communication
     *
     * @var string
     * @access const
     */
    const HTTP_VERSION = '1.1';


    /**
     * Constructor of this class
     *
     * This method is the constructor of this class.
     *
     * @param DoozR_Config $config An instance of config
     * @param DoozR_Logger $logger An instance of logger
     *
     * @return void
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    public function __construct(DoozR_Config $config, DoozR_Logger $logger)
    {
        // map type
        self::$type = self::TYPE;

        // call parents constructor
        parent::__construct($config, $logger);

        // initialize "gzip"-transmission
        $this->_initializeGzipCompression();
    }

    /**
     * Sends default HTTP Status-Messages
     *
     * sends an default HTTP Status Header like 404, 303 ...
     *
     * @param integer $statusCode  The statuscode of the HTTP header
     * @param string  $httpVersion HTTP version used for transfer
     *
     * @return DoozR_Response_Web The current instance ($this) for chaining
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    public function sendHttpStatus($statusCode = 418, $httpVersion = null)
    {
        switch ($statusCode) {
        // 1xx: Informational - Request received, continuing process
        // Continue
        case 100:
                $statusText = 'Continue';
            break;
        // Switching Protocols
        case 101:
                $statusText = 'Switching Protocols';
            break;

        // 2xx: Success - The action was successfully received, understood, and accepted
        // OK
        case 200:
                $statusText = 'OK';
            break;
        // Created
        case 201:
                $statusText = 'Created';
            break;
        // Accepted
        case 202:
                $statusText = 'Accepted';
            break;
        // Non-Authoritative Information
        case 203:
                $statusText = 'Non-Authoritative Information';
            break;
        // No Content
        case 204:
                $statusText = 'No Content';
            break;
        // Reset Content
        case 205:
            $statusText = 'Reset Content';
            break;
        // Partial Content
        case 206:
            $statusText = 'Partial Content';
            break;

        // 3xx: Redirection - Further action must be taken in order to complete the request
        // Multiple Choices
        case 300:
            $statusText = 'Multiple Choices';
            break;
        // Moved Permanently
        case 301:
            $statusText = 'Moved Permanently';
            break;
        // Found
        case 302:
            $statusText = 'Found';
            break;
        // See Other
        case 303:
            $statusText = 'See Other';
            break;
        // Not Modified
        case 304:
            $statusText = 'Not Modified';
            break;
        // Use Proxy
        case 305:
            $statusText = 'Use Proxy';
            break;
        // Temporary Redirect
        case 307:
            $statusText = 'Temporary Redirect';
            break;

        // 4xx: Client Error - The request contains bad syntax or cannot be fulfilled
        // Bad Request
        case 400:
            $statusText = 'Bad Request';
            break;
        // Unauthorized
        case 401:
            $statusText = 'Unauthorized';
            break;
        // Payment Required
        case 402:
            $statusText = 'Payment Required';
            break;
        // Forbidden
        case 403:
            $statusText = 'Forbidden';
            break;
        // Not Found
        case 404:
            $statusText = 'Not Found';
            break;
        // Method Not Allowed
        case 405:
            $statusText = 'Method Not Allowed';
            break;
        // Not Acceptable
        case 406:
            $statusText = 'Not Acceptable';
            break;
        // Proxy Authentication Required
        case 407:
            $statusText = 'Proxy Authentication Required';
            break;
        // Request Time-out
        case 408:
            $statusText = 'Request Time-out';
            break;
        // Conflict
        case 409:
            $statusText = 'Conflict';
            break;
        // Gone
        case 410:
            $statusText = 'Gone';
            break;
        // Length Required
        case 411:
            $statusText = 'Length Required';
            break;
        // Precondition Failed
        case 412:
            $statusText = 'Precondition Failed';
            break;
        // Request Entity Too Large
        case 413:
            $statusText = 'Request Entity Too Large';
            break;
        // Request-URI Too Large
        case 414:
            $statusText = 'Request-URI Too Large';
            break;
        // Unsupported Media Type
        case 415:
            $statusText = 'Unsupported Media Type';
            break;
        // Requested range not satisfiable
        case 416:
            $statusText = 'Requested range not satisfiable';
            break;
        // Expectation Failed
        case 417:
            $statusText = 'Expectation Failed';
            break;
        // I'm a teapot
        case 418:
            $statusText = 'I\'m a teapot';
            break;

        // 5xx: Server Error - The server failed to fulfill an apparently valid request
        // Internal Server Error
        case 500:
            $statusText = 'Internal Server Error';
            break;
        // Not Implemented
        case 501:
            $statusText = 'Not Implemented';
            break;
        // Bad Gateway
        case 502:
            $statusText = 'Bad Gateway';
            break;
        // Service Unavailable
        case 503:
            $statusText = 'Service Unavailable';
            break;
        // Gateway Time-out
        case 504:
            $statusText = 'Gateway Time-out';
            break;
        // HTTP Version not supported
        case 505:
            $statusText = 'HTTP Version not supported';
            break;

        // default is everything "OK" => 200
        default:
            $statusCode = 200;
            $statusText = 'OK';
            break;
        }

        // try to send header and return result of it
        $this->sendHeader(
            'HTTP/'.(($httpVersion) ? $httpVersion : self::HTTP_VERSION).' '.$statusCode.' '.$statusText
        );

        // for chaining
        return $this;
    }

    /**
     * returns image-encoded data (correct formatted) to client
     *
     * This method is intend to correctly send image-encoded data to the client.
     *
     * @param string  $buffer        The binary-data to send
     * @param string  $type          The type of image [jpeg, gif, png, tiff ...]
     * @param string  $filename      The filename for data to download
     * @param boolean $forceDownload Close connection after output?
     *
     * @return mixed Bolean True if everything wents fine
     * @access private
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    private function _sendImage($buffer, $type = 'jpeg', $filename = null, $forceDownload = false)
    {
        // check if we display inline (in browser) or force download
        if ($forceDownload) {
            // set default download-filename if not given
            if (is_null($filename)) {
                $filename = 'download';
            }

            // define disposition for attachment-display
            $contentDisposition = 'attachment';
        } else {
            // define disposition for inline-display
            $contentDisposition = 'inline';
        }

        // get length of content
        $contentLength = strlen($buffer);

        // send correct header(s)
        // content-length
        header('Content-Length: '.$contentLength);
        // content-type
        header('Content-type: image/'.$type);
        // content-disposition
        header('Content-Disposition: '.$contentDisposition.';filename="'.$filename.'"');

        // send the data
        print $buffer;

        // success
        return true;
    }

    /**
     * Sends the data from buffer as JPEG data (incl. header) to client
     *
     * This method is intend to send the data from given buffer to client.
     *
     * @param string  $buffer        The binary-data to send
     * @param boolean $exit          Close connection after output?
     * @param string  $filename      The filename for data to download
     * @param boolean $forceDownload Close connection after output?
     *
     * @return DoozR_Response_Web The current instance for chaining
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    public function sendJpeg($buffer, $exit = false, $filename = null, $forceDownload = false)
    {
        $this->_sendImage($buffer, 'jpeg', $filename, $forceDownload);

        // close connection?
        if ($exit) {
            // close connection!
            $this->closeConnection();
        }

        // return this for chaining
        return $this;
    }

    /**
     * returns png-encoded data (correct formatted) to client
     *
     * This method is intend to correctly send png-encoded data to the client.
     *
     * @param string  $buffer        The binary-data to send
     * @param boolean $exit          Close connection after output?
     * @param string  $filename      The filename for data to download
     * @param boolean $forceDownload Close connection after output?
     *
     * @return DoozR_Response_Web The current instance for chaining
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    public function sendPng($buffer, $exit = false, $filename = null, $forceDownload = false)
    {
        $this->_sendImage($buffer, 'png', $filename, $forceDownload);

        // close connection?
        if ($exit) {
            // close connection!
            $this->closeConnection();
        }

        // return this for chaining
        return $this;
    }

    /**
     * returns gif-encoded data (correct formatted) to client
     *
     * This method is intend to correctly send gif-encoded data to the client.
     *
     * @param string  $buffer        The binary-data to send
     * @param boolean $exit          Close connection after output?
     * @param string  $filename      The filename for data to download
     * @param boolean $forceDownload Close connection after output?
     *
     * @return DoozR_Response_Web The current instance for chaining
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    public function sendGif($buffer, $exit = false, $filename = null, $forceDownload = false)
    {
        $this->_sendImage($buffer, 'gif', $filename, $forceDownload);

        // close connection?
        if ($exit) {
            // close connection!
            $this->closeConnection();
        }

        // return this for chaining
        return $this;
    }

    /**
     * returns binary-data (correct formatted) to client
     *
     * This method is intend to correctly send binary-data to the client.
     * http://en.wikipedia.org/wiki/Content-Type:
     * application/octet-stream: Arbitrary binary data[4]. Generally speaking this type identifies
     * files that are not associated with a specific application. Contrary to past assumptions by
     * software packages such as Apache this is not a type that should be applied to unknown files.
     * In such a case, a server or application should not indicate a content type, as it may be
     * incorrect, but rather, should omit the type in order to allow the recipient to guess the type.[5]
     *
     * Content-Disposition ($forceDownload)
     *
     * The Inline Disposition Type
     *
     * A bodypart should be marked `inline' if it is intended to be displayed automatically upon display
     * of the message. Inline bodyparts should be presented in the order in which they occur, subject
     * to the normal semantics of multipart messages.
     *
     * The Attachment Disposition Type
     * Bodyparts can be designated `attachment' to indicate that they are separate from the main body
     * of the mail message, and that their display should not be automatic, but contingent upon some further
     * action of the user.  The MUA might instead present the user of a bitmap terminal with an iconic
     * representation of the attachments, or, on character terminals, with a list of attachments from which
     * the user could select for viewing or storage.
     *
     * @param string  $buffer        The binary-data to send
     * @param boolean $exit          Close connection after output?
     * @param string  $filename      filename for data to download
     * @param boolean $forceDownload Close connection after output?
     *
     * @return DoozR_Response_Web The current instance for chaining
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    public function sendBinary($buffer, $exit = false, $filename = null, $forceDownload = true)
    {
        // check if we display inline (in browser) or force download
        if ($forceDownload) {
            // set default download-filename if not given
            if (is_null($filename)) {
                $filename = 'download';
            }

            // define disposition for attachment-display
            $contentDisposition = 'attachment';
        } else {
            // define disposition for inline-display
            $contentDisposition = 'inline';
        }

        // calculate filesize (size of bytes given) to make browsers download progressbar work!
        $contentLength = strlen($buffer);

        // TODO: move this to session class!!!
        session_cache_limiter('private');
        session_cache_limiter('must-revalidate');

        // unkown bugfix to be classified
        header("Expires: 0");

        // IE (6) workaround
        header('Pragma: public');
        header("Cache-Control: cache, must-revalidate, post-check=0, pre-check=0");

        header("Content-Transfer-Encoding: binary");

        // content-length
        header('Content-Length: '.$contentLength);

        // force download?
        if ($forceDownload) {
            // TODO: only needed for IE-Browser! detect browser by make use of module "Clientdetect"
            // if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
            header('Content-Type: application/force-download');
            header("Content-Description: File Transfer");
        }

        // content-type
        //header('Content-Type: application/octet-stream');

        // content-disposition
        header('Content-Disposition: '.$contentDisposition.';filename="'.$filename.'"');

        // send the data
        echo $buffer;

        // close connection?
        if ($exit) {
            // close connection!
            $this->closeConnection();
        }

        // return this for chaining
        return $this;
    }

    /**
     * returns vcard -encoded data (correct formatted) to client
     *
     * This method is intend to correctly send vcard-encoded data to the client.
     *
     * @param mixed   $buffer   The data to json_encode (optional) and send
     * @param boolean $filename The name of the vard file
     * @param boolean $exit     Close connection after output?
     *
     * @return DoozR_Response_Web The current instance for chaining
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    public function sendVcard($buffer, $filename, $exit = false)
    {
        // send header for vcard type
        header("Content-Type: text/x-vcard");
        //header("Content-Length: " .(string)(sizeof($buffer)));

        // will bring the browser to download the output
        header("Content-Disposition: attachment; filename=\"{$filename}.vcf\"");

        // transfer encoding binary
        header("Content-Transfer-Encoding: binary\n");

        // send the data
        echo $buffer;

        // close connection?
        if ($exit) {
            // close connection!
            $this->closeConnection();
        }

        // return this for chaining
        return $this;
    }

    /**
     * returns json-enoced data (correct formatted) to client
     *
     * This method is intend to correctly send json-encoded data to the client.
     *
     * @param mixed   $buffer             The data to json_encode (optional) and send
     * @param string  $charset            charset for output data
     * @param boolean $alreadyJsonEncoded The current status of data JSON-encoded = true, not = false
     * @param boolean $exit               Close connection after output?
     * @param boolean $addHeader          sending data with JSON header? (SWFUpload does not allow JSON-Data + Header!)
     *
     * @return DoozR_Response_Web The current instance for chaining
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    public function sendJson($buffer, $charset = null, $alreadyJsonEncoded = false, $exit = false, $addHeader = true)
    {
        // retrieve charset
        $charset = $this->_getCharset($charset);

        // check if allready encoded
        if (!$alreadyJsonEncoded) {
            // fix encoding
            //$buffer = $this->_fixEncoding($buffer, $charset);

            // finally encode to JSON
            $buffer = json_encode($buffer);
        }

        // get length of content
        //$contentLength = strlen(serialize($buffer));

        // send correct header(s)
        // content-length
        //header('Content-Length: '.$contentLength);
        // content-type
        //header('Content-type: application/json');
        if ($addHeader) {
            header('Content-type: application/json charset='.$charset);
        }

        // send the data
        echo $buffer;

        // close connection?
        if ($exit) {
            // close connection!
            $this->closeConnection();
        }

        // return this for chaining
        return $this;
    }

    /**
     * Sends "text/html" to client
     *
     * This method is intend to send "text/html" to client.
     *
     * @param string  $buffer  The data to send
     * @param string  $etag    The Etag to send, null to prevent sending
     * @param boolean $exit    Close connection after output?
     * @param string  $charset The charset/encoding to use for sending (header-value)
     *
     * @return DoozR_Response_Web The current instance for chaining
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    public function sendHtml($buffer, $etag = null, $exit = true, $charset = null)
    {
        /* @var $request DoozR_Request_Web */
        $request = DoozR_Controller_Front::getInstance()->getRequest();

        // transform PHP global server to object for further processing
        $request->transform('SERVER');

        /**
         * check if we can deliver just a simple 304 Not modified
         */
        if ($etag && $etag === $etagReceived = $_SERVER->HTTP_IF_NONE_MATCH()) {

            // send header and close connection
            $this->sendHttpStatus(304)
                 ->sendHeader('ETag: '.$etag)
                 ->sendHeader('Cache-Control: must-revalidate, post-check=0, pre-check=0')
                 ->closeConnection();
        }

        /**
         * otherwise we do all the checking stuff and return the complete data
         */
        // retrieve charset
        $charset = $this->_getCharset($charset);

        // get data of content (html)
        $contentLength = strlen($buffer);

        // send data compressed?
        if ($this->isGzipCompressed()) {
            ob_start('ob_gzhandler');
        }

        // check if not already sent
        if (!headers_sent($file, $line)) {
            // we send html
            header('Content-type: text/html; charset='.$charset);

            // the content has a special length
            header('Content-Length: '.$contentLength);

            if ($etag) {
                // send an etag for php content -> reduce re-load
                header('ETag: '.$etag);

                // needed for session default override:
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            }
        }

        // send the buffer/data
        echo $buffer;

        // close connection?
        if ($exit) {
            // close connection!
            $this->closeConnection();
        }

        // return this for chaining
        return $this;
    }

    /**
     * returns xml data (with correct header) to client
     *
     * This method is intend to correctly send xml data to the client.
     *
     * @param array   $buffer  The data to send
     * @param string  $charset The charset for xml output
     * @param boolean $exit    Close connection after sending output?
     *
     * @return DoozR_Response_Web The current instance for chaining
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    public function sendXml($buffer, $charset = 'UTF-8', $exit = false)
    {
        // get length of content
        $contentLength = strlen($buffer);

        header("Cache-Control: cache, must-revalidate");
        header("Pragma: public");

        // send correct header(s)
        // content-type
        header('Content-type: text/xml');

        // content length
        header('Content-Length: '.$contentLength);

        // send the data
        echo $buffer;

        // close connection?
        if ($exit) {
            // close connection!
            $this->closeConnection();
        }

        // return this for chaining
        return $this;
    }

    /**
     * returns plain unformatted text
     *
     * This method is intend to send plain unformatted text e.g. to console.
     *
     * @param string  $buffer The binary-data to send
     * @param boolean $exit   Close connection after output?
     *
     * @return DoozR_Response_Web The current instance for chaining
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    public function sendText($buffer, $exit = false)
    {
        echo $buffer;

        // close connection?
        if ($exit) {
            // close connection!
            $this->closeConnection();
        }

        // return this for chaining
        return $this;
    }

    /**
     * Sends a single or an array of header to client
     *
     * This method is intend to send a single or an array of header to client.
     *
     * @param mixed $header STRING a single header or ARRAY of headers
     *
     * @return DoozR_Response_Web The current instance for chaining
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    public function sendHeader($header)
    {
        if (!headers_sent($file, $line)) {
            if (is_array($header)) {
                $elements = count($header);
                for ($i = 0; $i < $elements; ++$i) {
                    header($header[$i]);
                }
            } else {
                header($header);
            }

        } else {
            $this->logger->log(
                __CLASS__.': Failed while sending HTTP-Header ['.self::HTTP_VERSION.'] "'.var_export($header, true).
                '. Headers already sent in file: '.$file.' on line: '.$line
            );
        }

        // return this for chaining
        return $this;
    }

    /**
     * Closes a connection correctly
     *
     * This method is intend to correctly close an open connection to client.
     *
     * @return void
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    public function closeConnection()
    {
        // close session correctly
        @session_write_close();

        // send the header for connection close
        if (!headers_sent($file, $line)) {
            header('Connection: close');

        } else {
            $this->logger->log(
                __CLASS__.': Failed while sending HTTP-Header "Connection: close". Headers already sent in file: '.
                $file.' on line: '.$line
            );
        }
        exit;
    }

    /**
     * Returns the GZIP compression status of connection
     *
     * This method is intend to return the GZIP compression status of connection.
     *
     * @return void
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    public function isGzipCompressed()
    {
        return $this->_isGzipCompressed;
    }

    /**
     * returns a valid + supported encoding/charset
     *
     * This method is intend to return a valid + supported encoding/charset
     *
     * @param string $encoding The encoding to check
     *
     * @return  string A valid encoding to use for content-send
     * @access private
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    private function _getCharset($encoding = null)
    {
        // check encoding
        if (!$encoding) {
            // get it from config
            $encoding = $this->config->locale->encoding();

        } else {
            // to upper for switch
            $encoding = strtoupper($encoding);

            // check if compatible
            switch ($encoding) {
            case 'UTF-8':
                $encoding = 'UTF-8';
                break;
            case 'ISO-8859-1':
                $encoding = 'ISO-8859-1';
                break;
            default:
                $encoding = 'UTF-8';
                break;
            }
        }

        // return the correct encoding/charset
        return strtoupper($encoding);
    }

    /**
     * Returns a valid encoded content for send
     *
     * This method is intend to return a valid encoded content for send
     *
     * @param mixed  $buffer  The data to encode to valid + supported target charset
     * @param string $charset The charset to use for encoding (switch)
     *
     * @return mixed Valid + supported encoded content
     * @access private
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    private function _fixEncoding($buffer = null, $charset = 'UTF-8')
    {
        // get module encoding
        /*
        $encoding = DoozR_Core::module('encoding');

        // check for given target charset and convert
        switch ($charset) {
        case 'UTF-8':
            return $encoding->encodeUtf8($buffer);
            break;
        case 'ISO-8859-1':
            return $encoding->encodeIso88591($buffer);
            break;
        }
        */
        return $buffer;
    }

    /**
     * handles GZIP use for transmission as defined in core-config
     *
     * handles GZIP use for transmission as defined in core-config
     *
     * @return mixed true if gzip should and could be set, false if gzip could not be set,
     *                null if gzip is disabled in config
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     */
    private function _initializeGzipCompression()
    {
        // check first if not already activated
        if (!self::$_initialized['gzip']) {

            $this->_isGzipCompressed = $this->config->transmission->gzip();

            // "gzip" enabled in configuration?
            if ($this->_isGzipCompressed) {
                /*
                if (!self::$_initialized['gzip'] = ob_start('ob_gzhandler')) {
                    self::$_initialized['gzip'] = ob_start();
                    $this->_isGzipCompressed = false;
                }
                */
            } else {
                self::$_initialized['gzip'] = ob_start();
                $this->_isGzipCompressed = false;
            }
        }

        return self::$_initialized['gzip'];
    }

    /**
     * redirects a request to another page/site
     *
     * redirects a request to another page/site
     *
     * supported redcirect-types:
     * html   - Meta redirect
     * header - PHP-Header redirect
     * js     - JavaScript redirect
     *
     * Note:
     * The parameter $time does only work with a redirect of type "HTML"
     *
     * @param string $url  The url to redirect to
     * @param string $type The type of redirect to use (html, header or js)
     * @param int    $time The timeout for HTML-redirect in seconds
     *
     * @return void
     * @access public
     * @author Benjamin Carl <opensource@clickalicious.de>
     * @since   Method available since Release 1.0.0
     */
    public static function redirect($url, $type = self::REDIRECT_TYPE_HEADER, $time = 0)
    {
        // need instance of this class for any actions
        $responseClass = new self;

        switch ($type) {
        case self::REDIRECT_TYPE_HTML:
            echo '<meta http-equiv="refresh" content="'.$time.'"; URL="'.$url.'">';
            break;
        case self::REDIRECT_TYPE_JS:
            echo '<script type="text/javascript">window.location = "'.$url.'";</script>';
            break;
        case self::REDIRECT_TYPE_HEADER:
            // header status code
            $responseClass->sendHttpStatus(307);

            // redirect header
            header('Location: '.$url);

            // close connection
            //$this->closeConnection();
            break;
        default:
        throw new Exception('Unknown redirect type given! ( '.$type.' )');
            break;
        }
        exit;
    }
}

?>