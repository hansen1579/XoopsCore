<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Installer common include file
 *
 * @copyright   The XOOPS project http://www.xoops.org/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU General Public License (GPL)
 * @package     installer
 * @since       2.3.0
 * @author      Haruki Setoyama  <haruki@planewave.org>
 * @author      Kazumi Ono <webmaster@myweb.ne.jp>
 * @author      Skalpa Keo <skalpa@xoops.org>
 * @author      Taiwen Jiang <phppp@users.sourceforge.net>
 * @author      DuGris (aka L. JEN) <dugris@frxoops.org>
 * @version     $Id$
 **/

/**
 * If non-empty, only this user can access this installer
 */
define('INSTALL_USER', '');
define('INSTALL_PASSWORD', '');
define('XOOPS_INSTALL', 1);
define('XOOPS_INSTALL_PATH', dirname(dirname(__FILE__)));

// options for mainfile.php
if (empty($xoopsOption['hascommon'])) {
    $xoopsOption['nocommon'] = true;
    session_start();
}
include_once dirname(dirname(dirname(__FILE__))) . '/mainfile.php';
if (!defined("XOOPS_ROOT_PATH")) {
    define("XOOPS_ROOT_PATH", str_replace("\\", "/", realpath('../')));
    define("XOOPS_PATH", "");
    define("XOOPS_VAR_PATH", "");
    define("XOOPS_URL", "");
}

include XOOPS_INSTALL_PATH . '/class/installwizard.php';
include_once XOOPS_ROOT_PATH . '/include/version.php';
include_once XOOPS_INSTALL_PATH . '/include/functions.php';
include_once XOOPS_ROOT_PATH . '/include/defines.php';
include_once XOOPS_ROOT_PATH . '/class/xoopsload.php';

$_SESSION['pageHasHelp'] = false;
$_SESSION['pageHasForm'] = false;

$wizard = new XoopsInstallWizard();
$_SESSION['wizard'] = $wizard;

if (!$wizard->xoInit()) {
    exit('Init Error');
}

if (!isset($_SESSION['settings']) || !is_array($_SESSION['settings'])) {
    $_SESSION['settings'] = array();
}