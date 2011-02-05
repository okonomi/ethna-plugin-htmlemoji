<?php
// vim: foldmethod=marker
/**
 *  Ethna_Plugin_Filter_Htmlemoji
 *
 *  @author     your name <yourname@example.com>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna_Plugin
 *  @version    $Id: 8a2a127e671fc4d041f941820b53f33de4f24b97 $
 */

// {{{ Ethna_Plugin_Filter_Htmlemoji
/**
 *  Filter Plugin Class Htmlemoji.
 *
 *  @author     yourname <yourname@example.com>
 *  @access     public
 *  @package    Ethna_Plugin 
 */
class Ethna_Plugin_Filter_Htmlemoji extends Ethna_Plugin_Filter
{
    protected $_emoji;


    /**
     *  filter before first processing.
     *
     *  @access public
     */
    function preFilter()
    {
        ob_start();
    }

    /**
     *  filter BEFORE executing action.
     *
     *  @access public
     *  @param  string  $action_name  Action name.
     *  @return string  null: normal.
     *                string: if you return string, it will be interpreted
     *                        as Action name which will be executed immediately.
     */
    function preActionFilter($action_name)
    {
    }

    /**
     *  filter AFTER executing action.
     *
     *  @access public
     *  @param  string  $action_name    executed Action name.
     *  @param  string  $forward_name   return value from executed Action.
     *  @return string  null: normal.
     *                string: if you return string, it will be interpreted
     *                        as Forward name.
     */
    function postActionFilter($action_name, $forward_name)
    {
    }

    /**
     *  filter which will be executed at the end.
     *
     *  @access public
     */
    function postFilter()
    {
        $content = ob_get_clean();
        echo $this->getEmojiInstance()->filter($content, array('HexToUtf8', 'Carrier'));
    }

    public function getEmojiInstance()
    {
        if (is_null($this->_emoji)) {
            $this->_emoji = $this->createEmojiInstance();
        }

        return $this->_emoji;
    }

    public function setEmojiInstance($emoji)
    {
        $this->_emoji = $emoji;

        return $this;
    }

    public function createEmojiInstance()
    {
        require_once 'HTML/Emoji.php';

        return HTML_Emoji::getInstance();
    }
}
// }}}
