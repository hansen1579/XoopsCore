<?php
/**
 * Xlanguage module
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         Xlanguage
 * @since           2.6.0
 * @author          Laurent JEN (Aka DuGris)
 * @version         $Id$
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

class XlanguageTinymceForm extends XoopsSimpleForm
{
    /**
     * @param null $obj
     */
    public function __construct($xlanguage)
    {
        $xoops = Xoops::getInstance();

        parent::__construct('', 'xlanguage_form', $xoops->getEnv('PHP_SELF'), 'post', true, 'horizontal');

        $lang_tray = new XoopsFormSelect(_XLANGUAGE_TINYMCE_SUBTITLE, 'select_language');
        $lang_tray->addOption('', _XLANGUAGE_TINYMCE_SELECT);
        foreach($xlanguage as $k => $v) {
            $lang_tray->addOption($v['xlanguage_code'], $v['xlanguage_description']);
        }
        $this->addElement($lang_tray, true);

        $text_tray = new XoopsFormTextArea('', 'text_language', '', 7, 7);
        $text_tray->setExtra('onkeyup="Xoops_xlanguageDialog.onkeyupMLC(this);"');
        $this->addElement($text_tray);

        $this->addElement(new XoopsFormRaw('<div id="text_language_msg"><script type="text/javascript">Xoops_xlanguageDialog.onkeyupMLC(this);</script></div>'));

        /**
         * Buttons
         */
        $button_tray = new XoopsFormElementTray('', '');

        $button = new XoopsFormButton('', 'submit', XoopsLocale::A_SUBMIT, 'insert');
        $button->setExtra('onclick="Xoops_xlanguageDialog.insertMLC();return false;"');
        $button->setClass('btn btn-success');
        $button_tray->addElement($button);

        $button_2 = new XoopsFormButton('', 'button', XoopsLocale::A_CLOSE, 'button');
        $button_2->setExtra('onclick="tinyMCEPopup.close();"');
        $button_2->setClass('btn btn-danger');
        $button_tray->addElement($button_2);

        $this->addElement($button_tray);
    }
}