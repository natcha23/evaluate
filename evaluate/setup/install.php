<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * LICENSE: Some license information
 *
 * @copyright  2008 Ice Solution ltd.
 * @license    <http://link_to_license_file>   PHP License <version>
 * @version    $Id:$
 * @link       <http://link_to_development_site>
 * @since      File available since Release <since_version>
 *
 * The following copyrights are applicable to portions of the Ice Framework.
 * Copyright © 2007-2008 Ice Solution Ltd. (http://www.icesolution.com)
 */

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @copyright  2008 Ice Solution ltd.
 * @license    <http://link_to_license_file>   PHP License <version>
 * @version    Release: @package_version@
 * @link       <http://link_to_development_site>
 * @since      Class available since Release <since_version>
 * @deprecated Class deprecated in Release <deprecated_version>
 */
class Installation
{
    /**
     * Singleton instance
     *
     * @var package_name
     */
    protected static $_instance = null;

    /**
     * Singleton pattern implementation makes "new" unavailable
     *
     * @return void
     */
    public function __construct()
    {}

    /**
     * Singleton pattern implementation makes "clone" unavailable
     *
     * @return void
     */
    public function __clone()
    {}

    /**
     * Returns an instance of package_name
     *
     * Singleton pattern implementation
     *
     * @return package_name Provides a fluent interface
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Short description for method
     *
     * Long description for method (if any)...
     *
     * @param  Parameter name and Description.
     * @uses   Other method to use.
     * @return Return data type (if return)
     * @throws exceptionclass [description]
     */
    public function foo()
    {
        // TODO
        // entire content of function
        // must be indented four spaces
    }
}
