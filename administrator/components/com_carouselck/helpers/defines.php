<?php
/**
 * @copyright	Copyright (C) 2019. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - https://www.template-creator.com - https://www.joomlack.fr
 */

// No direct access
defined('_JEXEC') or die;

// set variables
define('CAROUSELCK_PLATFORM', 'joomla');
define('CAROUSELCK_VERSION', '2.0.0');
define('CAROUSELCK_PATH', JPATH_SITE . '/administrator/components/com_carouselck');
define('CAROUSELCK_ADMIN_PATH', CAROUSELCK_PATH);
define('CAROUSELCK_FRONT_PATH', JPATH_SITE . '/components/com_carouselck');
define('CAROUSELCK_PROJECTS_PATH', JPATH_SITE . '/administrator/components/com_carouselck/projects');
define('CAROUSELCK_ADMIN_URL', JUri::root(true) . '/administrator/index.php?option=com_carouselck');
define('CAROUSELCK_URL', JUri::base(true) . '/index.php?option=com_carouselck');
define('CAROUSELCK_ADMIN_GENERAL_URL', JUri::root(true) . '/administrator/index.php?option=com_carouselck&view=templates');
define('CAROUSELCK_MEDIA_URI', JUri::root(true) . '/media/com_carouselck');
define('CAROUSELCK_MEDIA_URL', CAROUSELCK_MEDIA_URI);
define('CAROUSELCK_MEDIA_PATH', JPATH_ROOT . '/media/com_carouselck');
define('CAROUSELCK_PLUGIN_URL', CAROUSELCK_MEDIA_URI);
define('CAROUSELCK_TEMPLATES_PATH', JPATH_SITE . '/templates');
define('CAROUSELCK_SITE_ROOT', JPATH_ROOT);
define('CAROUSELCK_URI', JUri::root(true) . '/administrator/components/com_carouselck');
define('CAROUSELCK_URI_ROOT', JUri::root(true));
define('CAROUSELCK_URI_BASE', JUri::base(true));
define('CAROUSELCK_PLUGINS_PATH', JPATH_SITE . '/plugins/carouselck');

// include the classes
require_once CAROUSELCK_PATH . '/helpers/ckinput.php';
require_once CAROUSELCK_PATH . '/helpers/cktext.php';
require_once CAROUSELCK_PATH . '/helpers/ckfile.php';
require_once CAROUSELCK_PATH . '/helpers/ckfolder.php';
require_once CAROUSELCK_PATH . '/helpers/ckfof.php';
//require_once CAROUSELCK_PATH . '/helpers/helper.php';
//require_once CAROUSELCK_PATH . '/helpers/ckcontroller.php';
//require_once CAROUSELCK_PATH . '/helpers/ckmodel.php';
//require_once CAROUSELCK_PATH . '/helpers/ckview.php';