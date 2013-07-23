<?php
/**
 * Phergie
 *
 * PHP version 5
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * http://phergie.org/license
 *
 * @category  Phergie
 * @package   Phergie_Plugin_Letmegooglethatforyou
 * @author    Phergie Development Team <team@phergie.org>
 * @copyright 2008-2011 Phergie Development Team (http://phergie.org)
 * @license   http://phergie.org/license New BSD License
 * @link      http://pear.phergie.org/package/Phergie_Plugin_Letmegooglethatforyou
 */

/**
 * Provides commands used to access several services offered by Letmegooglethatforyou
 * including search, translation, weather, maps, and currency and general
 * value unit conversion.
 *
 * @category Phergie
 * @package  Phergie_Plugin_Letmegooglethatforyou
 * @author   Phergie Development Team <team@phergie.org>
 * @license  http://phergie.org/license New BSD License
 * @link     http://pear.phergie.org/package/Phergie_Plugin_Letmegooglethatforyou
 * @uses     Phergie_Plugin_Command pear.phergie.org
 * @uses     Phergie_Plugin_Http pear.phergie.org
 * @uses     Phergie_Plugin_Temperature pear.phergie.org
 * @uses     Phergie_Plugin_Encoding pear.phergie.org
 */
class Phergie_Plugin_Letmegooglethatforyou extends Phergie_Plugin_Abstract
{
    /**
     * Checks for dependencies.
     *
     * @return void
     */
    public function onLoad()
    {
        $plugins = $this->getPluginHandler();
        $plugins->getPlugin('Command');
        $plugins->getPlugin('Http');
        $plugins->getPlugin('Temperature');
        $plugins->getPlugin('Encoding');
    }

    /**
     * Returns the first result of a Google search.
     *
     * @param string $query Search term
     *
     * @return void
     * @todo Implement use of URL shortening here
     */
    public function onCommandL($query)
    {
    	return $this->onCommandLmgtfy($query);
    }

    public function onCommandLmgtfy($query)
    {
	    list($nick, $q) = explode(" ", $query, 2);
	    $query = $q == '' ? $nick : $q;
	    $nick = $q == '' ? '' : $nick;
        $event = $this->getEvent();
        $source = $event->getSource();
	    $msg = '';
	    if ($nick)
	    {
		    $msg = $nick . ': ';
	    }
        $msg .= 'http://www.lmgtfy.com/?q=' . urlencode($query);
        $this->doPrivmsg($source, $msg);
    }
}
