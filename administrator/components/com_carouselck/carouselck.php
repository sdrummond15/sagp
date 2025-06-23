<?php
/**
 * @name		Carousel CK
 * @package		com_carouselck
 * @copyright	Copyright (C) 2019. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - https://www.template-creator.com - https://www.joomlack.fr
 */


// no direct access
defined('_JEXEC') or die;
if (! defined('CK_LOADED')) define('CK_LOADED', 1);

// use Carouselck\CKFof;

include_once JPATH_ADMINISTRATOR . '/components/com_carouselck/helpers/defines.php';

// Access check.
if (!JFactory::getUser()->authorise('core.edit', 'com_carouselck')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// loads the language files from the frontend
$lang	= JFactory::getLanguage();
$lang->load('com_carouselck', JPATH_SITE . '/components/com_carouselck', $lang->getTag(), false);
$lang->load('com_carouselck', JPATH_SITE, $lang->getTag(), false);

// loads the helper in any case
require_once CAROUSELCK_PATH . '/helpers/cktext.php';
require_once CAROUSELCK_PATH . '/helpers/ckpath.php';
require_once CAROUSELCK_PATH . '/helpers/ckfile.php';
require_once CAROUSELCK_PATH . '/helpers/ckfolder.php';
require_once CAROUSELCK_PATH . '/helpers/ckuri.php';
require_once CAROUSELCK_PATH . '/helpers/ckfof.php';
require_once CAROUSELCK_PATH . '/helpers/helper.php';
require_once CAROUSELCK_PATH . '/helpers/ckframework.php';
require_once CAROUSELCK_PATH . '/helpers/ckcontroller.php';
require_once CAROUSELCK_PATH . '/helpers/ckmodel.php';
require_once CAROUSELCK_PATH . '/helpers/ckview.php';

\Carouselck\CKFramework::load();

// Include dependancies
require_once CAROUSELCK_PATH . '/controller.php';

$controller	= \Carouselck\CKController::getInstance('Carouselck');
$controller->execute(JFactory::getApplication()->input->get('task'));
//$controller->redirect();
